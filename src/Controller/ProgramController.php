<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findall();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/program{id}/', name: 'show')]
    public function show(Program $program): Response
    {
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/{programId}/seasons/{seasonId}', name: 'season_show')]
    public function showSeason(
        Program $program,
        Season $seasons,)
    {
        return $this->render('program/season_show.html.twig', [
            'seasons' => $seasons,
            'program' => $program]);

    }

    #[Route('/{programId}/seasons/{seasonId}/episodes/{episodeId}', name: 'episode_show')]
    public function showEpisode(
        Program $program,
        Season $seasons,
        Episode $episodes,)
    {
        return $this->render('program/episode_show.html.twig', [
            'episodes' => $episodes,
            'seasons' => $seasons,
            'program' => $program]);

    }


}