<?php


namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\BookController;
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Attribute\MaxDepth;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['book:read'],
                            'enable_max_depth' => true],
    denormalizationContext: ['groups' => ['write']],
    security: "is_granted('IS_AUTHENTICATED_FULLY')",
    securityMessage: "Vous devez être connecté pour accéder à cette ressource.",
    operations: [
        new Get(),
        new GetCollection(
            uriTemplate: '/books/recent',
            controller: BookController::class,
            read: false,
            name: 'get_recent_books',
            openapiContext: [
                'summary' => 'Récupère les livres créés il y a moins de 7 jours.',
                'description' => 'Cette route personnalisée permet de récupérer les livres créés il y a moins de 7 jours.',
            ],



        ),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['title' => 'partial', 'genre' => 'partial', 'author.name' => 'partial'])]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['book:read','author:read', 'write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['book:read','author:read', 'write'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['book:read', 'write'])]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    #[Groups(['book:read', 'write'])]
    private ?string $summary = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    #[Groups(['book:read', 'write'])]
    private ?\DateTime $publicationDate = null;


    #[ORM\Column]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    #[Groups(['book:read', 'write'])]
    private ?\DateTime $createdAt = null;


    #[ORM\Column]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    #[Groups(['book:read', 'write'])]
    private ?\DateTime $updatedAt = null;

    #[MaxDepth(1)]
    #[ORM\ManyToOne(inversedBy: 'books',fetch: 'LAZY')]
    #[Groups(['book:read', 'write'])]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPublicationDate(): ?\DateTime
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTime $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }
}
