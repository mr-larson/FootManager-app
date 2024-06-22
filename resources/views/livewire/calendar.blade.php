
<div>
    <div class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Calendar') }}
    </div>
    <div id="calendar"></div>

    <script>
        document.addEventListener('livewire:load', function () {
            // Initialise le calendrier lors du chargement de Livewire
            initializeCalendar();
        });

        Livewire.on('refreshCalendar', function () {
            // Réinitialise le calendrier lors de l'événement refreshCalendar
            initializeCalendar();
        });

        function initializeCalendar() {
            // Ajoutez votre code d'initialisation du calendrier ici
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // options du calendrier
            });
            calendar.render();
        }
    </script>
</div>
