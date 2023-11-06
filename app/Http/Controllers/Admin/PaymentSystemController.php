<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PaymentSystemController extends Controller
{
    public function index()
    {
        return view('admin.ps.index');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.ps.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/payment_systems', $fileName);
            $data['logo'] = $fileName;
        }
        dd($data);

        return back()->with('success', 'Данные успешно сохранены.');
    }

}
