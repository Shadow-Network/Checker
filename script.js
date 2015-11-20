
/* =============================================================================
	Script for Simple Donation Form
	Handles validation and form processing
  ========================================================================== */

$(function() {
	var $form = $('.donation-form');
	var $otheramount = $form.find('.other-amount');
	var $amount = $form.find('.amount');
	var outputError = function(error) {
			$('.messages')
				.html('<p>' + error + '</p>')
				.addClass('active');
			$('.submit-button')
				.removeProp('disabled')
				.val('Submit Donation');
	};
	var stripeResponseHandler = function(status, response) {
		if (response.error) {
			outputError(response.error.message);
		} else {
			var token = response['id'];
			$form.append('<input type="hidden" name="stripeToken" value="' + token + '">');
			$form.get(0).submit();
		}
	};
	var disableinput = function(amount) {
		$amount
			.val(amount)
			.blur()
			.prop('disabled');
	};
	var enableinput = function() {
		$amount
			.removeProp('disabled')
			.focus();
	};

	$('.donation-form').on('submit', function(event) {
		// Disable processing button to prevent multiple submits
		$('.submit-button')
			.prop('disabled', true)
			.val('Processing...');
	

		// Create Stripe token, check if CC information correct
		Stripe.createToken({
			number: $('.card-number').val(),
			cvc: $('.card-cvc').val(),
			exp_month: $('.card-expiry-month').val(),
			exp_year: $('.card-expiry-year').val()
		}, stripeResponseHandler);

		return false;
	});

	$('.form-amount label').on('click', function() {
		var $label = $(this);

		$label.parent().children('label').removeClass('active');
		$label.addClass('active');

		if ( $label.index() === 6 ) {
			enableinput();
		} else {
			disableinput($label.find('.set-amount').val());
		}

	});

	$amount.on('change', function() {
		$otheramount.val($(this).val());
	});

});