<?php  
require_once 'connect.php';
$query = mysqli_query($connect, "SELECT * FROM Items");
$query = mysqli_fetch_all($query);
session_start();
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

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


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
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!--Форма добавление нового товара-->
	<div class="modal fade" id="managerModal" tabindex="-1" aria-labelledby="managerModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="exampleModalLabel">Новый товар</h2>
				</div>
				<div class="modal-body">
					<form class="row g-3">
						<div class="col-6">
							<label for="inputAddress" class="form-label h3">Название</label>
							<input type="text" class="form-control" id="inputAddress" required>
						</div>
						<div class="col-6">
							<label for="inputAddress" class="form-label h3">Цена</label>
							<input type="number" class="form-control" id="inputAddress" required>
						</div>
						<div class="col-12">
							<div class="input-group mb-3 h4">
								<span class="input-group-text h4" id="inputGroupFileAddon01">Изображение</span>
								<div class="form-file">
									<input type="file" class="form-file-input" id="inputGroupFile01"
										aria-describedby="inputGroupFileAddon01">
								</div>
							</div>
						</div>
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label h3">Описание</label>
							<textarea class="form-control mt-4" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label h3">Ингридиенты(через
								запятую)</label>
							<textarea class="form-control mt-4" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</div>
		</div>
	</div>

	<!--Форма редактирования товара-->
	<div class="modal fade" id="managerModalRedact" tabindex="-1" aria-labelledby="managerModalRedactLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="exampleModalLabel">Редактирование</h2>
				</div>
				<div class="modal-body">
					<form class="row g-3">
						<div class="col-6">
							<label for="inputAddress" class="form-label h3">Название</label>
							<input type="text" class="form-control" id="inputAddress" required>
						</div>
						<div class="col-6">
							<label for="inputAddress" class="form-label h3">Цена</label>
							<input type="number" class="form-control" id="inputAddress" required>
						</div>
						<div class="col-12">
							<div class="input-group mb-3 h4">
								<span class="input-group-text h4" id="inputGroupFileAddon01">Изображение</span>
								<div class="form-file">
									<input type="file" class="form-file-input" id="inputGroupFile01"
										aria-describedby="inputGroupFileAddon01">
								</div>
							</div>
						</div>
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label h3">Описание</label>
							<textarea class="form-control mt-4" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label h3">Ингридиенты(через
								запятую)</label>
							<textarea class="form-control mt-4" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
					<button type="submit" class="btn btn-primary">Удалить</button>
				</div>
			</div>
		</div>
	</div>

	<header>

		<div class=" collapse bg-dark" id="navbarHeaderOrder"><!--карточка моего заказа-->
			<div class="album py-5 bg-light">
				<div class="card mx-auto rounded-pill w-75 mt-2">
					<div class="card-header text-uppercase text-center rounded-pill">
						<div class="container">
							<div class="col">
								<h1>Заказ №12345</h1>
							</div>
							<div class="col">
								<h2>999p</h2>
							</div>
							<div class="col">
								<h2>Статус</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="navbar navbar-dark bg-dark shadow-sm"><!--навигация-->
			<div class="container-xxl">
				<button class="navbar-toggler" type="button"> <!--Убирать для менеджера-->
					<a class="link-secondary" href="basket.php"><span class="info-reg">Корзина</span></a>
				</button>
				<!--Добавить для менеджера-->
				<button type="button" class="navbar-toggler link-secondary" data-toggle="modal"
					data-target="#managerModal"><span class="info-reg">Добавить товар</span>
				</button>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarHeaderOrder" aria-controls="navbarHeaderOrder" aria-expanded="false"
					aria-label="Переключить навигацию">
					<span class="info-reg">Мой заказ</span>
				</button>
				<!--Убрать для авторизованных-->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asd"
					aria-controls="asd" aria-expanded="false">
					<a class="link-secondary" href="reg_form.html"><span class="info-reg">Вход</span></a>
				</button>
				<!--Убрать для не авторизованных-->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asd"
					aria-controls="asd" aria-expanded="false">
					<a class="link-secondary" href="reg_form.html"><span class="info-reg">Выход</span></a>
				</button>
			</div>
		</div>

	</header>

	<main>
		<section class="py-5 text-center container-xxl"><!--заголовок-->
			<div class="row py-lg-5">
				<div class="col-lg-6 col-md-8 mx-auto">
					<h1 class="fw-light">Товары</h1>
					<p class="lead text-muted">Магазин заказа еды</p>
				</div>
			</div>
		</section>
		<?php 
		$cards = mysqli_query($connect, "SELECT * FROM Items");
		
		?>

		<div class="album py-5 bg-light">
			<div class="container-xxl"><!--карточка товара-->
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<?php
					 while ($card = mysqli_fetch_assoc($cards)) {
					?>
					<div class="col">
						<div class="card shadow-sm">
							<img style="max-height: 28rem; min-height: 28rem;" src="<?php echo $card['img_pass'] ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-8 h2">
										<?php echo $card['Name'] ?>
									</div>
									<div class="col-4 text-center h2 d-flex justify-content-center">
										<?php echo $card['Price'] ?> р
									</div>
								</div>
								<p class="card-text">Тут будет описание товара</p>
								<div class="row">
									<!--Показывать для менеджера-->
									<div class="col-12 text-center d-flex justify-content-center mb-1 d-none">

										<div class="dropdown w-75">
											<button type="button" class="navbar-toggler link-secondary"
												data-toggle="modal" data-target="#managerModalRedact"><span
													class="info-reg">Редактировать</span>
											</button>
										</div>
									</div>
									<div class="col text-center d-flex justify-content-center">								
									<form action="addToCart.php" method="post" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?php echo $card['id'] ?>">
										<button type="submit" class="btn btn-sm btn-secondary"
											onclick=viewDiv1()>Добавить в
											корзину</button>
									</form>
									</div>
									<div class="col text-center d-flex justify-content-center">
										<div class="dropdown w-75">
											<button class="btn btn-secondary dropdown-toggle" type="button"
												id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
												Редактировать
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<li>
													<div class="form-check form-switch h4">
														<input class="form-check-input" type="checkbox"
															id="flexSwitchCheckChecked" checked>
														<label class="form-check-label"
															for="flexSwitchCheckChecked">лук</label>
													</div>
												</li>
												<li>
													<div class="form-check form-switch h4">
														<input class="form-check-input" type="checkbox"
															id="flexSwitchCheckChecked" checked>
														<label class="form-check-label"
															for="flexSwitchCheckChecked">огурец</label>
													</div>
												</li>
												<li>
													<div class="form-check form-switch h4">
														<input class="form-check-input" type="checkbox"
															id="flexSwitchCheckChecked" checked>
														<label class="form-check-label"
															for="flexSwitchCheckChecked">перец</label>
													</div>
												</li>
											</ul>
										</div>
									</div>


								</div>
							</div>

						</div>
					 </div>
					<?php }?>
				</div>
			</div>
		</div>
		</div>

	</main>

	<footer class="text-muted py-5 bg-dark">
		<div class="container-xxl">Тут что то будет</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
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
		function delNode(el) { el.parentNode.parentNode.parentNode.style.display = "none"; }
	</script>


</body>

</html>