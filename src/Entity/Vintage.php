<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetVintageCardController;
use App\Repository\VintageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
                    'get_Vintage', 'fetchVintage',
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
                    'get_Vintage', 'fetchVintage',
                ],
            ],
        ),
    ], order: ['city' => 'ASC']
)]
#[ORM\Entity(repositoryClass: VintageRepository::class)]
class Vintage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?float $size = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $card = null;

    #[ORM\ManyToOne(inversedBy: 'vintages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?District $district = null;

    #[ORM\ManyToOne(inversedBy: 'vintages')]
    private ?VintageType $vintage_type = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Vintages')]
    private Collection $users;

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
