document.addEventListener('DOMContentLoaded', () => {
	const tabs = document.querySelectorAll('.side-bar__tab');

	switch (window.location.pathname) {
		case '/office':
			tabs[0].classList.add('side-bar__tab_active');
			break;
		case '/learning':
			tabs[1].classList.add('side-bar__tab_active');
			break;
	}
});