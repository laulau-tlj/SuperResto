<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(ManagerRegistry $manager): Response
    {
        $menus = $manager->getRepository(Menu::class)->findAll(); //Je charge les repository avec managerRegistry
        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
        ]);
    }
}
