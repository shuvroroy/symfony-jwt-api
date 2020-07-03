<?php

declare(strict_types=1);

namespace App\Controller\API\V1;

use App\Traits\HasJsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DefaultController extends AbstractController
{
    use HasJsonResponse;

    /**
     * @Route("/", name="default")
     * @Route("/api", name="api_default")
     * @Route("/api/v1", name="api_v1_default")
     */
    public function index(): JsonResponse
    {
        return $this->createResponse('Welcome to Symfony 5.1 API!', Response::HTTP_OK);
    }
}
