// script.js
document.addEventListener('DOMContentLoaded', function () {
    function updateDateTime() {
        var now = new Date();
        var dateElement = document.getElementById('date');
        var timeElement = document.getElementById('time');

        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', options);

        var timeString = now.getHours().toString().padStart(2, '0') + ':' +
            now.getMinutes().toString().padStart(2, '0') + ':' +
            now.getSeconds().toString().padStart(2, '0');
        timeElement.textContent = timeString;
    }

    setInterval(updateDateTime, 1000); // Update setiap detik
    updateDateTime(); // Update pertama kali
});
