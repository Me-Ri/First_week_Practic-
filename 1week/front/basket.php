<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: signupAndLogin.php");
} else if($_SESSION['user']['role'] == "Cook") {
	header("Location: for_staff.php");
} else if($_SESSION['user']['role'] == "Manager") {
	header("Location: main.php");
}
require_once '../back/dbConnection.php';
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

	<div class="navbar navbar-dark bg-dark shadow-sm"><!--навигация-->
		<div class="container-xxl">
			<button class="navbar-toggler" type="button">
				<!-- <span class="info-reg">Корзина</span> -->
				<a class="link-secondary" href="main.php"><span class="info-reg">Назад</span></a>
			</button>
		</div>
	</div>

	<section class="py-5 text-center container-xxl"><!--заголовок-->
		<div class="row py-lg-5">
			<div class="col-lg-6 col-md-8 mx-auto">
				<h1 class="fw-light">Корзина</h1>
				<p class="lead text-muted">Магазин заказа еды</p>
			</div>
		</div>
	</section>

	<main> <!--карточки заказов-->
		<?php
		$user_id = $_SESSION['user']['id'];
		$query = "SELECT Item_ID FROM User_Item WHERE User_ID = '$user_id'";
		$cart = $pdo -> query($query);
		$number_of_rows = $cart -> rowCount();
		$total_price = 0;
		$total_items = "";
		?>

		<div class="album py-5 bg-light">
			<?php
			if ($number_of_rows > 0) {
				while ($item = $cart->fetch(PDO::FETCH_ASSOC)) {
					$item_id = $item['item_id'];
					$query = "SELECT * FROM Items WHERE Item_ID = '$item_id'";
					$itemData = $pdo -> query($query);
					$itemData = $itemData->fetch(PDO::FETCH_ASSOC);
					$total_price += $itemData['price'];
					$total_items .= $itemData['name'] . ', ';

			?>
					<div class="rounded-pill card mx-auto mb-3 w-75" id="card_block_1">
						<div class="rounded-pill card-header text-uppercase text-center">
							<div class="container w-75">
								<div class="row">
									<h1>
										<?php echo $itemData['name'] ?>
									</h1>
								</div>
								<div class="row">
									<h2>
										<?php echo $itemData['price'] ?> р
									</h2>
								</div>
								<form action="../back/CRUD/deleteCartItem.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="user_id" value="<?php echo 1 ?>">
									<input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?>">
									<button type="submit" class="btn btn-dark text-center w-25" onclick="">Удалить</button>
								</form>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				<div class="d-flex justify-content-center">
					<button type="button" class="rounded-pill btn btn-primary w-25" data-toggle="modal" data-target="#exampleModal">Заказать (
						<?php echo $total_price . " руб" ?>)
					</button>
				</div>
			<?php
			} else {
				echo '<p class="text-muted text-center h3">Корзина пуста</p>';
			}
			?>
		</div>

		<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title" id="exampleModalLabel">Оформление заказа</h2>
		</div>
		<div class="modal-body">
			<form action="../back/CRUD/createOrder.php" method="post" enctype="multipart/form-data" class="row g-3">
				<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
				<input type="hidden" name="total_price" value="<?php echo $total_price ?>">
				<input type="hidden" name="items_list" value="<?php echo $total_items ?>">
				<div class="col-4">
					<label for="inputAddress" class="form-label h3">Улица</label>
					<input type="text" name="street" class="form-control" id="inputAddress" required>
				</div>
				<div class="col-4">
					<label for="inputAddress" class="form-label h3">Дом</label>
					<input type="text" name="house" class="form-control" id="inputAddress" required>
				</div>
				<div class="col-4">
					<label for="inputAddress" class="form-label h3">Квартира</label>
					<input type="text" name="flat" class="form-control" id="inputAddress" required>
				</div>

				<div class="col-12">
					<select class="form-select h3" name="time_dur" aria-label="Default select example">
						<option selected>Как можно скорее</option>
						<option><?php echo date('H:i',time()+(2 * 3600)+3600); ?></option>
                                <option><?php echo date('H:i',time()+(2 * 3600)+(3600 * 1.5)); ?></option>
                                <option><?php echo date('H:i',time()+(2 * 3600)+(3600 * 2)); ?></option>
                                <option><?php echo date('H:i',time()+(2 * 3600)+(3600 * 2.5)); ?></option>
					</select>
				</div>
				<div class="col-12">
					<label for="exampleFormControlTextarea1" class="form-label h3">Коментарий к заказу</label>
					<textarea style="resize: none;" name="description" rows="3" class="form-control mt-4" id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
		</form>
	</div>

</div>
</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<script>
		function delNode(el) {
			el.parentNode.parentNode.parentNode.style.display = "none";
		}
	</script>


</body>

</html>