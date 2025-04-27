<?php

namespace App\Controller;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TriangleController extends AbstractController
{

    //Create and save new Triangle entity in database
    #[Route('/triangle/{a}/{b}/{c}', name: 'add_triangle', methods: ['POST'])]
    public function addTriangle(
        float $a,
        float $b,
        float $c,
        EntityManagerInterface $em
    ): JsonResponse {

        // Basic validation
        if ($a <= 0 || $b <= 0 || $c <= 0) {
            return $this->json([
                'error' => 'Sides must be greater than 0.'
            ], 400);
        }
    
        // Triangle inequaliti validation
        if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
            return $this->json([
                'error' => 'Invalid triangle sides. Sum of any two sides must be greater than the third side.'
            ], 400);
        }
    
        // If validation passed, create and save triangle
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

    
    //Get a summary of all triangles using GeometryCalculator service
    #[Route('/triangles', name: 'triangle_summary', methods: ['GET'])]
    public function getSummary(\App\Service\GeometryCalculator $calculator): JsonResponse
    {
        return $this->json($calculator->getSummary());
    }



}

