<?php

namespace App\Tests\Service;

use App\Service\MovieDbService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MovieDbServiceTest extends TestCase
{
    private MovieDbService $service;
    private HttpClientInterface $clientMock;
    private SerializerInterface $serializerMock;
    private LoggerInterface $loggerMock;

    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(HttpClientInterface::class);
        $this->serializerMock = $this->createMock(SerializerInterface::class);
        $this->loggerMock = $this->createMock(LoggerInterface::class);
        $this->service = new MovieDbService(
            $this->serializerMock,
            $this->clientMock,
            getenv('TMDB_API_KEY_TEST'), 
            getenv('TMDB_API_URL_TEST'),
            $this->loggerMock
        );
    }

    public function testGetMoviesByGenreReturnsMovies()
    {
        $this->clientMock->method('request')
            ->willReturn(new MockResponse(json_encode([
                'results' => [
                    ['title' => 'Action Movie'],
                    ['title' => 'Drama Movie']
                ]
            ])));

        $movies = $this->service->getMoviesByGenre(28);

        $this->assertNotEmpty($movies);
    }

}
