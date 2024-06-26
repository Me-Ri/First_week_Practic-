<?php
session_start();
if (isset($_SESSION['user'])) {
	header('Location: main.php');
}
?>

<!doctype html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="generator" content="Hugo 0.80.0">

	<title>Пример магазина</title>

	<link rel="canonical" href="https://getbootstrap.su/docs/5.0/examples/album/">
	<link rel="stylesheet" href="css.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


	<!-- Bootstrap core CSS -->
	<link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
	<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">


	<meta name="theme-color" content="#7952b3">

</head>

<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<div class="container-xxl">
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				<div class="tab" role="tabpanel">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">sign in</a></li>
						<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">sign up</a>
						</li>
						<!-- <li role="presentation"><a href="main.php">back</a>
						</li> -->
					</ul>

					<div class="tab-content tabs">

						<div role="tabpanel" class="tab-pane fade in active" id="Section1">
							<form class="form-horizontal" method="post" action="../back/sign_in_and_login/signup.php">
								<div class="form-group">
									<label for="exampleInputEmail1">email</label>
									<input type="email" class="form-control" id="exampleInputEmail1" name="Email">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" name="Password">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-default">Sign in</button>
								</div>
								<?php
								if (isset($_SESSION['message'])) {
									echo '<label class = "h3 text-danger"> ' . $_SESSION['message'] . '</label>';
								}
								unset($_SESSION['message']);
								?>
							</form>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="Section2">
							<form class="form-horizontal" method="post" action="../back/sign_in_and_login/createAcc.php">
								<div class="form-group">
									<label for="exampleInputEmail1">First Name</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="Name">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Last Name</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="Surname">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<input type="email" class="form-control" id="exampleInputEmail1" name="Email">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" name="Password">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword1">Confirm Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" name="CPassword">
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-default">Sign up</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


</body>

</html>