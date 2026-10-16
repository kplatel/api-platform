<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class UserController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $data = [
            'message' => 'Ceci est une route personnalisée.',
            'timestamp' => time(),
        ];

        return new JsonResponse($data);
    }
}
