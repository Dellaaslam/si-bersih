<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-3xl font-bold text-gray-800">Kalender Schedule (Admin)</h1>

                <!-- Tombol Buat Jadwal -->
                <a href="{{ route('admin.schedule.create') }}"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
                    + Buat Jadwal
                </a>
            </div>

            <!-- Kalender + Modal -->
            <div x-data="{ modalOpen: false, title: '', start: '', end: '', id: null }">
                <!-- Kalender -->
                <div id="calendar" class="bg-white shadow-lg rounded-xl p-4"></div>

                <!-- Modal -->
                <div x-show="modalOpen" x-transition
                     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-96 relative">
                        <h2 class="text-xl font-bold mb-2" x-text="title"></h2>
                        <p>Start: <span x-text="start"></span></p>
                        <p>End: <span x-text="end"></span></p>
                        <div class="mt-4 flex justify-end gap-2">
                            <a :href="`/admin/schedule/${id}/edit`" 
                               class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                            <button @click="modalOpen = false" 
                                    class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Styles & Scripts -->
  
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/events',  // ambil dari route JSON
        displayEventTime: false,

        eventClick: function(info) {
            var eventObj = info.event;

            if (eventObj.url) {
                window.location.href = eventObj.url; 
                info.jsEvent.preventDefault();
            } else {
                alert('Clicked ' + eventObj.title);
            }
        }
    });

    calendar.render();
});
</script>


</x-app-layout>
