<?  // session_start(); ini_set('display_errors',1); // error_reporting(E_ALL);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="image/png" sizes="16x16" rel="icon" href="../upload/images/favicon.png">
	
		<link rel="stylesheet" href="../css/component.css">
		<!-- Blocks CSS -->
	
		<link rel="stylesheet" href="../css/main/header.css">
		<link rel="stylesheet" href="../css/main/info.css">
		<link rel="stylesheet" href="../css/main/directions.css">
		<link rel="stylesheet" href="../css/main/login.css">
		<link rel="stylesheet" href="../css/main/registration.css">

		<!-- //Blocks CSS end -->

		<!-- Block JS -->

		<script src="../js/registration.js"></script>
		<script src="../js/login.js"></script>
		<script src="../js/header.js"></script>

		<!-- //Blocks JS end -->
	<title><?= $pageData['title'] ?></title>
</head>
<body>
<!-- Header start -->
	<header class="header">
		<div class="header__container">
			<div class="header__leftside">
				<div class="logo">
					<a class="logo__link" href="/">VotBLN</a>
				</div>
				<nav class="menu">
					<ul class="menu__list">
						<li class="menu__item">
							<a class="menu__link" href="#">Программы</a>
						</li>
						<li class="menu__item">
							<a class="menu__link" href="#">Базы знаний</a>
						</li>
						<li class="menu__item">
							<a class="menu__link" href="#">О платформе</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="header__rightside">
				<? if(empty($_SESSION['student']) && empty($_SESSION['teacher']) ) :?>
						<div class="header__rightside-wrap">
							<div class="header__login">
								<button class="header__login-link">Вход</button>
							</div>
							<div class="header__registr">
								<button class="header__registr-link">Регистрация</button>
							</div>
						</div>
				<?else:?>
					<? if(!empty($pageData['user_name'])) : ?>
						<p class="header__user-name"><?= $pageData['user_name']?></p>
						<div class="menu-user">
							<div class="menu-user__wrap">
								<p class="menu-user__text">
									<? if(!empty($_SESSION['student'])) : ?>
										<a class="menu-user__link" href="/cabinet">Кабинет</a>
									<?else:?>
										<a class="menu-user__link" href="/office">Кабинет</a>
									<?endif;?>
								</p>
								<p class="menu-user__text">
									<a class="menu-user__link menu-user__link_red" href="/index/logout">Выйти из профиля</a>
								</p>
							</div>
						</div>
					<?endif;?>
				<?endif;?>
			</div>
		</div>
	</header>
<!-- //Header end -->
	<main>
<!-- INFO start -->
		<section class="info">
			<div class="info-top">
				<img class="info-top__img" src="../upload/images/info-top.jpg" alt="">
				<h1 class="info-top__title">Образовательная платформа</h1>
				<p class="info-top__desc">Данная платформа предоставляет курсы по IT-специальностям, веб-дизайну, а также <br> профессиональной ретуши фотографий.</p>
				<a href="" class="info-top__link btn-white">Направления</a>
			</div>
			<div class="info-bottom">
				<div class="info-bottom__wrap">
					<h2 class="info-bottom__title">Информация о платформе</h2>
					<div class="info-bottom__content">
						<p class="info-bottom__text">Также как постоянный количественный рост и сфера нашей активности напрямую зависит от системы обучения кадров, соответствующей насущным потребностям. Внезапно, базовые сценарии поведения пользователей смешаны с не уникальными данными до степени совершенной неузнаваемости, из-за чего возрастает их статус бесполезности. Прежде всего, перспективное планирование способствует подготовке и реализации.</p>
						<p class="info-bottom__text">Также как постоянный количественный рост и сфера нашей активности напрямую зависит от системы обучения кадров, соответствующей насущным потребностям. Внезапно, базовые сценарии поведения пользователей смешаны с не уникальными данными до степени совершенной неузнаваемости, из-за чего возрастает их статус бесполезности. Прежде всего, перспективное планирование способствует подготовке и реализации.</p>
					</div>
					<div class="info-bottom__link">
						<a class="info-bottom__link-item" href="#">Подробнее >></a>
					</div>
				</div>
			</div>
		</section>
