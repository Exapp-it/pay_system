function sendData() {
    var m_shop = '1970626524';
    var m_orderid = '1';
    var m_amount = (100).toFixed(2);
    var m_curr = 'USD';
    var m_key = 'Ваш секретный ключ';

    var arHash = [
        m_shop,
        m_orderid,
        m_amount,
        m_curr,
    ];

    arHash.push(m_key);

    var sign = arHash.join(':');
    sign = sign.toUpperCase();
    sign = sha256(sign); // Замените на соответствующий код для вычисления хеша

    fetch('/merchant/handler', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'm_shop=' + encodeURIComponent(m_shop) +
            '&m_orderid=' + encodeURIComponent(m_orderid) +
            '&m_amount=' + encodeURIComponent(m_amount) +
            '&m_curr=' + encodeURIComponent(m_curr) +
            '&m_sign=' + encodeURIComponent(sign) +
            '&form[curr[2609]]=' + encodeURIComponent('USD')
    })
        .then(function(response) {
            if (response.status === 200) {
                return response.text();
            } else {
                throw new Error('Ошибка при отправке данных: ' + response.status);
            }
        })
        .then(function(data) {
            // Здесь можно обработать ответ от сервера, если необходимо
            console.log('Ответ сервера:', data);
        })
        .catch(function(error) {
            console.error(error);
        });
}

// Вызов функции для отправки данных
sendData();
