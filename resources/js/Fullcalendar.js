import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        height: 'auto', // Adjust the height as needed
        contentHeight: 300, // Adjust the content height as needed
        selectable: true,
        editable: true,
        events: '/api/events', // This will be the endpoint to fetch events from your server
        dateClick: function(info) {
            alert('Date: ' + info.dateStr);
        },
        eventClick: function(info) {
            alert('Event: ' + info.event.title);
        }
    });
    calendar.render();
});
