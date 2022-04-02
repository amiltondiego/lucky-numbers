<?php

namespace App\Http\Controllers;

use App\Services\LuckyNumberService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class LuckyNumbersController extends Controller
{
    public function __construct(
        private ResponseFactory $response,
        private LuckyNumberService $luckyNumberService,
    ) {
    }
    public function index(): JsonResponse
    {
        return $this->response->json(
            $this->luckyNumberService->allNumbers()
        );
    }

    public function create(): JsonResponse
    {
        return $this->response->json(
            $this->luckyNumberService->registerLuckyNumber()
        );
    }
}
