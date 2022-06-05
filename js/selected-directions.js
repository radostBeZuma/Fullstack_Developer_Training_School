document.addEventListener('DOMContentLoaded', () => {
	const wrap = document.querySelector('.directions__wrap');
	const all = document.querySelector('.directions__all-courses');

	const btn = document.querySelector('.directions__btn');
	let flag;

	if (localStorage.getItem('flag') == '' || localStorage.getItem('flag') == 'false') {
		flag = 'false';
		localStorage.setItem('flag', flag);
	} else if (localStorage.getItem('flag') == 'true') {
		flag = localStorage.getItem('flag');

		btn.classList.toggle('_active');
		wrap.classList.toggle('_active');

		all.classList.add('_active');
	}

	btn.addEventListener('click', () => {
		btn.classList.toggle('_active');
		wrap.classList.toggle('_active');

		if (flag == 'false') {
			all.classList.add('_active');

			flag = 'true';
			localStorage.setItem('flag', flag);
		} else {
			setTimeout(() => {
				all.classList.remove('_active');
			}, 2000);

			flag = 'false';
			localStorage.setItem('flag', flag);
		}
	});
});