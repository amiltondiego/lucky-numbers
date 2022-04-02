<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property array $numbers
 *
 * @method Builder select(array $collumn)
 */
class LuckyNumber extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $casts = [
        'numbers' => 'array',
    ];
}
