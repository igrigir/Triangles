<?php

namespace App\Service;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;

class GeometryCalculator
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getSummary(): array
    {
        $triangles = $this->em->getRepository(Triangle::class)->findAll();

        $totalSurface = 0;
        $totalCircumference = 0;

        foreach ($triangles as $triangle) {
            $totalSurface += $triangle->getSurface();
            $totalCircumference += $triangle->getCircumference();
        }

        return [
            'number_of_triangles' => count($triangles),
            'total_surface' => round($totalSurface, 2),
            'total_circumference' => round($totalCircumference, 2),
        ];
    }
}
