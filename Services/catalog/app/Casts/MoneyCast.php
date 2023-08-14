<?php

declare(strict_types=1);

namespace App\Casts;

use Brick\Money\Money;
use Brick\Math\Exception\MathException;
use Illuminate\Database\Eloquent\Model;
use Brick\Math\Exception\NumberFormatException;
use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Math\Exception\RoundingNecessaryException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class MoneyCast implements CastsAttributes
{
    /**
     * @throws UnknownCurrencyException|NumberFormatException|RoundingNecessaryException
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): Money
    {
        return Money::of(
            amount: $value,
            currency: 'USD'
        );
    }

    /**
     * @param Model $model
     * @param string $key
     * @param int $value
     * @param array $attributes
     * @return mixed
     * @throws MathException
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
