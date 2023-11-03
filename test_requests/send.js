import http from 'http';
import querystring from 'querystring';
import crypto from 'crypto';

function sha256(input) {
    const hash = crypto.createHash('sha256');
    hash.update(input);
    return hash.digest('hex');
}

function test() {
    const shop = '619807101945';
    const order = '1';
    const amount = (1250).toFixed(2);
    const currency = 'RUB';
    const key = '%JMlzywPF4Fgw?mpksIsI%3N8CcIsaJO';

    const data = [shop, order, amount, currency, key];

    const hashString = data.join(':');
    const hashedValue = sha256(hashString);

    const signature = hashedValue.toUpperCase();

    const url = 'http://127.0.0.1:8000/merchant/handler'; // Замените на URL вашего обработчика

    const formData = querystring.stringify({
        shop: shop,
        order: order,
        amount: amount,
        currency: currency,
        signature: signature,
        handler: 'process'
    });

    const options = {
        hostname: '127.0.0.1', // Замените на ваш хост
        port: 8000, // Используйте 443, если используете HTTPS
        path: '/merchant/handler', // Путь к обработчику на сервере
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Content-Length': formData.length
        }
    };

    const req = http.request(options, (res) => {
        let data = '';
        res.on('data', (chunk) => {
            data += chunk;
        });

        res.on('end', () => {
            console.log(data);
        });
    });

    req.on('error', (error) => {
        console.error(error);
    });

    req.write(formData);
    req.end();
}

test();
