document.addEventListener('DOMContentLoaded', () => {
	const allTableVars = {
		namesLessons: document.querySelectorAll('.my-courses__table-col-regular_textarea-name'),
		recitalsLessons: document.querySelectorAll('.my-courses__table-col-regular_textarea-recital'),
		videosUpload: document.querySelectorAll('.my-courses__upload-input-video'),
		postersUpload: document.querySelectorAll('.my-courses__upload-input-poster'),
		homeworksUpload: document.querySelectorAll('.my-courses__upload-input-homework'),
		lecturesUpload: document.querySelectorAll('.my-courses__upload-input-lecture'),
	}

	function uploadFile(uploadArg, dataArg) {
		const xhr = new XMLHttpRequest();

		xhr.open("POST", uploadArg.link);

		const data = new FormData();

		data.append(uploadArg.nameFormData, dataArg.file);
		data.append("nameCourse", dataArg.nameCourse);
		data.append("numberLesson", dataArg.numberLesson);
		data.append("previousTitle", dataArg.previousTitle);

		xhr.send(data);

		const preloader = {
			inst: document.querySelector('.preloader'),
			wrap: document.querySelector('.preloader__wrap'),
			title: document.querySelector('.preloader__title'),
			desc: document.querySelector('.preloader__desc')
		};

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {

				const res = JSON.parse(xhr.responseText);

				if (res.success == 'false') {

					// снова меняем на старое название видоса
					dataArg.span.innerText = dataArg.previousTitle;

					preloader.title.innerText = 'Ошибка:';
					preloader.desc.innerText = res.error;

					preloader.inst.classList.add('_active');
					preloader.wrap.classList.add('error');

					setTimeout(() => {
						preloader.inst.classList.remove('_active');

						setTimeout(() => {
							preloader.wrap.classList.remove('error');
						}, 2000);

					}, 2000);



				} else if (res.success == 'true') {
					preloader.title.innerText = 'Успешно:';
					preloader.desc.innerText = 'Ошибок нет';

					preloader.inst.classList.add('_active');
					preloader.wrap.classList.add('ok');

					setTimeout(() => {
						preloader.inst.classList.remove('_active');

						setTimeout(() => {
							preloader.wrap.classList.remove('ok');
						}, 2000);

					}, 2000);
				}
			}
		};
	}

	function getDataForServer(element, nameSelector, no_file = false) {
		let file, previousTitle, span;
		let textInTextarea;

		if (!no_file) {
			file = element.files['0'];

			// смена текста при загрузке и отправка на сервер предыдущего имени файла
			let parent = element.closest(`.my-courses__col-regular-${nameSelector}`);
			span = parent.querySelector('.my-courses__upload-text');

			previousTitle = span.innerText;

			span.innerText = file.name;
		} else {
			textInTextarea = element.value;
		}

		// находим обертку для того чтобы в последующем найти название курса
		const wrapTable = element.closest(".my-courses__course-wrap");
		// находим обертку для того чтобы в последующем найти номер урока
		const wrapRow = element.closest(".my-courses__table-regular-row");

		const nameCourse = wrapTable.querySelector('.my-courses__course-name').innerText;
		const numberLesson = wrapRow.querySelector('.my-courses__col-regular-number').innerText;

		if (!no_file) {
			return data = {
				file: file,
				nameCourse: nameCourse,
				numberLesson: numberLesson,
				previousTitle: previousTitle,
				span: span,
			}
		} else {
			return data = {
				nameCourse: nameCourse,
				numberLesson: numberLesson,
				textInTextarea: textInTextarea
			}
		}

	}

	function sendText(link, dataArg) {
		let xhr = new XMLHttpRequest();


		xhr.open("POST", link);
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

		const data = dataArg;

		xhr.send(JSON.stringify(data));
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				console.log('accept');


			}
		}

	}

	allTableVars.namesLessons.forEach(nameLesson => {
		nameLesson.addEventListener('change', () => {
			const objData = getDataForServer(nameLesson, '', true);
			objData.tagChange = 'name';

			const link = '/learning/textEntry';

			sendText(link, objData);
			console.log(objData);
		});
	});

	allTableVars.recitalsLessons.forEach(recitalLesson => {
		recitalLesson.addEventListener('change', () => {
			const objData = getDataForServer(recitalLesson, '', true);
			objData.tagChange = 'recital';

			const link = '/learning/textEntry';

			sendText(link, objData);
			console.log(objData);
		});
	});

	allTableVars.videosUpload.forEach(video => {

		video.addEventListener('change', (e) => {

			const objData = getDataForServer(video, 'video');

			const uploadArg = {
				link: '/learning/uploadVideo',
				nameFormData: 'video',
			};

			uploadFile(uploadArg, objData);
		});

	});

	allTableVars.postersUpload.forEach(poster => {

		poster.addEventListener('change', () => {
			const objData = getDataForServer(poster, 'poster');

			const uploadArg = {
				link: '/learning/uploadPoster',
				nameFormData: 'poster',
			};

			uploadFile(uploadArg, objData);
		});

	});

	allTableVars.homeworksUpload.forEach(homework => {

		homework.addEventListener('change', () => {
			const objData = getDataForServer(homework, 'homework');

			const uploadArg = {
				link: '/learning/uploadHomework',
				nameFormData: 'homework',
			};

			uploadFile(uploadArg, objData);
		});

	});


	allTableVars.lecturesUpload.forEach(lecture => {

		lecture.addEventListener('change', () => {
			const objData = getDataForServer(lecture, 'lecture');

			const uploadArg = {
				link: '/learning/uploadLecture',
				nameFormData: 'lecture',
			};

			uploadFile(uploadArg, objData);
		});

	});


});



