<?php

namespace App\Service;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;

/*
    Service responsible for calculating total surface and circumference 
    of all stored triangles in the database
*/

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

        // itterate over each triangle and accumulate the surface and circumference
        foreach ($triangles as $triangle) {
            $totalSurface += $triangle->getSurface();
            $totalCircumference += $triangle->getCircumference();
        }

        // retturn summary 
        return [
            'number_of_triangles' => count($triangles),
            'total_surface' => round($totalSurface, 2),
            'total_circumference' => round($totalCircumference, 2),
        ];
    }
}
