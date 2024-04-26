<?php
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: signupAndLogin.php");
} else if ($_SESSION['user']['role'] == "User") {
	header("Location: main.php");
}
require_once '../back/dbConnection.php';

// Получение роли текущего пользователя
$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];
$query_role = "SELECT role FROM customer WHERE user_id = :user_id";
$stmt_role = $pdo->prepare($query_role);
$stmt_role->execute(['user_id' => $user_id]);
$user_role = $stmt_role->fetchColumn();

// Формирование запроса к базе данных в зависимости от роли пользователя
switch ($user_role) {
	case 'Manager':
		$fields = '*';
		break;
	case 'Cook':
		$fields = 'order_id, user_id, courer_id, total_price, status';
		break;
	case 'Courier':
		$fields = 'order_id, user_id, address, comment, total_price, status';
		break;
	default:
		break;
}

// Получение доступных статусов для текущей роли
$statuses = [];
switch ($user_role) {
	case 'Cook':
		$statuses = ['в готовке', 'ожидает курьера', 'переданно курьеру', 'отмена'];
		break;
	case 'Courier':
		$statuses = ['доставляется', 'доставлен', 'возникла ошибка'];
		break;
	case 'Manager':
		$statuses = ['в обработке', 'ожидает готовки', 'в готовке', 'ожидает курьера', 'переданно курьеру', 'переданно курьеру', 'отмена', 'доставляется', 'доставлен', 'возникла ошибка'];
		break;
}

// Обработка формы выбора статуса заказа
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$order_id = $_POST['order_id'];
	$new_status = $_POST['status'];
	if ($user_role == 'Courier') {
		$query_update_status = "UPDATE orders SET courer_id = :user_id, status = :status WHERE order_id = :order_id";
		$stmt_update_status = $pdo->prepare($query_update_status);
		$stmt_update_status->execute(['user_id' => $user_id, 'status' => $new_status, 'order_id' => $order_id]);
	}

	// Проверка, может ли текущий пользователь устанавливать данный статус
	if (in_array($new_status, $statuses)) {
		// Обновление статуса заказа в базе данных
		$query_update_status = "UPDATE orders SET status = :status WHERE order_id = :order_id";
		$stmt_update_status = $pdo->prepare($query_update_status);
		$stmt_update_status->execute(['status' => $new_status, 'order_id' => $order_id]);
	}
}

// Запрос к базе данных для получения данных о заказах
$query_orders = "SELECT $fields FROM orders";
$stmt_orders = $pdo->query($query_orders);
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
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asd" aria-controls="asd" aria-expanded="false">
				<a class="link-secondary" href="../back/sign_in_and_login/logout.php"><span class="info-reg">Выход</span></a>
			</button>
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
			<?php while ($row = $stmt_orders->fetch(PDO::FETCH_ASSOC)) {
				// Проверка доступности заказа для текущей роли и статуса
				if ($user_role == 'Cook' && !in_array($row['status'], ['ожидает готовки', 'в готовке', 'ожидает курьера', 'отмена'])) {
					continue;
				} elseif ($user_role == 'Courier' && !in_array($row['status'], ['в готовке', 'ожидает курьера', 'доставляется', 'доставлен', 'возникла ошибка'])) {
					continue;
				} ?>

				<div class="rounded-pill card mx-auto mb-3 w-75" id="card_block_<?php echo $row['order_id']; ?>">
					<div class="rounded-pill card-header text-uppercase text-center">
						<div class="container w-75">
							<div class="row">
								<h1>
									Заказ №<?php echo $row['order_id']; ?>
								</h1>
							</div>
							<div class="row">
								<h2>
									Пользователь: <?php echo $row['user_id']; ?>
								</h2>
							</div>
							<?php if ($user_role == 'Cook' || $user_role == 'Manager') { ?>
								<div class="row">
									<h2>
										Курьер: <?php echo $row['courer_id']; ?>
									</h2>
								</div>
							<?php } ?>
							<?php if ($user_role == 'Courier' || $user_role == 'Manager') { ?>
								<div class="row">
									<h2>
										Адрес: <?php echo $row['address']; ?>
									</h2>
								</div>
							<?php } ?>
							<?php if ($user_role == 'Courier' || $user_role == 'Manager') { ?>
								<div class="row">
									<h2>
										Комментарий: <textarea readonly><?php echo $row['comment']; ?></textarea>
									</h2>
								</div>
							<?php } ?>
							<div class="row">
								<h2>
									Сумма: <?php echo $row['total_price']; ?>р
								</h2>
							</div>
							<div class="row">
								<h2>
									Статус: <?php echo $row['status']; ?>
								</h2>
							</div>
							<!-- Меню выбора для каждой роли -->
							<?php if ($user_role == 'Manager') { ?>
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
									<select name="status">
										<?php foreach ($statuses as $status) { ?>
											<option value="<?php echo $status; ?>"><?php echo $status; ?></option>
										<?php } ?>
									</select>
									<button type="submit" class="rounded-pill btn btn-primary">Изменить статус</button>
								</form>
							<?php } ?>
							<?php if ($user_role == 'Cook') { ?>
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
									<select name="status">
										<option value="в готовке">в готовке</option>
										<option value="ожидает курьера">ожидает курьера</option>
										<option value="отмена">отмена</option>
										<option value="переданно курьеру">переданно курьеру</option>
									</select>
									<button type="submit" class="rounded-pill btn btn-primary">Изменить статус</button>
								</form>
							<?php } ?>
							<?php if ($user_role == 'Courier') { ?>
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
									<select name="status">
										<option value="доставляется">доставляется</option>
										<option value="доставлен">доставлен</option>
										<option value="возникла ошибка">возникла ошибка</option>
									</select>
									<?php if ($user_role == 'Courier' && ($row['status'] == 'в готовке' || $row['status'] == 'отменен' || $row['status'] == 'доставлен')) { ?>
										<button disabled type="submit" class="rounded-pill btn btn-primary">Изменить статус</button>
									<?php } ?>
									<?php if ($user_role == 'Courier' && $row['status'] == 'ожидает курьера' || $row['status'] == 'переданно курьеру' || $row['status'] == 'доставляется' || $row['status'] == 'возникла ошибка') { ?>
										<button type="submit" class="rounded-pill btn btn-primary">Изменить статус</button>

									<?php } ?>
								</form>
							<?php } ?>
							<!-- <div class="row">
								<div class="col w-25 ml-3">
									<label for="validationCustom04" class="form-label h3">Смена статуса</label>
									<select class="form-select h3 mt-4" id="validationCustom04" required>
										<option selected disabled value="">Choose...</option>
										<option class="h4">На кухне</option>
										<option class="h4">Ждет курьера</option>
										<option class="h4">...</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col text-center d-flex justify-content-center">
									<button type="button" class="rounded-pill btn btn-primary">Принять</button>
								</div>
								<div class="col text-center d-flex justify-content-center"> <!--Скрыть для менеджера-->
							<!-- <button type="button" class="rounded-pill btn btn-primary">переданно курьеру</button>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</main>

	<footer class="text-center text-lg-start text-white fixed-bottom" style="background-color: #212529">
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