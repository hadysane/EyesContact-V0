<?php

namespace App\Entity;

use App\Repository\ColorAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorAttributeRepository::class)]
class ColorAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\OneToMany(mappedBy: 'color', targetEntity: Variation::class)]
    private Collection $variations;

    public function __construct()
    {
        $this->variations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Variation>
     */
    public function getVariations(): Collection
    {
        return $this->variations;
    }

    public function addVariation(Variation $variation): self
    {
        if (!$this->variations->contains($variation)) {
            $this->variations->add($variation);
            $variation->setColor($this);
        }

        return $this;
    }

    public function removeVariation(Variation $variation): self
    {
        if ($this->variations->removeElement($variation)) {
            // set the owning side to null (unless already changed)
            if ($variation->getColor() === $this) {
                $variation->setColor(null);
            }
        }

        return $this;
    }
}
