document.addEventListener('DOMContentLoaded', () => {
	const btnRegis = document.querySelector('.header__registr-link');
	const btnExit = document.querySelector('.registration__exit');

	const regisWrap = document.querySelector('.registration');
	const bgWrap = document.querySelector('.registration__bg');

	const linkLogin = document.querySelector('.login-link');
	const wrapLogin = document.querySelector('.login');

	const regisAjax = document.querySelector('.registr');

	const preloader = document.querySelector('.preloader');
	const resistratWrapAjax = document.querySelector('.registration__wrap');

	if (btnRegis) {
		btnRegis.addEventListener('click', e => {
			if (e.target.classList.contains('header__registr-link')) {
				document.body.style.overflow = 'hidden';
				regisWrap.classList.add('_open');
			}
		});

		btnExit.addEventListener('click', () => {
			document.body.style.overflow = 'visible';
			regisWrap.classList.remove('_open');
		});

		bgWrap.addEventListener('click', e => {
			if (e.target.classList.contains('registration__bg')) {
				document.body.style.overflow = 'visible';
				regisWrap.classList.remove('_open');
			}
		});

		linkLogin.addEventListener('click', () => {
			regisWrap.classList.remove('_open');
			wrapLogin.classList.add('_open');
		});
	}

	regisAjax.addEventListener('click', () => {
		const xmlhttp = new XMLHttpRequest();
		const theUrl = "http://diploma/index/json";
		// xmlhttp.responseType = 'json';
		xmlhttp.open("POST", theUrl);

		preloader.classList.add('_open');

		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


				setTimeout(() => {

					preloader.classList.remove('_open');
					var jsonResponse = JSON.parse(xmlhttp.responseText);

					if (jsonResponse.ok == 'yes') {
						let formInner = document.querySelector('.registration__inner');
						let formOk = document.querySelector('.rigit__t');

						formInner.style.display = "none";
						formOk.classList.add('_open');
						resistratWrapAjax.classList.add('_ok');
					}

				}, 2000);

			}
		}

		xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

		const formData = {
			name: document.querySelector('.regist-name').value,
			surname: document.querySelector('.regist-surname').value,
			login: document.querySelector('.regist-login').value,
			password: document.querySelector('.regist-password').value,
		};

		xmlhttp.send(JSON.stringify(formData));
	});



});