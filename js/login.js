document.addEventListener('DOMContentLoaded', () => {
	const openBtn = document.querySelector('.header__login-link');
	const exitBtn = document.querySelector('.login__exit');

	const wrapLogin = document.querySelector('.login');
	const bgLogin = document.querySelector('.login__bg');

	const linkRegist = document.querySelector('.reg-link');
	const wrapRegist = document.querySelector('.registration');

	if (openBtn) {
		openBtn.addEventListener('click', e => {
			if (e.target.classList.contains('header__login-link')) {
				document.body.style.overflow = 'hidden';
				wrapLogin.classList.add('_open');
			}
		});

		exitBtn.addEventListener('click', () => {
			document.body.style.overflow = 'visible';
			wrapLogin.classList.remove('_open');
		});

		bgLogin.addEventListener('click', e => {
			if (e.target.classList.contains('login__bg')) {
				document.body.style.overflow = 'visible';
				wrapLogin.classList.remove('_open');
			}
		});

		linkRegist.addEventListener('click', () => {
			wrapLogin.classList.remove('_open');
			wrapRegist.classList.add('_open');
		});
	}

});