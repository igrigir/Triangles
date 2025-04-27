<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TriangleRepository::class)]
class Triangle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $a = null;

    #[ORM\Column]
    private ?float $b = null;

    #[ORM\Column]
    private ?float $c = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?float
    {
        return $this->a;
    }

    public function setA(float $a): static
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?float
    {
        return $this->b;
    }

    public function setB(float $b): static
    {
        $this->b = $b;

        return $this;
    }

    public function getC(): ?float
    {
        return $this->c;
    }

    public function setC(float $c): static
    {
        $this->c = $c;

        return $this;
    }



    public function getCircumference(): float
    {
        return $this->a + $this->b + $this->c;
    }
    
    public function getSurface(): float
    {
        $s = $this->getCircumference() / 2;
    
        $areaSquared = $s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c);
    
        if ($areaSquared <= 0) {
            // Impossible triangle, return surface = 0
            return 0.0;
        }
    
        return sqrt($areaSquared);
    }


}
