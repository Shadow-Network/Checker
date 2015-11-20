<?php

return $config = Array(

	// Enable test mode (not require HTTPS) 
	'test-mode'  => true,

	// Secret Key from Stripe.com Dashboard
	'secret-key' => 'sk_live_SUA KEY',

	// Publishable Key from Stripe.com Dashboard
	'publishable-key' => 'pk_live_SUA KEY',

	// Where to send upon successful donation (must include http://)
	'thank-you'  => ' thankyou.html',

	// Who the email will be from.
	'email-from' => 'h3lls1ng@shadow-network.cc',

	// Who should be BCC'd on this email. Probably an administrative email.
	'email-bcc'  => 'h3lls1ng@shadow-network.cc',

	// Subject of email receipt
	'email-subject' => 'Obrigado por Doar!!',

	// Email message. %name% is the donor's name. %amount% is the donation amount
	'email-message' => "Oi seu bosta %name%,\n\nObrigado por doar %amount% moneys. Agora você se fodeo."

);
