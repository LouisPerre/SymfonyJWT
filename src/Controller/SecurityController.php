<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/api/login_check', name: 'api_login')]
    public function api_login(): JsonResponse
    {
        $user = $this->getUser();
        return new JsonResponse([
            'email' => $user->getUserIdentifier(),
            'roles' => $user->getRoles()
        ]);
    }
}
