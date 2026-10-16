<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class BookController extends AbstractController
{
    public function __invoke(BookRepository $bookRepository): JsonResponse
    {
        $recentBooks = $bookRepository->findRecentBooks();

        return new JsonResponse($recentBooks);
    }

}
