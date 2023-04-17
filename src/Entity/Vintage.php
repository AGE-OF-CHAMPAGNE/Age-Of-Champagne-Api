<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetVintageCardController;
use App\Repository\VintageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/vintage/{id}',
            openapiContext: [
                'summary' => 'Retrieves a Vintage',
                'description' => 'Retrieves a Vintage',
                'responses' => [
                    '200' => [
                        'description' => 'Vintage',
                    ],
                    '404' => [
                        'description' => 'Vintage not found',
                    ],
                ],
            ],
            normalizationContext: [
                'groups' => [
                    'get_Vintage',
                ],
            ],
        ),
        new Get(
            uriTemplate: '/vintage/{id}/card',
            formats: [
                'png' => 'image/png',
            ],
            controller: GetVintageCardController::class,
            openapiContext: [
                'summary' => 'Retrieves a Vintage card',
                'description' => 'Retrieves a Vintage card',
                'responses' => [
                    '200' => [
                        'description' => 'Vintage card',
                        'content' => [
                            'image/png' => [
                                'schema' => [
                                    'type' => 'string',
                                    'format' => 'binary',
                                ],
                            ],
                        ],
                    ],
                    '404' => [
                        'description' => 'Vintage not found',
                    ],
                ],
            ],
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Retrieves a Vintage collection',
                'description' => 'Retrieves a Vintage collection that contains all the existing Vintage',
                'responses' => [
                    '200' => [
                        'description' => 'All the vintages',
                    ],
                ],
            ],
            normalizationContext: [
                'groups' => [
                    'get_Vintage',
                ],
            ],
        ),
    ], order: ['name' => 'ASC']
)]
#[ORM\Entity(repositoryClass: VintageRepository::class)]
class Vintage
{
    #[Groups(['get_Vintage'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get_Vintage'])]
    #[ORM\Column(length: 255)]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'Aÿ',
        ]
    )]

    private ?string $name = null;

    #[Groups(['get_Vintage'])]
    #[ORM\Column]
    #[ApiProperty(
        openapiContext: [
            'type' => 'float',
            'example' => '43.5',
        ]
    )]
    private ?float $latitude = null;

    #[ApiProperty(
        openapiContext: [
            'type' => 'float',
            'example' => '43.5',
        ]
    )]
    #[Groups(['get_Vintage'])]
    #[ORM\Column]
    private ?float $longitude = null;

    #[ApiProperty(
        openapiContext: [
            'type' => 'float',
            'example' => '43.5',
        ]
    )]
    #[Groups(['get_Vintage'])]
    #[ORM\Column]
    private ?float $size = null;


    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $card = null;

    #[Groups(['get_Vintage'])]
    #[ORM\ManyToOne(inversedBy: 'vintages')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(
        openapiContext: [
            'type' => 'path',
            'example' => 'api/district/1',
        ]
    )]
    private ?District $district = null;

    #[Groups(['get_Vintage'])]
    #[ORM\ManyToOne(inversedBy: 'vintages')]
    #[ApiProperty(
        openapiContext: [
            'type' => 'array path',
            'example' => '[
            "/api/vintages/2",
            "/api/vintages/4"
            ]',
        ]
    )]
    private ?VintageType $vintage_type = null;

    #[Groups(['get_Vintage'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'array path',
            'example' => '[
            "/api/user/2",
            "/api/user/4"
            ]',
        ]
    )]
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Vintages')]
    private Collection $users;

    #[Groups(['get_Vintage'])]
    #[ORM\OneToMany(mappedBy: 'vintages', targetEntity: Benefit::class)]
    private Collection $benefits;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->benefits = new ArrayCollection();
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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function setCard($card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getVintageType(): ?VintageType
    {
        return $this->vintage_type;
    }

    public function setVintageType(?VintageType $vintage_type): self
    {
        $this->vintage_type = $vintage_type;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addVintage($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeVintage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Benefit>
     */
    public function getBenefits(): Collection
    {
        return $this->benefits;
    }

    public function addBenefit(Benefit $benefit): self
    {
        if (!$this->benefits->contains($benefit)) {
            $this->benefits->add($benefit);
            $benefit->setVintages($this);
        }

        return $this;
    }

    public function removeBenefit(Benefit $benefit): self
    {
        if ($this->benefits->removeElement($benefit)) {
            // set the owning side to null (unless already changed)
            if ($benefit->getVintages() === $this) {
                $benefit->setVintages(null);
            }
        }

        return $this;
    }
}
