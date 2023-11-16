// resources/js/payments.js
import axios from 'axios';

const updatePayments = async () => {
    try {
        const response = await axios.get('/admin/payments/fetch');
        const paymentContainer = document.getElementById('payment-container');
        paymentContainer.innerHTML = response.data.html;
    } catch (error) {
        console.error(error);
    }
};

// Вызовите функцию для первоначальной загрузки данных
updatePayments();

// Периодически обновляйте данные каждые 5 секунд
setInterval(updatePayments, 5000);
