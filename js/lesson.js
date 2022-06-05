document.addEventListener('DOMContentLoaded', () => {

	const video = document.querySelector('.lesson-video__element');
	const videoContainer = document.querySelector('.lesson-video');

	let flag = false;
	let videoFlag = 'pause';

	const controls = {
		play: document.querySelector('.lesson-video__play'),
		pause: document.querySelector('.lesson-video__pause'),
		resize: document.querySelector('.lesson-video__resize'),
		progress: document.querySelector('.lesson-video__progress'),
		total: 1195,
	};

	const btnLecture = document.querySelector('.lesson__btn-lecture');

	controls.play.addEventListener('click', () => {
		video.play();
		controls.play.classList.remove('_active');
		controls.pause.classList.add('_active');
		videoFlag = 'play';
	});

	controls.pause.addEventListener('click', () => {
		video.pause();
		controls.pause.classList.remove('_active');
		controls.play.classList.add('_active');
		videoFlag = 'pause';
	});

	controls.resize.addEventListener('click', () => {
		if (flag == false) {
			videoContainer.requestFullscreen();
			flag = true;

			let btnAll = document.querySelectorAll('.lesson-video__resize-btn');

			for (let i = 0; i < btnAll.length; i++) {
				const element = btnAll[i];
				element.classList.add('resize_active');
			}
		} else {
			document.exitFullscreen();
			flag = false;

			let btnAll = document.querySelectorAll('.lesson-video__resize-btn');

			for (let i = 0; i < btnAll.length; i++) {
				const element = btnAll[i];
				element.classList.remove('resize_active');
			}
		}
	});

	video.addEventListener('click', () => {
		if (videoFlag == 'pause') {
			video.play();
			controls.play.classList.remove('_active');
			controls.pause.classList.add('_active');
			videoFlag = 'play';
		}
		else if (videoFlag == 'play') {
			video.pause();
			controls.pause.classList.remove('_active');
			controls.play.classList.add('_active');
			videoFlag = 'pause';
		}

	})

	video.addEventListener('timeupdate', function () {
		let progress = Math.floor(video.currentTime) / Math.floor(video.duration);
		controls.progress.style.width = Math.floor(progress * controls.total) + "px";
	});

	// лекция
	
	btnLecture.addEventListener('click', () => {
		const lectureWrap = document.querySelector('.lesson__lecture-wrap');
		lectureWrap.classList.toggle('_open');
	});

});