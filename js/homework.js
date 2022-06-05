document.addEventListener('DOMContentLoaded', () => {
	const file = document.querySelector('.homework__input');
	const inputNameFile = document.querySelector('.homework__file-name');

	file.addEventListener('change', () => {
			inputNameFile.innerHTML = file.files[0].name;
	});

});