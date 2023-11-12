<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\StatisticService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function index()
    {
        $statisticService = new StatisticService();

        $statistics = (object)[
            'usersCount' => $statisticService->getUserCount(),
            'usersCountToday' => $statisticService->getUserCountToday(),
            'merchantsCount' => $statisticService->getMerchantsCount(),
            'merchantsCountToday' => $statisticService->getMerchantsCountToday(),
            'approvedPaymentsSum' => $statisticService->getApprovedPaymentsSum(),
            'approvedPaymentsSumToday' => $statisticService->getApprovedPaymentsSumToday(),
            'approvedPaymentsSumLast7Days' => $statisticService->getApprovedPaymentsSumLast7Days(),
            'approvedPaymentsSumThisMonth' => $statisticService->getApprovedPaymentsSumThisMonth(),
            'approvedWithdrawalsSum' => $statisticService->getApprovedWithdrawalsSum(),
            'approvedWithdrawalsSumToday' => $statisticService->getApprovedWithdrawalsSumToday(),
            'approvedWithdrawalsSumLast7Days' => $statisticService->getApprovedWithdrawalsSumLast7Days(),
            'approvedWithdrawalsSumThisMonth' => $statisticService->getApprovedWithdrawalsSumThisMonth(),
        ];

        return view('admin.index', ['statistics' => $statistics]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function users(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->paginate(10);

        return view('admin.users', ['users' => $users]);
    }


    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function history(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $payments = Payment::query()->orderByDesc('created_at')->get();
        $withdrawals = Withdrawal::query()->orderByDesc('created_at')->get();

        $operations = new Collection($payments->merge($withdrawals));
        $operations = $operations->sortByDesc('created_at');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageItems = $operations->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $operations = new LengthAwarePaginator($currentPageItems, $operations->count(), $perPage);

        return view('admin.history', ['operations' => $operations]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function transaction($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $transaction = Transaction::find($id);

        return view('admin.transaction', ['transaction' => $transaction]);
    }

}
