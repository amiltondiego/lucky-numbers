<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Repositories\LuckyNumberRepository;
use App\Services\LuckyNumberService;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @internal
 */
class LuckyNumbersRepositoryTest extends TestCase
{
    public function testAllNumbersWithData()
    {
        /** @var LuckyNumberRepository */
        $repository = $this->mock(LuckyNumberRepository::class, function (MockInterface $mock){
            $mock->shouldReceive('list')->once()->andReturn([[1]]);
        });

        $service = new LuckyNumberService($repository);

        $return = $service->allNumbers();
        $this->assertIsArray($return);
        $this->assertCount(1, $return);

    }

    public function testAllNumbersWithoutData()
    {
        /** @var LuckyNumberRepository */
        $repository = $this->mock(LuckyNumberRepository::class, function (MockInterface $mock){
            $mock->shouldReceive('list')->once()->andReturn([]);
        });

        $service = new LuckyNumberService($repository);

        $return = $service->allNumbers();
        $this->assertIsArray($return);
        $this->assertCount(0, $return);

    }

    public function testRegisterLuckyNumberWithTotalDefault()
    {
        /** @var LuckyNumberRepository */
        $repository = $this->mock(LuckyNumberRepository::class, function (MockInterface $mock){
            $mock->shouldReceive('create')->once()->andReturnTrue();
        });

        $service = new LuckyNumberService($repository);

        $return = $service->registerLuckyNumber();
        $this->assertIsArray($return);
        $this->assertCount(6, $return);

    }

    public function testRegisterLuckyNumberForceTotalNumbers()
    {
        /** @var LuckyNumberRepository */
        $repository = $this->mock(LuckyNumberRepository::class, function (MockInterface $mock){
            $mock->shouldReceive('create')->once()->andReturnTrue();
        });

        $service = new LuckyNumberService($repository);

        $return = $service->registerLuckyNumber(2);
        $this->assertIsArray($return);
        $this->assertCount(2, $return);

    }

    public function testRegisterLuckyNumberVerifyRandNumber()
    {
        /** @var LuckyNumberRepository */
        $repository = $this->mock(LuckyNumberRepository::class, function (MockInterface $mock){
            $mock->shouldReceive('create')->once()->andReturnTrue();
        });

        $service = new LuckyNumberService($repository);

        $return = $service->registerLuckyNumber(2);
        $this->assertIsArray($return);
        $this->assertCount(2, $return);
        $this->assertNotSame($return[0], $return[1]);

    }
}
