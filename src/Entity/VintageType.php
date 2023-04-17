<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\VintageTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/vintage_type/{id}',
            openapiContext: [
                'summary' => 'Retrieves a Vintage Type',
                'description' => 'Retrieves a Vintage Type',
                'responses' => [
                    '200' => [
                        'description' => 'Vintage Type found',
                    ],
                    '404' => [
                        'description' => 'Vintage Type not found',
                    ],
                ],
            ]
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Retrieves a Vintage Type collection',
                'description' => 'Retrieves a Vintage Type collection',
                'responses' => [
                    '200' => [
                        'description' => 'Vintage Type collection found',
                    ],
                    '404' => [
                        'description' => 'Vintage Type collection not found',
                    ],
                ],
            ]
        ),
    ]
)]
#[ORM\Entity(repositoryClass: VintageTypeRepository::class)]
class VintageType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get_User', 'set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'Grand Cru',
        ]
    )]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ApiProperty(
        openapiContext: [
            'type' => 'array path',
            'example' => '[
            "/api/vintage/2",
            "/api/vintage/4"
            ]',
        ]
    )]
    #[ORM\OneToMany(mappedBy: 'vintage_type', targetEntity: Vintage::class)]
    private Collection $vintages;

    public function __construct()
    {
        $this->vintages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Vintage>
     */
    public function getVintages(): Collection
    {
        return $this->vintages;
    }

    public function addVintage(Vintage $vintage): self
    {
        if (!$this->vintages->contains($vintage)) {
            $this->vintages->add($vintage);
            $vintage->setVintageType($this);
        }

        return $this;
    }

    public function removeVintage(Vintage $vintage): self
    {
        if ($this->vintages->removeElement($vintage)) {
            // set the owning side to null (unless already changed)
            if ($vintage->getVintageType() === $this) {
                $vintage->setVintageType(null);
            }
        }

        return $this;
    }
}
