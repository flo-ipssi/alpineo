<?php

namespace App\Controller;

use App\Service\MovieDbService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private MovieDbService $movieDbService)
    {
    }
    #[Route('/', name: 'app_home')]
    public function index(Request $request ): Response
    {
        $movies = $this->movieDbService->getTrendingMovies();

        return $this->render('home/index.html.twig', [
            'movies' => $movies,
        ]);
    }


    #[Route('/movies/filter-by-genre', name: 'movie_filter_by_genre', methods:["GET"])]
    public function filterMoviesByGenre(Request $request): JsonResponse
    {
        $genreId = $request->query->get('genre');

        $movies = $this->movieDbService->getMoviesByGenre($genreId);

        return new JsonResponse(['movies' => $movies]);
    }
    
    #[Route('/movies/trailer/{id}', name: 'movie_trailer', methods:["GET"])]
    public function getMovieTrailer($id): JsonResponse
    {
        $trailerKey = $this->movieDbService->getMovieTrailer($id);

        return new JsonResponse(['trailerKey' => $trailerKey]);
    }
}
