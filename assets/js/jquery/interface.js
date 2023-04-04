(function ($) {
	'use strict';



	/*-------------------------------------------------------------------------------
  Detect mobile device 
-------------------------------------------------------------------------------*/

	var mobileDevice = false;

	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		$('html').addClass('mobile');
		mobileDevice = true;
	}

	else {
		$('html').addClass('no-mobile');
		mobileDevice = false;
	}
	/*-------------------------------------------------------------------------------
	  Ajax Form
	-------------------------------------------------------------------------------*/

	if ($('.js-ajax-form').length) {
		$('.js-ajax-form').each(function () {
			$(this).validate({
				errorClass: 'error wobble-error',
				submitHandler: function (form) {
					$.ajax({
						type: "POST",
						url: "mail.php",
						data: $(form).serialize(),
						success: function () {
							$('.col-message, .success-message').show();
						},

						error: function () {
							$('.col-message, .error-message').show();
						}
					});
				}
			});
		});
	}

})(jQuery);
