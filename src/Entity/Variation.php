<?php

namespace App\Entity;

use App\Repository\VariationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariationRepository::class)]
class Variation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'variation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'variations')]
    private ?ColorAttribute $color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getColor(): ?ColorAttribute
    {
        return $this->color;
    }

    public function setColor(?ColorAttribute $color): self
    {
        $this->color = $color;

        return $this;
    }
}
