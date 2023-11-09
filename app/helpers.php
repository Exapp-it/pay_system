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
