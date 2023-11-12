@extends('layouts.user')

@section('title', 'Транзакции')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white md:w-1/2 border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
            <hr class="mb-2">
            <div class="flex justify-between mb-6">
                <h1 class="text-lg font-bold">{{__('Операция')}}</h1>
                <div class="text-gray-700 font-semibold">
                    <div>&#8470; - {{$transaction->id}}</div>
                </div>
            </div>
            <table class="w-full mb-8">
                <thead>
                <tr>
                    <th class="text-left font-bold text-gray-700">Тип операции:</th>
                    <th class="text-right font-bold text-gray-700">{{$transaction->type == 'payIn' ? __('ввод') : __('вывод')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left text-gray-700">{{__('Дата операции:')}}</td>
                    <td class="text-right text-gray-700">{{$transaction->created_at->format('d-m-Y H:i:s')}}</td>
                </tr>

                <tr>
                    <td class="text-left text-gray-700">{{__('ID операции:')}}</td>
                    <td class="text-right text-gray-700">{{$transaction->id}}</td>
                </tr>

                <tr>
                    <td class="text-left text-gray-700">{{__('Платежная система:')}}</td>
                    <td class="text-right text-gray-700">{{$transaction->type === 'payIn' ? $transaction->payment->system->title : $transaction->withdrawal->paymentSystem->title}}</td>
                </tr>

                <tr>
                    <td class="text-left text-gray-700">{{__('Статус:')}}</td>
                    <td class="text-right text-gray-700">{{ $transaction->confirmed ? __('выполнен') : '' }}</td>
                </tr>

                @if($transaction->type === 'payIn')

                    <tr>
                        <td class="text-left text-gray-700">{{__('Сумма:')}}</td>
                        <td class="text-right text-gray-700">
                            <p>{{moneyFormat($transaction->amount - calculatePercent($transaction->amount, $transaction->merchant->percent))}} {{$transaction->currency}}</p>
                            <p>{{moneyFormat($transaction->payment->amount_default_currency - calculatePercent($transaction->amount, $transaction->merchant->percent))}} {{config('payment.default_currency.name')}}</p>
                        </td>
                    </tr>
                @endif

                @if($transaction->type === 'payOut')
                    <tr>
                        <td class="text-left text-gray-700">{{__('Сумма:')}}</td>
                        <td class="text-right text-gray-700">
                            <p>{{moneyFormat($transaction->amount - calculatePercent($transaction->amount, $transaction->merchant->percent))}} {{$transaction->currency}}</p>
                            <p>{{moneyFormat($transaction->withdrawal->amount_default_currency - calculatePercent($transaction->amount, $transaction->merchant->percent))}} {{config('payment.default_currency.name')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left text-gray-700">{{__('Сумма с комиссией:')}}</td>
                        <td class="text-right text-gray-700">
                            <p>{{moneyFormat($transaction->amount)}} {{$transaction->currency}}</p>
                            <p>{{moneyFormat($transaction->withdrawal->amount_default_currency)}} {{config('payment.default_currency.name')}}</p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            <hr class="mb-2">
            @if($transaction->response)
                <textarea rows="5" disabled class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none">{{$transaction->response->data}}</textarea>

            @endif
        </div>
    </div>
@endsection
