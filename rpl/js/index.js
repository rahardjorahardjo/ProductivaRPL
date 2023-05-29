const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

/**
 * @param {Date} date
 */
function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes();
  const isAm = date.getHours() < 12;

  return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString()
    .padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

/**
 * @param {Date} date
 */
function formatDate(date) {
  const DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ];
  const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
  } ${date.getDate()} ${date.getFullYear()}`;
}

setInterval(() => {
  const now = new Date();

  timeElement.textContent = formatTime(now);
  dateElement.textContent = formatDate(now);
}, 200);


// index.js

document.addEventListener('DOMContentLoaded', function() {
  var noteContent = document.querySelector('.notecontent');
  var location = "Jakarta";
  var locationFormatted = location.replace(/ /g, '+');
  var apiKey = 'kunci_api_anda';
  var weatherUrl = 'https://api.openweathermap.org/data/2.5/weather?q=' + locationFormatted + ',Indonesia&units=metric&appid=' + apiKey;

  fetch(weatherUrl)
      .then(function(response) {
          return response.json();
      })
      .then(function(data) {
          var weatherDescription = data.weather[0].description;
          var temperature = data.main.temp;

          noteContent.innerHTML = 'Cuaca di ' + location + ': ' + weatherDescription + ', Suhu: ' + temperature + '°C';
      })
      .catch(function(error) {
          console.log('Terjadi kesalahan:', error);
      });
});

