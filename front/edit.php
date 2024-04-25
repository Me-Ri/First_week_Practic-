<?php
require_once('../back/dbConnection.php');
if (empty($_POST['id'])) {
	header("Location: main.php");
}
$item_id = $_POST['id'];

$query = "SELECT * FROM Items WHERE Item_ID = '$item_id'";
$items = $pdo -> query($query);
$item = $items->fetch(PDO::FETCH_ASSOC);
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

	<header>

		<div class=" collapse bg-dark" id="navbarHeaderOrder"><!--карточка моего заказа-->
			<div class="album py-5 bg-light">
				<div class="card mx-auto">
					<div class="card-header text-uppercase text-center">
						<div class="container">
							<div class="row">
								<h1>Название товара</h1>
							</div>
							<div class="row">
								<h2>999p</h2>
							</div>
							<div class="row">
								<h2>Статус</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card mx-auto">
					<div class="card-header text-uppercase text-center">
						<div class="container">
							<div class="row">
								<h1>Название товара</h1>
							</div>
							<div class="row">
								<h2>999p</h2>
							</div>
							<div class="row">
								<h2>Статус</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card mx-auto">
					<div class="card-header text-uppercase text-center">
						<div class="container">
							<div class="row">
								<h1>Название товара</h1>
							</div>
							<div class="row">
								<h2>999p</h2>
							</div>
							<div class="row">
								<h2>Статус</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="navbar navbar-dark bg-dark shadow-sm"><!--навигация-->
			<div class="container-xxl">
				<button class="navbar-toggler" type="button">
					<!-- <span class="info-reg">Корзина</span> -->
					<a class="link-secondary" href="basket.php"><span class="info-reg">Корзина</span></a>
				</button>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeaderOrder" aria-controls="navbarHeaderOrder" aria-expanded="false" aria-label="Переключить навигацию">
					<span class="info-reg">Мой заказ</span>
				</button>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asd" aria-controls="asd" aria-expanded="false">
					<span class="info-reg">Вход</span>
				</button>
			</div>
		</div>

	</header>

	<main>

		<div class="collapse bg-dark" id="asd"><!--регистрация и авторизация-->
			<div class="container-xxl">
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<div class="tab" role="tabpanel">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">sign in</a></li>
								<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">sign up</a>
								</li>
							</ul>

							<div class="tab-content tabs">

								<div role="tabpanel" class="tab-pane fade in active" id="Section1">
									<form class="form-horizontal">
										<div class="form-group">
											<label for="exampleInputEmail1">username</label>
											<input type="email" class="form-control" id="exampleInputEmail1">
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">Password</label>
											<input type="password" class="form-control" id="exampleInputPassword1">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-default">Sign in</button>
										</div>
									</form>
								</div>

								<div role="tabpanel" class="tab-pane fade" id="Section2">
									<form class="form-horizontal">
										<div class="form-group">
											<label for="exampleInputEmail1">First Name</label>
											<input type="text" class="form-control" id="exampleInputEmail1">
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Last Name</label>
											<input type="text" class="form-control" id="exampleInputEmail1">
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="exampleInputEmail1">
										</div>

										<div class="form-group">
											<label for="exampleInputPassword1">Password</label>
											<input type="password" class="form-control" id="exampleInputPassword1">
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
		</div>

		<section class="py-5 text-center container-xxl"><!--заголовок-->
			<div class="row py-lg-5">
				<div class="col-lg-6 col-md-8 mx-auto">
					<h1 class="fw-light">Товары</h1>
					<p class="lead text-muted">Магазин заказа еды</p>
				</div>
			</div>
		</section>

		<form action="../back/CRUD/updateItem.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $item_id ?>">
			<div style="margin-left: 30px">
				<label>Загрузите фотографию блюда</label>
				<input type="file" name="image">
				<br>
				<label>Введите название блюда</label> <br>
				<input type="text" name="name" value="<?php echo $item['name'] ?>" style="margin-bottom: 10px">
				<br>
				<label>Введите описание блюда</label> <br>
				<input type="text" name="description" value="<?php echo $item['description'] ?>" style="margin-bottom: 10px">
				<br>
				<label>Введите стоимость блюда</label> <br>
				<input type="number" name="price" value="<?php echo $item['price'] ?>" style="margin-bottom: 10px">
				<br>
				<button type="submit">Обновить</button>
			</div>
		</form>
		<form action="../back/CRUD/deleteItem.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $item_id ?>">
			<button type="submit" style="margin-left: 20px">Удалить блюдо</button>
		</form>

	</main>

	<footer class="text-center text-lg-start text-white" style="background-color: #212529">
		<div class="container p-4 pb-0">
			<section class="">
				<div class="row">

					<div class="col-6 text-center">
						<h6 class="text-uppercase mb-4 font-weight-bold h3">
							Ссылки
						</h6>
						<p>
							<a href="https://github.com/Me-Ri/First_week_Practic-" class="text-white">GitHab</a>
						</p>
					</div>

					<hr class="w-100 clearfix d-md-none">

					<div class="col-6 text-center">
						<h6 class="text-uppercase mb-4 font-weight-bold h3">Контакты</h6>
						<p><i class="fas fa-home mr-3"></i> Ханты-Мансийск, ул.Чехова, 16</p>
						<p><i class="fas fa-envelope mr-3"></i> egor.evdakimov@yandex.ru</p>
						<p><i class="fas fa-phone mr-3"></i> +7 902 592 57 30</p>
					</div>
				</div>
			</section>

			<hr class="my-3">
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<script>
		function viewDiv1() {
			document.getElementById("card_block_1").style.display = "block";
		};

		function viewDiv2() {
			document.getElementById("card_block_2").style.display = "block";
		};

		function viewDiv3() {
			document.getElementById("card_block_3").style.display = "block";
		};
	</script>

	<script>
		function delNode(el) {
			el.parentNode.parentNode.parentNode.style.display = "none";
		}
	</script>


</body>

</html>