<section class="homework">
	<div class="homework__wrapper">
		<div class="nav-user">
			<div class="nav-user__wrapper">
				<div class="nav">
					<a class="nav__link" href="/">Главная</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link" href="/cabinet">Основной экран</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link" href="<?= '/course?cid=' . $pageData['course']['id_course']?>">
						<span class="nav__link">Курс: </span>
						<?= $pageData['course']['course_name'] ?>
					</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link" href="<?= '/lesson?cid=' . $pageData['course']['id_course'] . '&lid=' . $pageData['lesson']['id_lesson'] ?>">
						<span class="nav__link">Урок №</span>
						<span class="nav__link"><?= $pageData['lesson']['number'] ?></span>
						<?= $pageData['lesson']['name_lesson'] ?>
					</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link nav__link_active" href="/">
						Выполнение д/з
					</a>
				</div>
				<div class="user">
					<div class="user__inner">
						<div class="user__name-user">
							<?= $pageData['user']['user-name'] ?>
						</div>
						<div class="user__role-user">
							<?= $pageData['user']['user-role'] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h3 class="homework__title">Выполнение д/з</h3>
		<h3 class="homework__subtitle">
			<span>Урок</span>
			<span><?= $pageData['lesson']['number'] ?></span>
			<span>-</span>
			<span><?= $pageData['lesson']['name_lesson'] ?></span>
		</h3>

		<? if(!empty($pageData['lesson']['url_homework'])) : ?>
			<a class="homework__link-downoload" href="<?= $pageData['lesson']['url_homework'] ?>" downoload>
				<span>Скачать файл с заданием -</span>
				<span><?= 'Урок ' . $pageData['lesson']['number'] . '. ' . $pageData['lesson']['name_lesson'] ?></span>
			</a>
		<? else : ?>
			<p class="homework__error">Задание к данному уроку отсутствует</p>
		<? endif; ?>
		<div class="homework__form">
			<div class="homework__form-wrap">
				<form>
					<div>
						<div class="homework__fake-input">
							<input class="homework__input" id="input__file" type="file">
							<div class="homework__file-inner">
								<p class="homework__file-name">Загрузка файла (не обязательно)</p>
								<label for="input__file">
									<div class="homework__icon">
										<img src="./upload/images/icon/file.svg" alt="Файл">
									</div>
								</label>
							</div>
						</div>
					</div>
					<textarea class="homework__textarea" cols="30" rows="10" placeholder="Комментарий (обязательно)"></textarea>
					<div class="homework__wrap-submit-btn">
						<button class="homework__submit-btn" type="btn">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>