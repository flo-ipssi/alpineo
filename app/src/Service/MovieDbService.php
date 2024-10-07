<?php

namespace App\Service;

use Symfony\Component\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MovieDbService
{
    public function __construct(
        private SerializerInterface $serializer,
        private HttpClientInterface $client,
        private string $apiKey,
        private string $baseUrl,
        private LoggerInterface $logger
    ) {}

    public function getTrendingMovies(): array
    {
        return $this->makeApiRequest('trending/movie/day', ['page' => 1])['results'] ?? [];
    }

    public function getMoviesByGenre($genreId): array
    {
        return $this->makeApiRequest('discover/movie', ['with_genres' => $genreId])['results'] ?? [];
    }
    
    private function makeApiRequest(string $endpoint, array $queryParams = []): array
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . $endpoint, [
                'query' => array_merge(['api_key' => $this->apiKey, 'language' => 'fr-FR'], $queryParams)
            ]);

            return json_decode($response->getContent(), true) ?? [];
        } catch (\Exception $e) {
            $this->logger->error('Error fetching data from TMDb: ' . $e->getMessage());
            return [];
        }
    }

    public function getMovieTrailer(int $movieId): ?string
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . "movie/{$movieId}/videos", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'fr-FR'
                ]
            ]);

            $videos = json_decode($response->getContent(), true);

            foreach ($videos['results'] as $video) {
                if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                    return $video['key'];
                }
            }

            return null;
        } catch (\Exception $e) {
            $this->logger->error('Error fetching movie trailer: ' . $e->getMessage());
            return null;
        }
    }
}
