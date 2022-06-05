document.addEventListener('DOMContentLoaded', () => {

	const block = 'cards-courses';
	const wrap = document.querySelector(`.${block}__wrap`);

	let cardId;
	let card;

	let preloader = document.querySelector(`.preloader`);

	// айди удаляемого курса
	let cardDeleteId;

	// confirm-form
	let confirmForm = document.querySelector(`.form-confirm`);

	let wrapConfirmForm = document.querySelector(`.form-confirm__wrap`);

	let confirmBtnCancel = document.querySelector(`.form-confirm__btn_cancel`);
	let confirmBrnConfirm = document.querySelector(`.form-confirm__btn_confirm`);

	let confirmFormPreloader = document.querySelector(`.form-confirm__preloader`);
	let confirmFormInner = document.querySelector(`.form-confirm__inner`);

	wrap.addEventListener('click', e => {

		if (e.target.classList.contains(`${block}__btn`)) {

			card = e.target.closest(`.${block}__card`);
			cardId = card.dataset.card;

			let http = new XMLHttpRequest();
			let url = 'http://diploma/directions/save';
			let params = 'id=' + cardId;

			http.open('POST', url, true);
			http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			preloader.classList.add('_active');

			http.onreadystatechange = function () {
				if (http.readyState == 4 && http.status == 200) {
					setTimeout(() => {

						preloader.classList.remove('_active');

						let parser = new DOMParser();
						let doc = parser.parseFromString(http.responseText, "text/html");
						console.log(doc);

						let allParseCard = doc.querySelectorAll("[data-card]");

						for (let i = 0; i < allParseCard.length; i++) {
							const element = allParseCard[i];

							if (element.dataset.card == cardId) {
								let cardDocument = document.querySelector(`.${block}__card[data-card="${cardId}"]`);
								// setTimeout(() => { cardDocument.innerHTML = element.outerHTML; }, 2000);
								cardDocument.innerHTML = element.outerHTML;
							}
						}
					}, 2000);
				}
			}
			http.send(params);
		}


		if (e.target.classList.contains(`${block}__btn_delete`)) {
			/*
				здесь необходимо получить айди удаляемой карты,
				название курса удаляемого,
				открыть конфирм-форму
			*/

			let btnDelete = e.target;

			let cardDirections = btnDelete.closest(`.${block}__card`);
			cardDeleteId = cardDirections.dataset.card;

			let headText = cardDirections.querySelector(`.${block}__head`);

			let confirmCourseName = document.querySelector('.form-confirm__course-name');

			confirmCourseName.innerHTML = headText.innerHTML;

			confirmForm.classList.add('_active');
			document.body.style.overflowY = 'hidden';
		}
	});

			// Форма подтверждения об удалении

			wrapConfirmForm.addEventListener('click', e => {
				if (e.target.classList.contains('form-confirm__wrap')) {
					confirmForm.classList.remove('_active');
					document.body.style.overflowY = 'visible';
				}
			});

			// Ajax запрос на сервер с удалением курса
			confirmBrnConfirm.addEventListener('click', e => {
				if (e.target.classList.contains('form-confirm__btn_confirm')) {
					let http = new XMLHttpRequest();

					let url = 'http://diploma/directions/delete';
					let params = 'id=' + cardDeleteId;

					http.open('POST', url, true);
					http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

					confirmFormPreloader.classList.add('_active');
					confirmFormInner.classList.add('_hide');
					// preloader.classList.add('_active');

					http.onreadystatechange = function () {
						if (http.readyState == 4 && http.status == 200) {
							setTimeout(() => {

								confirmFormPreloader.classList.remove('_active');
								confirmFormInner.classList.remove('_hide');

								confirmForm.classList.remove('_active');
								document.body.style.overflowY = 'visible';

								let parser = new DOMParser();
								let doc = parser.parseFromString(http.responseText, "text/html");

								let allParseCard = doc.querySelectorAll("[data-card]");

								for (let i = 0; i < allParseCard.length; i++) {
									const element = allParseCard[i];

									if (element.dataset.card == cardDeleteId) {
										let cardDocument = document.querySelector(`.${block}__card[data-card="${cardDeleteId}"]`);
										cardDocument.innerHTML = element.outerHTML;
									}
								}
							}, 2000);
						}
					}
					http.send(params);
				}
			});

			confirmBtnCancel.addEventListener('click', e => {
				if (e.target.classList.contains('form-confirm__btn_cancel')) {
					confirmForm.classList.remove('_active');
					document.body.style.overflowY = 'visible';
				}
			});

});
