import Controls from "./controls";
import Timer from "./timer";
import Events from "./events";
import {
  buttonDecrease,
  buttonIncrease,
  buttonPause,
  buttonPlay,
  buttonStop,
} from "./elements";

const controls = Controls({
  buttonPlay,
  buttonPause,
  buttonStop,
  buttonIncrease,
  buttonDecrease,
});

const timer = Timer({
  minutesDisplay,
  secondsDisplay,
  resetControls: controls.reset,
});

Events({ controls, timer });
