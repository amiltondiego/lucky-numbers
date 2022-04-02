<?php

declare(strict_types=1);

namespace Tests\Unit\Controllers;

use App\Http\Controllers\LuckyNumbersController;
use App\Services\LuckyNumberService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @internal
 */
class LuckyNumbersControllerTest extends TestCase
{
    public function testCreateSuccess()
    {
        /** @var ResponseFactory $response */
        $response = $this->mock(ResponseFactory::class, function (MockInterface $mock) {
            $mock->shouldReceive('json')->once()->andReturn((new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST)));
        });
        /** @var LuckyNumberService $service */
        $service = $this->mock(LuckyNumberService::class, function (MockInterface $mock) {
            $mock->shouldReceive('allNumbers')->once()->andThrow(InvalidArgumentException::class);
        });

        $controller = new LuckyNumbersController($response, $service);

        $this->assertSame(JsonResponse::HTTP_BAD_REQUEST, $controller->index()->getStatusCode());
    }
}
