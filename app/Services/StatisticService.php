<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;

class StatisticService
{
    /**
     * @return mixed
     */
    public function getUserCount(): mixed
    {
        return User::count();
    }

    /**
     * @return mixed
     */
    public function getUserCountToday(): mixed
    {
        return User::whereDate('created_at', Carbon::today())->count();
    }

    /**
     * @return mixed
     */
    public function getMerchantsCount(): mixed
    {
        return Merchant::count();
    }

    /**
     * @return mixed
     */
    public function getMerchantsCountToday(): mixed
    {
        return Merchant::whereDate('created_at', Carbon::today())->count();
    }

    /**
     * @return mixed
     */
    public function getApprovedPaymentsSum(): mixed
    {
        return Payment::where('approved', true)->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedPaymentsSumToday(): mixed
    {
        return Payment::where('approved', true)->whereDate('created_at', Carbon::today())->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedPaymentsSumLast7Days(): mixed
    {
        return Payment::where('approved', true)
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
            ->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedPaymentsSumThisMonth(): mixed
    {
        return Payment::where('approved', true)
            ->whereMonth('created_at', Carbon::today()->month)
            ->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedWithdrawalsSum(): mixed
    {
        return Withdrawal::where('approved', true)->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedWithdrawalsSumToday(): mixed
    {
        return Withdrawal::where('approved', true)->whereDate('created_at', Carbon::today())->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedWithdrawalsSumLast7Days(): mixed
    {
        return Withdrawal::where('approved', true)
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
            ->sum('amount_default_currency');
    }

    /**
     * @return mixed
     */
    public function getApprovedWithdrawalsSumThisMonth(): mixed
    {
        return Withdrawal::where('approved', true)
            ->whereMonth('created_at', Carbon::today()->month)
            ->sum('amount_default_currency');
    }
}
