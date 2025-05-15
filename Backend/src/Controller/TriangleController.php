<?php

namespace App\Controller;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\TriangleRepository;

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


    #[Route('/triangles/all', name: 'get_all_triangles', methods: ['GET'])]
    public function getAllTriangles(TriangleRepository $triangleRepository): JsonResponse
    {
        $triangles = $triangleRepository->findAll();
    
        $data = [];
    
        foreach ($triangles as $triangle) {
            $data[] = [
                'id' => $triangle->getId(),
                'a' => $triangle->getA(),
                'b' => $triangle->getB(),
                'c' => $triangle->getC(),
            ];
        }
    
        return $this->json($data);
    }

    
    #[Route('/triangle/id/{id}', name: 'get_triangle_by_id', methods: ['GET'])]
    public function getTriangleById(int $id, TriangleRepository $triangleRepository): JsonResponse
    {
        $triangle = $triangleRepository->find($id);

        if (!$triangle) {
            return $this->json(['error' => 'Triangle not found'], 404);
        }

        return $this->json([
            'id' => $triangle->getId(),
            'a' => $triangle->getA(),
            'b' => $triangle->getB(),
            'c' => $triangle->getC(),
        ]);
    }


    #[Route('/triangle/{id}/edit', name: 'edit_triangle', methods: ['POST'])]
public function editTriangle(
    int $id,
    EntityManagerInterface $em,
    \Symfony\Component\HttpFoundation\Request $request,
    TriangleRepository $triangleRepository
): JsonResponse {
    $triangle = $triangleRepository->find($id);

    if (!$triangle) {
        return $this->json(['error' => 'Triangle not found'], 404);
    }

    $content = $request->getContent();
    $data = json_decode($content, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return $this->json(['error' => 'Invalid JSON: ' . json_last_error_msg()], 400);
    }

    if (!isset($data['a'], $data['b'], $data['c'])) {
        return $this->json(['error' => 'Missing side values.'], 400);
    }

    $a = floatval($data['a']);
    $b = floatval($data['b']);
    $c = floatval($data['c']);

    // Basic validation
    if ($a <= 0 || $b <= 0 || $c <= 0) {
        return $this->json(['error' => 'Sides must be greater than 0.'], 400);
    }

    // Triangle inequality check
    if ($a + $b <= $c || $a + $c <= b || $b + $c <= $a) {
        return $this->json(['error' => 'Invalid triangle sides.'], 400);
    }

    // Update values
    $triangle->setA($a);
    $triangle->setB($b);
    $triangle->setC($c);

    $em->flush();

    return $this->json([
        'message' => 'Triangle updated successfully',
        'triangle' => [
            'id' => $triangle->getId(),
            'a' => $triangle->getA(),
            'b' => $triangle->getB(),
            'c' => $triangle->getC(),
            'surface' => $triangle->getSurface(),
            'circumference' => $triangle->getCircumference(),
        ]
    ]);
}



}

