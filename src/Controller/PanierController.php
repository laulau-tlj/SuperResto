<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Panier;
use App\Entity\Utilisateurs;
use App\Repository\PanierRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\uid;

class PanierController extends AbstractController
{
    private PanierRepository $repository;

    public function __construct(private ManagerRegistry $manager) {

        $this->repository = $manager->getRepository(Panier::class);

    }
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        
        $paniers = $this->manager->getRepository(Panier::class)->findBy(['utilisateur'=>$this->getUser()->getId()]);
        dump($paniers);
        return $this->render('panier/index.html.twig', [
            'paniers' => $paniers,
        ]);
    }

    #[Route('/panier/add/{id}/{uid}', name: 'add_panier', methods:["GET", "POST"])]
    public function add( int $id,Utilisateurs $uid): Response
    {
        $panier = new Panier;
        $menu = $this->manager->getRepository(Menu::class)->find($id);
        $panier->addMenu($menu);
        $panier->setUtilisateur($uid);
        $this->repository->save($panier, true);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/{id}/delete', name:'delete_panier', methods:["GET", "POST"], requirements:['id' => "\d+"])]
    public function delete(int $id): Response
    {
        $panier = $this->manager->getRepository(Panier::class)->find($id);
    
        if ($panier) {
            $om = $this->manager->getManager();
            $om->remove($panier);
            $om->flush();
        }
    
        return $this->redirectToRoute('app_panier');
    }

}
