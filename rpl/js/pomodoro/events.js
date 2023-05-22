import {
    buttonPlay,
    buttonPause,
    buttonStop,
    buttonIncrease,
    buttonDecrease,
} from "./elements.js"

export default function({controls, timer}){
    buttonPlay.addEventListener('click', function(){
        controls.play()
        timer.countDown()
    })

    buttonPause.addEventListener('click', function(){
        controls.pause()
        timer.hold()
    })

    buttonStop.addEventListener('click', function(){
        controls.reset()
        timer.reset()
    })

    buttonIncrease.addEventListener('click', function(){
        timer.setMinutes(1)
        timer.hold()
        controls.reset()
    })

    buttonDecrease.addEventListener('click', function(){
        timer.setMinutes(2)
        timer.hold()
        controls.reset()
    })



}