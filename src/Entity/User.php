<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(normalizationContext: ['groups' => ['get_User']])]
#[Get]
#[GetCollection]
#[Patch(
    openapiContext: [
        'description' => 'Update the User ressource of the actual User logged',
        'summary' => 'Update the User ressource of the actual User logged',
        'responses' => [
            '200' => [
                'description' => 'Patch the current user chose with the id',
            ],
            '401' => [
                'description' => 'You are not logged',
            ],
            '403' => [
                'description' => 'User logged isnt the user modified',
            ],
        ],
    ],
    normalizationContext: ['groups' => ['get_Me', 'get_User']],
    denormalizationContext: ['groups' => ['set_User', 'set_Own_User']],
    security: "(is_granted('ROLE_USER') and object == user)"
)]
#[Put(
    openapiContext: [
        'description' => 'Put the current User ressource logged.',
        'summary' => 'Put the current User ressource logged. ',
        'responses' => [
            '200' => [
                'description' => 'Put the current user chose with the id',
            ],
            '401' => [
                'description' => 'You are not logged',
            ],
            '403' => [
                'description' => 'User logged isnt the user chose with the ID',
            ],
        ],
    ],
    normalizationContext: ['groups' => ['get_Me', 'get_User']],
    denormalizationContext: ['groups' => ['set_User', 'set_Own_User']],
    security: "(is_granted('ROLE_USER') and object == user)"
)]
#[Delete(
    openapiContext: [
        'description' => 'Delete your own  User ressource ',
        'summary' => 'Delete your own User ressource ',
        'responses' => [
            '401' => [
                'description' => 'You are not logged',
            ],
            '403' => [
                'description' => 'User logged isnt a the user selected',
            ],
        ],
    ],
    security: "(is_granted('ROLE_USER') and object == user)",
)]
#[Post(
    openapiContext: [
        'description' => 'Create a User ressource',
        'summary' => 'Create a User ressource.',
        'responses' => [
            '201' => [
                'description' => 'New User ressource created',
            ],
        ],
    ],

    normalizationContext: ['groups' => ['get_Me', 'get_User']],
    denormalizationContext: ['groups' => ['set_User']]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User'])]
    private ?int $id = null;

    #[Groups(['get_User', 'set_User'])]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        message: 'this field cannot contain < > & or " ',
        match: false,
    )]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'example@example.com',
        ]
    )]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[Groups(['get_User', 'set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'array',
            'example' => "['ROLE_USER','ROLE_ADMIN']",
        ]
    )]
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Groups(['set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'StR0ng-Pa5$WoRd*§!',
        ]
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[Groups(['get_User', 'set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'Axel',
        ]
    )]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['get_User', 'set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'string',
            'example' => 'Dupont',
        ]
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['get_User', 'set_User'])]
    #[ApiProperty(
        openapiContext: [
            'type' => 'array path',
            'example' => '[
            "/api/vintages/2",
            "/api/vintages/4"
            ]',
        ]
    )]
    #[ORM\ManyToMany(targetEntity: Vintage::class, inversedBy: 'users')]
    private Collection $Vintages;

    public function __construct()
    {
        $this->Vintages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Vintage>
     */
    public function getVintages(): Collection
    {
        return $this->Vintages;
    }

    public function addVintage(Vintage $vintage): self
    {
        if (!$this->Vintages->contains($vintage)) {
            $this->Vintages->add($vintage);
        }

        return $this;
    }

    public function removeVintage(Vintage $vintage): self
    {
        $this->Vintages->removeElement($vintage);

        return $this;
    }
}
