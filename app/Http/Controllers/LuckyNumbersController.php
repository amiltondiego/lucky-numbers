<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\LuckyNumberService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class LuckyNumbersController extends Controller
{
    public function __construct(
        private ResponseFactory $response,
        private LuckyNumberService $luckyNumberService,
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            return $this->response->json(
                $this->luckyNumberService->allNumbers()
            );
        } catch (InvalidArgumentException $exception) {
            return $this->response->json(
                [],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function create(): JsonResponse
    {
        return $this->response->json(
            $this->luckyNumberService->registerLuckyNumber()
        );
    }
}
