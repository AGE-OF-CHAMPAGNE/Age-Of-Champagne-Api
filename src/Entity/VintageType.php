<?php

namespace App\Entity;

use App\Repository\VintageTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VintageTypeRepository::class)]
class VintageType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

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
