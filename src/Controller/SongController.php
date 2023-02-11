<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    #[Route('/api/songs', name: 'app_song')]
    public function index(): JsonResponse
    {
        $data = [
            [
                'albumId' => 1,
                'id' => 1,
                'title' => 'Les etoiles vagabondes',
                'description' => 'Nekfeu'
            ],
            [
                'albumId' => 2,
                'id' => 2,
                'title' => 'Les etoiles vagabondes',
                'description' => 'Nekfeu'
            ],
            [
                'albumId' => 3,
                'id' => 3,
                'title' => 'Les etoiles vagabondes',
                'description' => 'Nekfeu'
            ]
        ];

        return new JsonResponse($data);
    }
}
