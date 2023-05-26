const minutesDisplay = document.querySelector(".minutes");
const secondsDisplay = document.querySelector(".seconds");
const buttonPlay = document.querySelector(".play");
const buttonPause = document.querySelector(".pause");
const buttonStop = document.querySelector(".stop");
const buttonIncrease = document.querySelector(".increase");
const buttonDecrease = document.querySelector(".decrease");
const studyTime = document.querySelector(".study");
const breakTime = document.querySelector(".break");

let timerTimeOut;
let minutes = Number(minutesDisplay.textContent);
let counter = 0;

function updateDisplay(newMinutes, seconds) {
  console.log(newMinutes);
  newMinutes = newMinutes === undefined ? minutes : newMinutes;
  seconds = seconds === undefined ? 0 : seconds;
  minutesDisplay.textContent = String(newMinutes).padStart(2, "0");
  secondsDisplay.textContent = String(seconds).padStart(2, "0");

  if (newMinutes < 0) {
    updateDisplay(0, 0);
    newMinutes = 0;
  }
}

function setMinutes(type) {
  if (type == 1) {
    updateDisplay((minutes += 5), 0);
  } else if (type == 2) {
    updateDisplay((minutes -= 5), 0);
    if (minutes <= 0) {
      minutes = 0;
    }
  } else {
    updateDisplay(25, 0);
  }
}

function reset() {
  if (counter % 2 == 0) {
    studyTime.classList.add("hide");
    breakTime.classList.remove("hide");
    updateDisplay(5, 0);
    counter++;
  } else if (counter % 2 == 1) {
    studyTime.classList.remove("hide");
    breakTime.classList.add("hide");
    updateDisplay(25, 0);
    counter++;
  }
  clearTimeout(timerTimeOut);
  buttonPlay.classList.remove("hide");
  buttonPause.classList.add("hide");
}

function countDown() {
  timerTimeOut = setTimeout(function () {
    let seconds = Number(secondsDisplay.textContent);
    let minutes = Number(minutesDisplay.textContent);
    let isFinished = minutes <= 0 && seconds <= 0;

    updateDisplay(minutes, 0); //seta segundos começando com zero, pois a regra já cai no if

    if (isFinished) {
      reset();
      return;
    }

    if (seconds <= 0) {
      seconds = 60;
      --minutes;
    }

    updateDisplay(minutes, String(seconds - 1));
    countDown();
  }, 1000);
}

function hold() {
  clearTimeout(timerTimeOut);
}

function increase() {
  setMinutes(3);
  hold();
  buttonPlay.classList.remove("hide");
  buttonPause.classList.add("hide");
}

function decrease() {
  setMinutes(2);
  hold();
  buttonPlay.classList.remove("hide");
  buttonPause.classList.add("hide");
}

function start() {
  buttonPlay.classList.add("hide");
  buttonPause.classList.remove("hide");
  countDown();
}

function pause() {
  buttonPlay.classList.remove("hide");
  buttonPause.classList.add("hide");
  hold();
}

function stopTime() {
  buttonPlay.classList.remove("hide");
  buttonPause.classList.add("hide");
  setMinutes(3);
  hold();
}
