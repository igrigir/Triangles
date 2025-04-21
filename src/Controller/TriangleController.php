<?php

namespace App\Controller;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TriangleController extends AbstractController
{
    #[Route('/triangle/{a}/{b}/{c}', name: 'add_triangle', methods: ['POST'])]
    public function addTriangle(
        float $a,
        float $b,
        float $c,
        EntityManagerInterface $em
    ): JsonResponse {
        $triangle = new Triangle();
        $triangle->setA($a);
        $triangle->setB($b);
        $triangle->setC($c);

        $em->persist($triangle);
        $em->flush();

        return $this->json([
            'message' => 'Triangle saved',
            'triangle' => [
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'surface' => $triangle->getSurface(),
                'circumference' => $triangle->getCircumference(),
            ]
        ]);
    }

    #[Route('/triangles', name: 'triangle_summary', methods: ['GET'])]
    public function getSummary(\App\Service\GeometryCalculator $calculator): JsonResponse
    {
        return $this->json($calculator->getSummary());
    }



}

