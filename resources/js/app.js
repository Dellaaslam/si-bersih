import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {

        // === Tambahkan logika eventsUrl di sini ===
        let eventsUrl = '/schedule/events';

        if (window.location.pathname.startsWith('/admin')) {
            eventsUrl = '/admin/schedule/events';
        }
        // ===========================================

        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin],
            initialView: 'dayGridMonth',
            events: eventsUrl, // <-- pakai variable dinamis
        });

        calendar.render();
    }
});
