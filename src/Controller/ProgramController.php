<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Category;
use App\Entity\Actor;
use App\Form\ProgramType;
use App\Repository\CategoryRepository;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, RequestStack $requestStack): Response
    {
        $programs = $programRepository->findAll();

        $session = $requestStack->getSession();
        if (!$session->has('total')) {
            $session->set ('total', 0); // On initialise le compteur à 0 s'il n'existe pas
        }

        $total = $session->get('total'); // On récupère la valeur du compteur

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);

            $this->addFlash('success', 'The new program has been created');

            // Redirect to program list
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->render('program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(), // Utilisez createView() pour passer le formulaire à la vue
        ]);
    }

    #[Route('/{id}', name: 'show')] // Supprimé le "program" avant "{id}"
    public function show(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id found in the program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }

    #[Route('/{program}/seasons/{season}', name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response // Renommé "$seasons" en "$season"
    {
        return $this->render('program/season_show.html.twig', [
            'season' => $season, // Renommé "seasons" en "season"
            'program' => $program
        ]);
    }

    #[Route('/{program}/seasons/{season}/episodes/{episode}', name: 'episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response // Renommé "$episodes" en "$episode"
    {
        return $this->render('program/episode_show.html.twig', [
            'episode' => $episode, // Renommé "episodes" en "episode"
            'season' => $season,
            'program' => $program
        ]);
    }

    #[Route('/{program}/actors/{actor}', name: 'actor_show')]
    public function showActor(Program $program, Actor $actor): Response
    {
        return $this->render('program/actor_show.html.twig', [
            'actor' => $actor,
            'program' => $program
        ]);
    }

}
