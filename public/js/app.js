import './bootstrap';
import './main'
import Alpine from 'alpinejs';

import './jquery-3.3.1.min.js'

window.Alpine = Alpine;

Alpine.start();

export function toggleProfileDropdown() {
    document.getElementById('profileDropdown').classList.toggle('hidden');
}