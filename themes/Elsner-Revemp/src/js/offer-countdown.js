document.addEventListener('DOMContentLoaded', function () {
    var selectedDate = document.getElementById("offerCountdown").textContent;
    var countDownDate = new Date(selectedDate).getTime();
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var testdev = document.getElementById("countdowntimer").innerHTML =
            `<ul>
                <li><span id="days">${days}</span></li>
                <li><span id="hours">${hours}</span></li>
                <li><span id="minutes">${minutes}</span></li>
                <li><span id="seconds">${seconds}</span></li>
            </ul>`;
    }, 1000);
});