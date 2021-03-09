const timeEl = document.getElementById('timer')
const form = document.getElementById('form-text')

// 4200
let totalTime = 4200;
let timer;

window.onload = function() {
    startTime()
}

function setTime() {
    totalTime--;

    let minutes = Math.floor(totalTime / 60)
    let seconds = totalTime % 60

    timeEl.innerHTML = `${minutes < 10 ? '0'+minutes : minutes}:${seconds < 10 ? '0'+seconds : seconds}`;

    if(totalTime < 0) {
        stopTime()

        Swal.fire({
            title:"Your time is up!",
            type:"warning",
            confirmButtonClass:"btn btn-confirm mt-2",
            allowOutsideClick: false
        }).then(function(t) {
            form.submit()
        })

        timeEl.innerHTML = "00:00"
    }
}

function startTime() {
    timer = setInterval(setTime, 1000);
}

function stopTime() {
    clearInterval(timer);
}