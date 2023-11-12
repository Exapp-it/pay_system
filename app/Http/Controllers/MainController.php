<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function index()
    {
        return redirect()->route('history');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function history(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);


        return view('user.history', ['operations' => $transactions]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function transaction($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $transaction = Transaction::find($id);

        return view('user.transaction', ['transaction' => $transaction]);
    }
}
