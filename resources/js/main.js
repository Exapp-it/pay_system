import Alpine from 'alpinejs';
import timer from './scripts/timer.js';
import copy from './scripts/copy.js';

window.Alpine = Alpine;


Alpine.store('timer', timer)
Alpine.store('copy', copy)
Alpine.store('formActive', {formActive: true})
Alpine.store('url', {});


Alpine.start();
