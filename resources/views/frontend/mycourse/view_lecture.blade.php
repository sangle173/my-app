<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$lecture -> lecture_title}}</title>
    <!-- Stylesheet -->
    <!-- Google Icons -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        /*-----------------  BASE  -----------------*/
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /*-----------------  VARIABLES  -----------------*/
        :root {
            /* Colors */
            --white_color: rgb(255, 255, 255);
            --orange_color: rgb(246, 99, 53);
            --black_color: rgb(0, 0, 0);
            --background_color: rgb(27, 31, 41);
            --grey-color: rgb(128, 128, 128);
        }

        /*-----------------  STYLING  -----------------*/
        body {
            min-height: 100vh;
            background: var(--background_color);
        }

        body, .container, .video-controls, .video-timer, .options {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 90%;
            user-select: none;
            overflow: hidden;
            max-width: 90em;
            border-radius: 0.3125em;
            background: var(--black_color);
            aspect-ratio: 16 / 9;
            position: relative;
            box-shadow: 0 0.625em 1.25em rgba(0, 0, 0, 0.1);
        }

        .container.fullscreen {
            max-width: 100%;
            width: 100%;
            height: 100vh;
            border-radius: 0em;
        }

        .wrapper {
            position: absolute;
            left: 0;
            right: 0;
            z-index: 1;
            opacity: 0;
            bottom: -0.9375;
            transition: all 0.08s ease;
        }

        .container.show-controls .wrapper {
            opacity: 1;
            bottom: 0;
            transition: all 0.13s ease;
        }

        .wrapper::before {
          content: "";
          bottom: 0;
          width: 100%;
          z-index: -1;
          position: absolute;
          height: calc(100% + 2.1875em);
          pointer-events: none;
          background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        }
        .video-timeline {
            height: 0.4375em;
            width: 100%;
            cursor: pointer;
            padding: 0 1em;
        }

        .video-timeline .progress-area {
            height: 0.1875em;
            position: relative;
            background: rgba(255, 255, 255, 0.6);
        }

        .progress-area span {
            position: absolute;
            left: 50%;
            top: -1.5625em;
            font-size: 0.8125em;
            color: var(--white_color);
            pointer-events: none;
            transform: translateX(-50%);
        }

        .progress-area .progress-bar {
            width: 0%;
            height: 100%;
            position: relative;
            background: var(--orange_color);
        }

        .progress-bar::before {
            content: "";
            right: 0;
            top: 50%;
            height: 0.8125em;
            width: 0.8125em;
            position: absolute;
            border-radius: 50%;
            background: var(--orange_color);
            transform: translateY(-50%);
        }

        .progress-bar::before, .progress-area span {
            display: none;
        }

        .video-timeline:hover .progress-bar::before,
        .video-timeline:hover .progress-area span {
            display: block;
        }

        /*.wrapper .video-controls {*/
        /*  padding: 0.3125em 1.25em 0.625em;*/
        /*}*/
        .video-controls .options {
            width: 100%;
        }

        .video-controls .options:first-child {
            justify-content: flex-start;
        }

        .video-controls .options:last-child {
            justify-content: flex-end;
        }

        .options button {
            height: 2.5em;
            width: 2.5em;
            font-size: 1.1875em;
            border: none;
            cursor: pointer;
            background: none;
            color: var(--white_color);
            border-radius: 0.1875em;
            transition: all 0.3s ease;
        }

        .options button span {
            height: 100%;
            width: 100%;
            line-height: 1.7em;
            font-size: 1.5625em;
        }

        .options button:hover span {
            color: var(--orange_color);
        }

        .options button:active span {
            transform: scale(0.9);
        }

        .options #volume_range {
            height: 0.3em;
            max-width: 5em;
            accent-color: var(--orange_color);
            display: none;
            cursor: pointer;
            transition: all 0.9s ease;
        }

        .options .video-timer {
            color: var(--white_color);
            margin-left: 0.9375em;
            font-size: 0.875em;
        }

        .video-timer .separator {
            margin: 0 0.3125em;
            font-size: 1em;
            font-family: "Open sans";
        }

        .playback-content {
            display: flex;
            position: relative;
        }

        .playback-content .speed-options {
            position: absolute;
            list-style: none;
            left: -2.5em;
            bottom: 2.5em;
            width: 5.9375em;
            overflow: hidden;
            opacity: 0;
            border-radius: 0.25em;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0.625em 1.25em rgba(0, 0, 0, 0.1);
            transition: opacity 0.13s ease;
        }

        .playback-content .speed-options.show {
            opacity: 1;
            pointer-events: auto;
        }

        .speed-options li {
            cursor: pointer;
            color: var(--black_color);
            font-size: 0.875em;
            margin: 0.125em 0;
            padding: 0.3125em 0 0.3125em 0.9375em;
            transition: all 0.1s ease;
        }

        .speed-options li:where(:first-child, :last-child) {
            margin: 0em;
        }

        .speed-options li:hover {
            background: var(--grey-color);
        }

        .speed-options li.active {
            color: var(--white_color);
            background: var(--orange_color);
        }

        .container video {
            width: 100%;
        }

        label {
            cursor: pointer;
        }

        .tooltip {
            position: relative;
        }

        .tooltip:hover::before {
            content: attr(title);
            white-space: nowrap;
            position: absolute;
            bottom: 150%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.3125em;
            border-radius: 0.3125em;
            background-color: #333;
            font-weight: 700;
            color: var(--white_color);
            font-size: 0.875em;
        }

        .options:first-child .tooltip:first-child::before {
            margin-left: 2em;
        }

        .tooltiplast:hover::before {
            left: 22%;
        }

        .tooltip:nth-child(5)::before {
            font-size: 1.1875em;
            margin-bottom: 2.8em;
        }

        @media screen and (max-width: 540px) {
            .wrapper .video-controls {
                padding: 0.1875em 0.625em 0.4375em;
            }

            .options input, .progress-area span {
                display: none !important;
            }

            .options button {
                height: 1.875em;
                width: 1.875em;
                font-size: 1.0625em;
            }

            .options .video-timer {
                margin-left: 0.3125em;
            }

            .video-timer .separator {
                font-size: 0.875em;
                margin: 0 0.125em;
            }

            .options button span {
                line-height: 1.875em;
            }

            .options button span {
                font-size: 1.3125em;
            }

            .options .video-timer, .progress-area span, .speed-options li {
                font-size: 0.75em;
            }

            .playback-content .speed-options {
                width: 4.6875em;
                left: -1.875em;
                bottom: 1.875em;
            }

            .speed-options li {
                margin: 0.0625em 0;
                padding: 0.1875em 0 0.1875em 0.625em;
            }

            .right .pic-in-pic {
                display: none;
            }
        }
    </style>
