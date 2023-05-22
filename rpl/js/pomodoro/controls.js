export default function Controls({ buttonPlay, buttonPause }) {
  function play() {
    buttonPause.classList.remove("hide");
    buttonPlay.classList.add("hide");
  }
  function pause() {
    buttonPause.classList.add("hide");
    buttonPlay.classList.remove("hide");
  }
  function reset() {
    buttonPlay.classList.remove("hide");
    buttonPause.classList.add("hide");
  }
  return{
    reset,
    play,
    pause,
  }
}
