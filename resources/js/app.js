import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.querySelectorAll('[name="user_timezone"]').forEach(i => {
    i.setAttribute('value', Intl.DateTimeFormat().resolvedOptions().timeZone);
})
