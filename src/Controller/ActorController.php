<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Episode;
use App\Entity\Program;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'app_actor_index', methods: ['GET'])]
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('actor/index.html.twig', [
            'actors' => $actorRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_actor_show', methods: ['GET'])]
    public function show(Actor $actor): Response
    {
        $programs = $actor->getPrograms();

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'programs' => $programs,
        ]);

}
}
