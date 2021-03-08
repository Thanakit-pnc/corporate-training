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

    console.log(totalTime);
    if(totalTime < 0) {
        stopTime()
        alert('Your time is up.')
        timeEl.innerHTML = "00:00"
        // form.submit()
    }
}

function startTime() {
    timer = setInterval(setTime, 1000);
}

function stopTime() {
    clearInterval(timer);
}