<?php

namespace App\Controller;

use App\Entity\Panier;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(ManagerRegistry $manager): Response
    {
        $panier = $manager->getRepository(Panier::class)->findAll();
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
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
