<template>
    <Head :title="title"/>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Платежи</h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div id="payment-container">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Əməliyyat
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Kassa
                                </th>


                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Login
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Məbləğ
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Order
                                </th>


                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Sistem
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Tarix
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>

                            <tbody class="bg-white">
                            <tr v-for="payment in payments.data" :key="payment.id">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ payment.id }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <Link :href="route('vue.transaction', payment.transaction.id)"
                                          class="text-sm leading-5 font-bold text-gray-900">
                                        {{ payment.transaction.id }}
                                    </Link>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ payment.merchant.title }}
                                        <span class="block">({{ payment.merchant.m_id }})</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ payment.username }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ payment.amount }}
                                        <span>{{ payment.currency }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="w-12 text-sm leading-5 text-gray-900">
                                        <a :href="'/storage/' + payment.pay_screen" target="_blank">
                                            <img class="w-full" :src="'/storage/' + payment.pay_screen" alt="">
                                        </a>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ payment.system.title }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ formatDate(payment.created_at) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <div class="flex justify-center">
                                            <template v-if="payment.approved">
                                                    <span
                                                        class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-green-100">Подтвержден</span>
                                            </template>

                                            <template v-else-if="payment.canceled">
                                                    <span
                                                        class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-red-100">Отклонен</span>
                                            </template>
                                            <template v-else>
                                                <div class="flex flex-wrap gap-2 items-center justify-center">
                                                    <button
                                                        class="px-3 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-white"
                                                        @click="approvePayment(payment.id)">
                                                        Подтвердить
                                                    </button>
                                                    <button
                                                        class="px-3 py-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 shadow text-white"
                                                        @click="rejectPayment(payment.id)">
                                                        Отклонить
                                                    </button>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--                        <Pagination :links="payments.links"/>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
import Admin from '../../Layouts/Admin.vue';
import {Head, Link} from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';
import {onBeforeUnmount, onMounted, ref, reactive} from "vue";


// let payments = reactive ([]);

const {title, payments} = defineProps(['title', 'payments']);

const formatDate = (dateString) => {
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU', options);
};

const approvePayment = (paymentId) => {
    console.log(`Payment ${paymentId} approved`);
};

const rejectPayment = (paymentId) => {
    console.log(`Payment ${paymentId} rejected`);
};

const fetchPayments = () => {
    fetch(route('vue.payments.update'))
        .then(response => {
            payments.value = response.data.payments;
        })
        .catch(error => {
            console.error('Ошибка при получении платежей:', error);
        });

}

onMounted(() => {
    fetchPayments(); // Вызывайте сразу при загрузке страницы

    // Затем установите интервал для периодического опроса
    setInterval(() => {
        fetchPayments();
    }, 5000); // Например, каждые 5 секунд
});

// const fetchPayments = async () => {
//     try {
//         const response = await fetch(route('vue.payments.update'));
//         if (!response.ok) {
//             throw new Error(`Ошибка HTTP: ${response.status}`);
//         }
//         const data = await response.json();
//         payments.value = data.newPayments; // Используйте data.newPayments
//     } catch (error) {
//         console.error('Ошибка при получении данных:', error);
//     }
// };
//
//
// const pollingTimer = setInterval(fetchPayments, 5000);
//
// onBeforeUnmount(() => {
//     clearInterval(pollingTimer);
// });
//


</script>