</head>
<body>
@if(!empty($lecture->video))
<div class="container show-controls">
    <div class="wrapper">
        <div class="video-timeline">
            <div class="progress-area">
                <span>00:00</span>
                <div class="progress-bar"></div>
            </div>
        </div>
        <ul class="video-controls">
            <li class="options left">
                <button title="Backward 10s" class="skip-backward tooltip"><span
                        class="material-icons">rotate_left</span></button>
                <button title="Play" class="play-pause tooltip"><span class="material-icons">play_arrow</span></button>
                <button title="Forward 10s" class="skip-forward tooltip"><span
                        class="material-icons">rotate_right</span></button>
                <button title="Mute" class="volume tooltip"><span class="material-icons">volume_up</span></button>
                <input title="Volume" class="tooltip" id="volume_range" type="range" min="0" max="1" step="any">
                <div class="video-timer">
                    <p class="current-time">00:00</p>
                    <p class="separator"> / </p>
                    <p class="video-duration">00:00</p>
                </div>
            </li>
            <li class="options right">
                <div class="playback-content">
                    <button title="Speed" class="playback-speed tooltip"><span class="material-symbols-rounded">slow_motion_video</span>
                    </button>
                    <ul class="speed-options">
                        <li data-speed="0.5">0.5x</li>
                        <li data-speed="0.75">0.75x</li>
                        <li data-speed="1" class="active">Normal</li>
                        <li data-speed="1.5">1.5x</li>
                        <li data-speed="2">2x</li>
                    </ul>
                </div>
                <button title="Miniplayer" class="pic-in-pic tooltip"><span class="material-icons">picture_in_picture_alt</span>
                </button>
                <button title="Full screen" class="fullscreen tooltip"><span class="material-icons">fullscreen</span>
                </button>
                <button title="New File" class="new-file tooltip tooltiplast"><label for="fileInput"><span
                            class="material-icons">video_file</span></label></button>
                <input type="file" id="fileInput" name="fileInput" accept="video/mp4,video/x-m4v,video/*" hidden>
            </li>
        </ul>
    </div>
    <video id="myVideo" oncontextmenu="return false;" autoplay src="{{ asset($lecture->video) }}"></video>

