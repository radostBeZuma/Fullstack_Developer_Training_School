document.addEventListener('DOMContentLoaded', () => {
	const tabs = document.querySelectorAll('.side-bar__tab');

	switch (window.location.pathname) {
		case '/cabinet':
			tabs[0].classList.add('side-bar__tab_active');
			break;
		case '/directions':
			tabs[1].classList.add('side-bar__tab_active');
			break;
		// case '/learning':
		// 	tabs[2].classList.add('side-bar__tab_active');
		// 	break;
		// case '/homework':
		// 	tabs[3].classList.add('side-bar__tab_active');
		// 	break;
	}
});