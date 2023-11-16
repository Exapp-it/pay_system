@extends('layouts.admin')
@section('title', 'Платежи')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Платежи') }}</h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div id="payment-container">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('ID')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Əməliyyat')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Kassa')}}
                                </th>


                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Login')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Məbləğ')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Order')}}
                                </th>


                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Sistem')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Tarix')}}
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>

                            <tbody id="tableBody" class="bg-white">
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $payment->id }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{route('admin.transaction', $payment->transaction->id)}}"
                                           class="text-sm leading-5 text-gray-900">
                                            {{ $payment->transaction->id }}
                                        </a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $payment->merchant->title }}
                                            <span class="block">({{$payment->merchant->m_id}})</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $payment->username }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $payment->amount }}
                                            <span>{{$payment->currency}}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="w-12 text-sm leading-5 text-gray-900">
                                            <a href="{{asset('storage/' . $payment->pay_screen)}}" target="_blank">
                                                <img class="w-full" src="{{asset('storage/' . $payment->pay_screen)}}"
                                                     alt="">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $payment->system->title }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $payment->created_at->format('Y-m-d H:i:s') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <div class="flex justify-center">
                                                @if ($payment->approved)
                                                    <span
                                                        class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-green-100">
                                                    {{__('Подтвержден')}}
                                                </span>
                                                @elseif($payment->canceled)
                                                    <span
                                                        class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-green-100">
                                                        {{__('Отклонен')}}
                                                </span>
                                            </div>
                                            @else
                                                <div class="flex flex-wrap gap-2 items-center justify-center">
                                                    <form action="{{route('admin.payment.approve', $payment->id)}}"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                                class="px-5 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400 shadow text-black">
                                                            {{__('Подтвердить')}}
                                                        </button>
                                                    </form>

                                                    <form action="{{route('admin.payment.reject', $payment->id)}}"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                                class="px-3 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-white">
                                                            {{__('Отклонить')}}
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $payments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var lastUpdated = '';

        function updateNewPayments() {
            $.ajax({
                url: '{{ route("admin.payments.fetch") }}',
                method: 'GET',
                dataType: 'json',
                data: {last_updated: lastUpdated},
                success: function (data) {
                    // $('#tableBody').empty();

                    $.each(data.newPayments, function (index, payment) {
                        var transactionLink = payment.transaction
                            ? '<a href="{{ route("admin.transaction", "") }}/' + payment.transaction.id + '">' + payment.transaction.id + '</a>'
                            : 'N/A';

                        var approvedStatus = payment.approved
                            ? '<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-green-100">{{__("Подтвержден")}}</span>'
                            : (payment.canceled
                                    ? '<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-green-100">{{__("Отклонен")}}</span>'
                                    : '<div class="flex flex-wrap gap-2 items-center justify-center">' +
                                    '<form action="{{ route("admin.payment.approve", "") }}/' + payment.id + '" method="POST">' +
                                    '@csrf' +
                                    '<button type="submit" class="px-5 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400 shadow text-black">{{__("Подтвердить")}}</button>' +
                                    '</form>' +
                                    '<form action="{{ route("admin.payment.reject", "") }}/' + payment.id + '" method="POST">' +
                                    '@csrf' +
                                    '<button type="submit" class="px-3 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-white">{{__("Отклонить")}}</button>' +
                                    '</form>' +
                                    '</div>'
                            );

                        var createdDate = new Date(payment.created_at);
                        var formattedDate = createdDate.toLocaleString();
                        var row = '<tr class="border-b border-gray-200">' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + payment.id + '</div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<a href="{{route("admin.transaction", ' + payment.transaction.id + ')}}" class="text-sm leading-5 text-gray-900">' + (payment.transaction ? payment.transaction.id : 'N/A') + '</a>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + payment.merchant.title +
                            '<span class="block">(' + payment.merchant.m_id + ')</span>' +
                            '</div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + payment.username + '</span></div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + payment.amount + ' <span>' + payment.currency + '</span></div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="w-12 text-sm leading-5 text-gray-900">' +
                            '<a href="{{asset("storage/")}}/' + payment.pay_screen + '" target="_blank">' +
                            '<img class="w-full" src="{{asset("storage/")}}/' + payment.pay_screen + '" alt="">' +
                            '</a>' +
                            '</div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + payment.system.title + '</div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' + formattedDate + '</div>' +
                            '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap">' +
                            '<div class="text-sm leading-5 text-gray-900">' +
                            '<div class="flex justify-center">' +
                            (payment.approved ? '<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-green-100">{{__("Подтвержден")}}</span>' :
                                    (payment.canceled ? '<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-green-100">{{__("Отклонен")}}</span>' :
                                            '<div class="flex flex-wrap gap-2 items-center justify-center">' +
                                            '<form action="payments/' + payment.id + '/approve" method="POST">' +
                                            '@csrf' +
                                            '<button type="submit" class="px-5 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400 shadow text-black">{{__("Подтвердить")}}</button>' +
                                            '</form>' +
                                            '<form action="payments/' + payment.id + '/reject" method="POST">' +
                                            '@csrf' +
                                            '<button type="submit" class="px-3 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-white">{{__("Отклонить")}}</button>' +
                                            '</form>' +
                                            '</div>'
                                    )
                            ) +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';


                        $('#tableBody').prepend(row);
                    });
                    lastUpdated = new Date().toISOString();
                },
                error: function (error) {
                    console.log(error);

                    if (error.responseJSON && error.responseJSON.message) {
                        console.log('SQL Query:', error.responseJSON.message);
                    }
                }
            });
        }

        $(document).ready(function () {
            setInterval(updateNewPayments, 5000);
        });

    </script>
@endsection
