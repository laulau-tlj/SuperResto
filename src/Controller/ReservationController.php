<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/res', name: "app_", methods: ['GET'])]
class ReservationController extends AbstractController
{
    private const REDIRECT = "app_menu";

    private ReservationRepository $repository;

    public function __construct(
        private ManagerRegistry $manager
    ) {
        $this->repository = $manager->getRepository(Reservation::class);
    }

    #[Route('/', name: 'res', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $reservation = new Reservation;
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setStatut(0);
            $this->repository->save($reservation, true);
            $this->addFlash('success', "La demande de réservation a été enregistré.");
            return $this->redirectToRoute(self::REDIRECT);
        }

        return $this->renderForm("reservation/index.html.twig", [
            'form' => $form
        ]);
    }


    #[Route('/{id}/update', name: 'update', methods: ['GET', 'POST'], requirements: ['id' => "\d+"])]
    #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits", statusCode: 403)]
    public function update(int $id, Request $request): Response
    {
        $post = $this->repository->find($id);
        if (!$post) {
            $this->addFlash('danger', "La demande que vous recherchez n'existe pas.");
            return $this->redirectToRoute(self::REDIRECT);
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->save($post, true);
            $this->addFlash('success', "La demande a été décider.");
            return $this->redirectToRoute(self::REDIRECT);
        }

        return $this->renderForm("post/update.html.twig", [
            'form' => $form
        ]);
    }

    #[Route('/{id}/delete', name: "delete", requirements: ['id' => "\d+"])]
    #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits", statusCode: 403)]
    public function delete(int $id): Response
    {
        $post = $this->repository->find($id);
        if ($post) {
            $this->repository->remove($post, true);
        } else {
            $this->addFlash('danger', "La demande que vous recherchez n'existe pas.");
        }
        return $this->redirectToRoute(self::REDIRECT);
    }
}
