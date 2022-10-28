<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Entity\Panier;
use App\Entity\Reservation;
use App\Repository\PlatsRepository;
use App\Repository\PanierRepository;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private ReservationRepository $resrepository;
    private PanierRepository $panierrepository;
    private PlatsRepository $platrepository;

    public function __construct(
        private ManagerRegistry $manager
    ) {
        $this->resrepository = $manager->getRepository(Reservation::class);
        $this->panierrepository = $manager->getRepository(Panier::class);
        //$this->platsrepository = $manager->getRepository(Plats::class);
    }

    #[Route('/admin', name: 'app_admin')]
    #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits", statusCode: 403)]
    public function index(): Response
    {
        return $this->render('administration/index.html.twig', [
            'reservation' => $this->resrepository->findAll(),
            'commandes' => $this->panierrepository->findAll(),
            //'plats' => $this->platrepository->findAll()
        ]);
    }
}
