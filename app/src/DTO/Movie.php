<?php 

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;

#[ApiResource(
    normalizationContext: ['groups' => ['movie:read']],
    denormalizationContext: ['groups' => ['movie:write']],
    operations: [
        new GetCollection(),
        new Get(),
    ]
)]
class Movie
{
    #[Groups(['movie:read'])]
    public int $id;

    #[Groups(['movie:read'])]
    public string $title;

    #[Groups(['movie:read'])]
    public string $overview;

    #[Groups(['movie:read'])]
    public string $poster_path;

    #[Groups(['movie:read'])]
    public string $release_date;
}