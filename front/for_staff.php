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

	<div class="navbar navbar-dark bg-dark shadow-sm"><!--навигация-->
		<div class="container-xxl">

		</div>
	</div>

	<section class="py-5 text-center container-xxl"><!--заголовок-->
		<div class="row py-lg-5">
			<div class="col-lg-6 col-md-8 mx-auto">
				<h1 class="fw-light">Заказы</h1>
				<p class="lead text-muted">Магазин заказа еды</p>
			</div>
		</div>
	</section>

	<main>
		<div class="album py-5 bg-light">
			<div class="rounded-pill card mx-auto mb-3 w-75 " id="card_block_1">
				<div class="rounded-pill card-header text-uppercase text-center ">
					<div class="container w-75 my-5">
						<div class="col">
							<h1>Заказ №12345</h1>
						</div>
						<div class="col">
							<h2>Пользователь: Андрюха</h2>
						</div>
						<div class="col"> <!--Скрыть для курьера-->
							<h2>Курьер: Леха</h2>
						</div>
						<div class="col"> <!--Скрыть для кухни-->
							<h2>Адрес: г.Мухосранск ул.Блаблабла кв.13</h2>
						</div>
						<div class="col">
							<h2>Сумма: 2997р</h2>
						</div>
						<div class="row">
							<div class="col w-25 ml-3">
								<label for="validationCustom04" class="form-label h3">Статус</label>
								<select class="form-select h3 mt-4" id="validationCustom04" required>
									<option selected disabled value="">Choose...</option>
									<option class="h4">На кухне</option>
									<option class="h4">Ждет курьера</option>
									<option class="h4">...</option>
								</select>
							</div>
							<div class="col w-25 ml-3">
								<label for="exampleFormControlTextarea1" class="form-label h3">Коментарий к заказу</label>
								<textarea class="form-control mt-4 mb-2" id="exampleFormControlTextarea1" rows="1"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col text-center d-flex justify-content-center">
								<button type="button" class="rounded-pill btn btn-primary">Принять</button>
							</div>
							<div class="col text-center d-flex justify-content-center"> <!--Скрыть для менеджера-->
								<button type="button" class="rounded-pill btn btn-primary">Подтвердить передачу</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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
		function delNode(el) {
			el.parentNode.parentNode.parentNode.style.display = "none";
		}
	</script>

</body>

</html>