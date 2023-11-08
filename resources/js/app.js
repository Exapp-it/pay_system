import './bootstrap';

import Alpine from 'alpinejs';
import timer from './components/timer.js';

window.Alpine = Alpine;

export default function copy(value) {
    navigator.clipboard.writeText(value).then(function () {
        alert('Значение скопировано в буфер обмена: ' + value);
    }).catch(function (err) {
        console.error('Не удалось скопировать значение: ', err);
    });
}

document.addEventListener('alpine:init', () => {
    Alpine.store('timer', timer)
})


Alpine.start();

