<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Entity\Panier;
use App\Entity\Reservation;
use App\Repository\PlatsRepository;
use App\Repository\PanierRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private ReservationRepository $resrepository;
    private PanierRepository $panierrepository;
    private PlatsRepository $platrepository;

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('administration/index.html.twig', [
            'reservation' => $this->resrepository->findAll(),
            'panier' => $this->panierrepository->findAll(),
            'plats' => $this->platrepository->findAll()
        ]);
    }
}
