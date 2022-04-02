<?php

namespace App\Repositories;

use App\Models\LuckyNumber;

class LuckyNumberRepository
{
    public function __construct(
        private LuckyNumber $class
    ) {
        
    }

    public function create(array $numbers): bool
    {
        $this->class->refresh();
        $this->class->numbers = $numbers;
        return $this->class->save();
    }

    public function list(int $limit = 10): array
    {
        $this->class->refresh();
        return $this->class->select(['numbers'])->orderBy('id', 'desc')
            ->limit($limit)->get()
            ->toArray();
    }
}
