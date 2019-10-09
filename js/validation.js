(function() {
    const surveyForm = document.querySelector('#surveyForm');
	const searchForm = document.querySelector('#searchForm');
	
	if (surveyForm) {
		const email = surveyForm.querySelector('#email');
		const checkboxes = surveyForm.querySelectorAll('input[type=checkbox]');
		const button = document.querySelector('#submitBtn');
		
		function init() {
			email.addEventListener('change', checkValidity);
			
			for (let i=0; i<checkboxes.length; i++) {
				checkboxes[i].addEventListener('change', checkValidity);
			}
		}

		function isChecked() {
			for (let i=0; i<checkboxes.length; i++) {
				if (checkboxes[i].checked) return true;
			}
		}
		
		function checkEmail() {
			if (email.value !== '') return true;
		}

		function checkValidity() {
			(isChecked() && checkEmail()) ? button.removeAttribute('disabled') : button.setAttribute('disabled', true);
		}

		init();
	}
	
	if (searchForm) {
		
		const search = searchForm.querySelector('#searchField');
		const searchButton = document.querySelector('#searchSubmit');
		
		search.addEventListener('change', function() {
			(search.value !== '') ? searchButton.removeAttribute('disabled') : searchButton.setAttribute('disabled', true);
		});
	}
})();