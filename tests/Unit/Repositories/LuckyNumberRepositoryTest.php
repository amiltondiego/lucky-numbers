<?php

declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Models\LuckyNumber;
use App\Repositories\LuckyNumberRepository;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @internal
 */
class LuckyNumberRepositoryTest extends TestCase
{
    public function testCreateSuccess()
    {
        /** @var LuckyNumber */
        $class = $this->mock(LuckyNumber::class, function (MockInterface $mock){
            $mock->shouldReceive('refresh')->once();
            $mock->shouldReceive('setAttribute')->once();
            $mock->shouldReceive('save')->once()->andReturnTrue();
        });

        $repository = new LuckyNumberRepository($class);

        $this->assertTrue($repository->create([
            1,
            2,
        ]));

    }

    public function testCreateFail()
    {
        /** @var LuckyNumber */
        $class = $this->mock(LuckyNumber::class, function (MockInterface $mock){
            $mock->shouldReceive('refresh')->once();
            $mock->shouldReceive('setAttribute')->once();
            $mock->shouldReceive('save')->once()->andReturnFalse();
        });

        $repository = new LuckyNumberRepository($class);

        $this->assertFalse($repository->create([
            1,
            2,
        ]));

    }

    public function testListWithData()
    {
        /** @var LuckyNumber */
        $class = $this->mock(LuckyNumber::class, function (MockInterface $mock){
            $mock->shouldReceive('refresh')->once();
            $mock->shouldReceive('select')->once()->andReturnSelf();
            $mock->shouldReceive('orderBy')->once()->andReturnSelf();
            $mock->shouldReceive('limit')->once()->andReturnSelf();
            $mock->shouldReceive('get')->once()->andReturnSelf();
            $mock->shouldReceive('toArray')->once()->andReturn([[1]]);
        });

        $repository = new LuckyNumberRepository($class);

        $return = $repository->list();
        $this->assertIsArray($return);
        $this->assertCount(1, $return);

    }

    public function testListWithoutData()
    {
        /** @var LuckyNumber */
        $class = $this->mock(LuckyNumber::class, function (MockInterface $mock){
            $mock->shouldReceive('refresh')->once();
            $mock->shouldReceive('select')->once()->andReturnSelf();
            $mock->shouldReceive('orderBy')->once()->andReturnSelf();
            $mock->shouldReceive('limit')->once()->andReturnSelf();
            $mock->shouldReceive('get')->once()->andReturnSelf();
            $mock->shouldReceive('toArray')->once()->andReturn([]);
        });

        $repository = new LuckyNumberRepository($class);

        $return = $repository->list();
        $this->assertIsArray($return);
        $this->assertCount(0, $return);

    }
}
