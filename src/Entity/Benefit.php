<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BenefitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/benefit/{id}',
            openapiContext: [
                'summary' => 'Retrieves a Benefit',
                'description' => 'Retrieves a Benefit',
                'responses' => [
                    '200' => [
                        'description' => 'Benefit found',
                    ],
                    '404' => [
                        'description' => 'Benefit not found',
                    ],
                ],
            ]
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Retrieves a Benefit collection',
                'description' => 'Retrieves a Benefit collection',
                'responses' => [
                    '200' => [
                        'description' => 'Benefit collection found',
                    ],
                    '404' => [
                        'description' => 'Benefit collection not found',
                    ],
                ],
            ]
        ),
    ]
)]
#[ORM\Entity(repositoryClass: BenefitRepository::class)]
class Benefit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne(inversedBy: 'benefits')]
    private ?Vintage $vintages = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getVintages(): ?Vintage
    {
        return $this->vintages;
    }

    public function setVintages(?Vintage $vintages): self
    {
        $this->vintages = $vintages;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
