import Alpine from 'alpinejs';
import timer from './components/timer.js';
import copy from './components/copy.js';

window.Alpine = Alpine;


Alpine.store('timer', timer)
Alpine.store('copy', copy)


Alpine.start();