</div>
@else
    <h3 style="color: white!important;">Bài học này k có video</h3>
@endif
<!-- Script -->
<script>
    // Custom Video Player

    // Variables
    const container = document.querySelector(".container"),
        video = document.getElementById('myVideo'),
        fileInput = document.getElementById('fileInput'),
        mainVideo = container.querySelector("video"),
        videoTimeline = container.querySelector(".video-timeline"),
        progressBar = container.querySelector(".progress-bar"),
        volumeTitle = container.querySelector(".volume"),
        volumeBtn = container.querySelector(".volume span"),
        volumeSlider = container.querySelector(".left input"),
        currentVidTime = container.querySelector(".current-time"),
        videoDuration = container.querySelector(".video-duration"),
        skipBackward = container.querySelector(".skip-backward span"),
        skipForward = container.querySelector(".skip-forward span"),
        playPauseTitle = container.querySelector(".play-pause"),
        playPauseBtn = container.querySelector(".play-pause span"),
        speedBtn = container.querySelector(".playback-speed span"),
        speedOptions = container.querySelector(".speed-options"),
        pipBtn = container.querySelector(".pic-in-pic span"),
        fullScreenTitle = container.querySelector(".fullscreen"),
        fullScreenBtn = container.querySelector(".fullscreen span");
    let timer;

    // New File
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        const objectURL = URL.createObjectURL(file);
        video.src = objectURL;
        mainVideo.play();
    });

    // Display Volume Range
    volumeBtn.addEventListener("mousemove", () => {
        volumeSlider.style.display = "block";
        volumeSlider.style.marginLeft = "3px";
    });

    // Hide Controls
    const hideControls = () => {
        if (mainVideo.paused) return;
        timer = setTimeout(() => {
            container.classList.remove("show-controls");
            volumeSlider.style.display = "none";
        }, 4000);
    }
    hideControls();

    container.addEventListener("mousemove", () => {
        container.classList.add("show-controls");
        clearTimeout(timer);
        hideControls();
    });

    // Time Format
    const formatTime = time => {
        let seconds = Math.floor(time % 60),
            minutes = Math.floor(time / 60) % 60,
            hours = Math.floor(time / 3600);

        seconds = seconds < 10 ? `0${seconds}` : seconds;
        minutes = minutes < 10 ? `0${minutes}` : minutes;
        hours = hours < 10 ? `0${hours}` : hours;

        if (hours == 0) {
            return `${minutes}:${seconds}`
        }
        return `${hours}:${minutes}:${seconds}`;
    }

    // Video Timeline
    videoTimeline.addEventListener("mousemove", e => {
        let timelineWidth = videoTimeline.clientWidth;
        let offsetX = e.offsetX;
        let percent = Math.floor((offsetX / timelineWidth) * mainVideo.duration);
        const progressTime = videoTimeline.querySelector("span");
        offsetX = offsetX < 20 ? 20 : (offsetX > timelineWidth - 20) ? timelineWidth - 20 : offsetX;
        progressTime.style.left = `${offsetX}px`;
        progressTime.innerText = formatTime(percent);
    });

    videoTimeline.addEventListener("click", e => {
        let timelineWidth = videoTimeline.clientWidth;
        mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
    });

    mainVideo.addEventListener("timeupdate", e => {
        let {currentTime, duration} = e.target;
        let percent = (currentTime / duration) * 100;
        progressBar.style.width = `${percent}%`;
        currentVidTime.innerText = formatTime(currentTime);
    });

    mainVideo.addEventListener("loadeddata", () => {
        videoDuration.innerText = formatTime(mainVideo.duration);
    });

    const draggableProgressBar = e => {
        let timelineWidth = videoTimeline.clientWidth;
        progressBar.style.width = `${e.offsetX}px`;
        mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
        currentVidTime.innerText = formatTime(mainVideo.currentTime);
    }

    // Volume
    volumeSlider.addEventListener("input", e => {
        mainVideo.volume = e.target.value;
        if (e.target.value == 0) {
            volumeTitle.title = "Unmute";
            return volumeBtn.textContent = 'volume_off';
        }
        volumeBtn.textContent = 'volume_up';
        volumeTitle.title = "Mute";
    });

    // Mute & Unmute
    const tempVolume = volumeSlider.value;

    volumeBtn.addEventListener("click", () => {
        if (volumeSlider.value == 0) {
            mainVideo.volume = tempVolume;
            volumeBtn.textContent = 'volume_up';
            volumeTitle.title = "Mute";
            volumeSlider.value = mainVideo.volume;
        } else if (volumeBtn.innerHTML == 'volume_off') {
            mainVideo.volume = tempVolume;
            volumeBtn.textContent = 'volume_up';
            volumeTitle.title = "Mute";
        } else {
            mainVideo.volume = 0.0;
            volumeBtn.textContent = 'volume_off';
            volumeTitle.title = "Unmute";
        }
    });

    // Video Speed
    speedOptions.querySelectorAll("li").forEach(option => {
        option.addEventListener("click", () => {
            mainVideo.playbackRate = option.dataset.speed;
            speedOptions.querySelector(".active").classList.remove("active");
            option.classList.add("active");
        });
    });

    document.addEventListener("click", e => {
        if (e.target.tagName !== "SPAN" || e.target.className !== "material-symbols-rounded") {
            speedOptions.classList.remove("show");
        }
    });

    // Full Screen
    fullScreenBtn.addEventListener("click", () => {
        container.classList.toggle("fullscreen");
        if (document.fullscreenElement) {
            fullScreenBtn.textContent = 'fullscreen';
            fullScreenTitle.title = "Full screen";
            return document.exitFullscreen();
        }
        fullScreenBtn.textContent = 'fullscreen_exit';
        fullScreenTitle.title = "Exit Full screen";
        container.requestFullscreen();
    });

    // Buttons Functions
    speedBtn.addEventListener("click", () => speedOptions.classList.toggle("show"));
    pipBtn.addEventListener("click", () => mainVideo.requestPictureInPicture());
    skipBackward.addEventListener("click", () => mainVideo.currentTime -= 10);
    skipForward.addEventListener("click", () => mainVideo.currentTime += 10);
    mainVideo.addEventListener("play", () => {
        playPauseBtn.textContent = 'pause';
        playPauseTitle.title = 'Pause';
    });
    mainVideo.addEventListener("pause", () => {
        playPauseBtn.textContent = 'play_arrow';
        playPauseTitle.title = 'Play';
    });
    playPauseBtn.addEventListener("click", () => mainVideo.paused ? mainVideo.play() : mainVideo.pause());
    videoTimeline.addEventListener("mousedown", () => videoTimeline.addEventListener("mousemove", draggableProgressBar));
    document.addEventListener("mouseup", () => videoTimeline.removeEventListener("mousemove", draggableProgressBar));
</script>
</body>
</html>
