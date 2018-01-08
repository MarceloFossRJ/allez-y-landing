<?php session_start(); ?>
<?php
    $statusMsg = !empty($_SESSION['msg'])?$_SESSION['msg']:'';
    unset($_SESSION['msg']);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Allez-y Brewing</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112083926-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-112083926-1');
    </script>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><img src="images/allezy_logo_white.png" class="logo"></h1>
				<p>
           A cerveja do Recreio dos Bandeirantes<br />
           Disponível para você no primeiro semestre de 2018.<br />
           Acompanhe-nos nas redes sociais, e assine nossa newsletter para notícias.
        </p>
			</header>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="action.php">
				<input type="email" name="email" id="email" placeholder="Email Address" />
				<input type="submit" value="Sign Up" />
			</form>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a target="_blank" href="https://twitter.com/AllezYBrewing" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a target="_blank" href="https://www.instagram.com/allezy.brewing/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a target="_blank" href="https://www.facebook.com/allezy.brewing/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<!--li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li-->
				</ul>
				<ul class="copyright">
					<li>&copy; Allez-y Brewing 2018.</li> <li><?php echo $statusMsg; ?></li>
				</ul>
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
