<?php

namespace App\Entity;

use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $size = null;

    #[ORM\Column(length: 255)]
    private ?string $color_code = null;

    #[ORM\OneToMany(mappedBy: 'district', targetEntity: Vintage::class)]
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

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(?float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getColorCode(): ?string
    {
        return $this->color_code;
    }

    public function setColorCode(string $color_code): self
    {
        $this->color_code = $color_code;

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
            $vintage->setDistrict($this);
        }

        return $this;
    }

    public function removeVintage(Vintage $vintage): self
    {
        if ($this->vintages->removeElement($vintage)) {
            // set the owning side to null (unless already changed)
            if ($vintage->getDistrict() === $this) {
                $vintage->setDistrict(null);
            }
        }

        return $this;
    }
}