<!-- //INFO end -->
<!-- DIRECTIONS start -->
		<section class="directions">
			<div class="directions__wrap">
				<h2 class="directions__title">Направления</h2>
				<p class="directions__desc">Профессия веб-разработчик</p>
				<div class="direction__cards">
				<div class="card">
					<div class="card__wrap">
						<p class="card__title">Основы вёрстки сайтов</p>
						<div class="card__desc">
							<ul class="card__list">
								<li class="card__item">Консультация с широким активом обеспечивает широкому кругу (специалистов) участие в</li>
								<li class="card__item">Формировании своевременного выполнения сверхзадачи.</li>
								<li class="card__item">Идейные соображения высшего порядка, а также дальнейшее</li>
								<li class="card__item">Развитие различных форм деятельности способствует подготовке и реализации.</li>
							</ul>
						</div>
						<div class="card__link">
							<a class="card__link-item btn" href="">Перейти</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card__wrap">
						<p class="card__title">Веб-разработка <br> для начинающих</p>
						<div class="card__desc">
							<ul class="card__list">
								<li class="card__item">Консультация с широким активом обеспечивает широкому кругу (специалистов) участие в</li>
								<li class="card__item">Формировании своевременного выполнения сверхзадачи.</li>
								<li class="card__item">Идейные соображения высшего порядка, а также дальнейшее</li>
								<li class="card__item">Развитие различных форм деятельности способствует подготовке и реализации.</li>
							</ul>
						</div>
						<div class="card__link">
							<a class="card__link-item btn" href="">Перейти</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card__wrap">
						<p class="card__title">Основы вёрстки сайтов</p>
						<div class="card__desc">
							<ul class="card__list">
								<li class="card__item">Консультация с широким активом обеспечивает широкому кругу (специалистов) участие в</li>
								<li class="card__item">Формировании своевременного выполнения сверхзадачи.</li>
								<li class="card__item">Идейные соображения высшего порядка, а также дальнейшее</li>
								<li class="card__item">Развитие различных форм деятельности способствует подготовке и реализации.</li>
							</ul>
						</div>
						<div class="card__link">
							<a class="card__link-item btn" href="">Перейти</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</section>
<!-- //DIRECTIONS end -->
	</main>

	<div class="login">
		<div class="login__bg">
			<div class="login__wrap">
				<div class="login__exit">
					<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.1019 20.3961L12.9185 15.1337L7.74278 20.2316L5.35047 17.8028L10.5262 12.7048L5.34277 7.44241L7.62704 5.19244L12.8104 10.4549L18.0151 5.32846L20.4074 7.75726L15.2027 12.8837L20.3861 18.1462L18.1019 20.3961Z" fill="#2B2F3D"/>
					</svg>
				</div>
				<h2 class="login__title">Вход в учетную запись</h2>
				<form  class="form form__wrap" method="POST">
					<input type="hidden" name="action" value="login">
					<input class="form__input" type="text" name="login" placeholder="Логин">
					<input class="form__input" type="password" name="pass" placeholder="Пароль" autocomplete="on">
					<p class="form__error">
						<? if(!empty($pageData['error_login'])) : ?>
							<?= $pageData['error_login']?>
						<?endif;?>
					</p>
					<div class="form__bottom">
						<input class="form__submit btn" type="submit" value="Войти">
						<p class="form__text">
							Вы хотели зарегистрироваться?
							<button class="form__link reg-link" type="button">Регистрация</button>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="registration">
		<div class="registration__bg">
			<div class="registration__wrap">
				<div class="preloader">
					<p class="preloader__text">Загрузка данных...</p>
					<div class="preloader__circle"></div>
				</div>
				<div class="registration__exit">
					<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.1019 20.3961L12.9185 15.1337L7.74278 20.2316L5.35047 17.8028L10.5262 12.7048L5.34277 7.44241L7.62704 5.19244L12.8104 10.4549L18.0151 5.32846L20.4074 7.75726L15.2027 12.8837L20.3861 18.1462L18.1019 20.3961Z" fill="#2B2F3D"/>
					</svg>
				</div>
				<div class="rigit__t">
					<h3>Вы зарегистрировались!</h3>
					<p>Теперь вам необходимо авторизировать с данными, которые вы внесли в систему для регистрации своего аккаунта.</p>
				</div>
				<div class="registration__inner">
					<h2 class="registration__title">Регистрация пользователя</h2>
					<form  class="form form__wrap" method="POST">
						<input class="form__input regist-name" type="text" name="name" placeholder="Ваше имя">
						<input class="form__input regist-surname" type="text" name="surname" placeholder="Ваша фамилия">
						<input class="form__input regist-login" type="text" name="login" placeholder="Логин">
						<input class="form__input regist-password" type="password" name="pass" placeholder="Пароль" autocomplete="on">
						<div class="form__bottom">
							<input class="form__submit btn registr" type="button" value="Регистрация">
							<p class="form__text">
								Вы хотели войти в систему?
								<button class="form__link login-link" type="button">Войти</button>
							</p>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<footer style="font-size: 24px; text-align: center; padding: 20px 0; background-color: black; color: white;">Здесь когда-то будет футер</footer>
</body>
</html>