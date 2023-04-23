"use strict";
/* Page Loader */
window.addEventListener("load", () => {
	const loader = document.querySelector(".loader");
	loader.classList.add("loader-hidden");

	loader.addEventListener("transitionend", () => {
		document.body.removeChild("loader");
	})
});

/* Button Submit */
console.log("XAU init");
const XAU_EL = {
	submit: document.getElementById("sub_button"),
	email: document.getElementById("email")
};

let canSubmit = false;

function xau_can_submit() {
	let email = XAU_EL.email.value.trim();
	if (email.length > 4) {
		xau_enable_submit()
	} else {
		xau_disable_submit()
	}
}

function xau_enable_submit() {
	XAU_EL.submit.classList.add("submit_enabled");
	XAU_EL.submit.disabled = false;
	canSubmit = true;
}

function xau_disable_submit() {
	XAU_EL.submit.classList.remove("submit_enabled");
	XAU_EL.submit.disabled = true;
	canSubmit = false;
}

function xau_set_event_listeners() {
	XAU_EL.email.addEventListener("keyup", xau_can_submit);
}

xau_set_event_listeners();

/* Ajax Form submission */
(function ($) {
	if ($('.js-ajax-form').length) {
		$('.js-ajax-form').each(function () {
			$(this).validate({
				errorClass: 'error wobble-error',
				submitHandler: function (form) {
					$('.btn-submit').remove();
					$('.btn-loading').show();
					$.ajax({
						type: "POST",
						url: "mail.php",
						data: $(form).serialize(),
						success: function () {
							$('.col-message, .success-message').show();
							xau_disable_submit();
							setTimeout(function () {
								$('.btn-loading').remove();
							}, 2000);
							$('.btn-submit').show();
						},
						error: function () {
							$('.col-message, .error-message').show();
							xau_disable_submit();
						}
					});
				}
			});
		});
	}
})(jQuery);