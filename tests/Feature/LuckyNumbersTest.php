<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class LuckyNumbersTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateNumber()
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
        $response->assertJsonCount(6);
    }
    
    public function testGetNumbersWithoutNumbers()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertJsonCount(0);
    }

    public function testGetNumbersWithNumbers()
    {
        $this->testCreateNumber();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }
}
