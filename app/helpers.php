<?php

if (!function_exists('calculatePercent')) {
    /**
     * @param $totalAmount
     * @param $percentage
     * @return float|int
     */
    function calculatePercent($totalAmount, $percentage): float|int
    {
        return $totalAmount * ($percentage / 100);
    }
}

if (!function_exists('moneyFormat')) {
    /**
     * @param float $amount
     * @return string
     */
    function moneyFormat(float $amount): string
    {
        return number_format($amount, 2, '.', ' ');

    }
}
