<?php

namespace App\Services;

use App\Repositories\LuckyNumberRepository;

class LuckyNumberService
{
    public function __construct(
        private LuckyNumberRepository $luckyNumberRepository
    ) {
        
    }
    public function allNumbers(): array
    {
        return $this->luckyNumberRepository->list();
    }

    public function registerLuckyNumber(int $totalNumbers = 6): array
    {
        $numbers = $this->randNumbers($totalNumbers);
        $this->luckyNumberRepository->create(
            $numbers
        );

        return $numbers;
    }

    private function randNumbers(int $totalNumbers = 6, array $numbers = []): array
    {
        $number = $this->getRandNumber();
        if (!in_array($number, $numbers)) {
            $numbers[] = $number;
        }

        if ($totalNumbers === count($numbers)) {
            return $numbers;
        } else {
            return $this->randNumbers($totalNumbers, $numbers);
        }
    }

    private function getRandNumber(int $min = 0, int $max = 60): int
    {
        return rand($min, $max);
    }
}
