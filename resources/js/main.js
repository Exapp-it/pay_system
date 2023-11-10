import Alpine from 'alpinejs';
import timer from './components/timer.js';
import copy from './components/copy.js';
// import uploadImage from "./components/uploadImage.js";

window.Alpine = Alpine;


Alpine.store('timer', timer)
Alpine.store('copy', copy)
Alpine.store('formActive', {formActive: true})
Alpine.store('url', {});
// Alpine.store('uploadImage', uploadImage);


Alpine.start();
