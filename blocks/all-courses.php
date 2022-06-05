<div class="all-courses">
	<div class="all-courses__wrap">
		<div class="nav-user">
			<div class="nav-user__wrapper">
				<div class="nav">
					<a class="nav__link" href="/">Главная</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link nav__link_active" href="/directions">Все направления</a>
				</div>
				<div class="user">
					<div class="user__inner">
						<div class="user__name-user">
							<?= $pageData['user-name'] ?>
						</div>
						<div class="user__role-user">
							<?= $pageData['user-role'] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="all-courses__head-text">Программы обучения для Full-Stack разработчика</div>
		<? if (!empty($pageData['msg'])) : ?>
			<?= $pageData['msg'] ?>
		<? endif; ?>
		<div class="all-courses__wrap-sort-courses">
			<div class="sort">
				<div class="sort__wrap">
					<p class="sort__text">
						<a class="sort__link sort__link_active" href="#">Все направления</a>
					</p>
					<p class="sort__text">
						<a class="sort__link" href="#">Frontend</a>
					</p>
					<p class="sort__text">
						<a class="sort__link" href="#">Backend</a>
					</p>
					<p class="sort__text">
						<a class="sort__link" href="#">Html</a>
					</p>
					<p class="sort__text">
						<a class="sort__link" href="#">Css</a>
					</p>
				</div>
			</div>
			<div class="preloader">
				<div class="preloader__wrap">
					<div class="preloader__text">Запрос данных..</div>
					<div class="preloader__load"></div>
				</div>
			</div>
			<div class="name-column">
				<div class="name-column__wrap">
					<p class="name-column__text name-column__program">Название программы</p>
					<div class="name-column__right">
						<p class="name-column__text name-column__lang">Язык</p>
						<p class="name-column__text">Кол-во уроков</p>
					</div>
				</div>
			</div>
			<div class="cards-courses">
				<div class="cards-courses__wrap">
					<? foreach ($pageData['courses'] as $course) : ?>
						<div data-card="<?= $course['id_course'] ?>" class="cards-courses__card">
							<div class="cards-courses__card-wrap">
								<div class="cards-courses__leftside">
									<div class="cards-courses__img">
										<img src="<?= $course['img'] ?>" alt="">
									</div>
									<div class="cards-courses__text">
										<? if ($course['check'] == 'true') : ?>
											<p class="cards-courses__check _checked">Вы записаны на данный курс</p>
										<? endif; ?>
										<div class="cards-courses__head"><?= $course['course_name'] ?></div>
										<p class="cards-courses__teacher">
											<span class="cards-courses__teacher-head">Преподаватель:</span>
											<span class="cards-courses__teacher-desc"><?= $course['user_name'] . ' ' . $course['surname'] ?></span>
										</p>
										<div class="cards-courses__desc"><?= $course['recital'] ?></div>
									</div>
								</div>
								<div class="cards-courses__rightside">
									<p class="cards-courses__lang"><?= $course['lang'] ?></p>
									<p class="cards-courses__count-lesson">
										<?= $course['count_lesson'] ?>
										уроков
									</p>
									<div class="cards-courses__sbt">
										<? if ($course['check'] == 'true') : ?>
											<button class="cards-courses__btn_delete" type="button">X</button>
										<? else : ?>
											<button class="cards-courses__btn" type="button">Записаться</button>
										<? endif; ?>
									</div>
								</div>
							</div>
						</div>
					<? endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-confirm form-confirm__wrap">
			<div class="form-confirm__wrap-form">
				<div class="form-confirm__preloader">
					<div class="form-confirm__load"></div>
				</div>
				<div class="form-confirm__inner">
					<h2 class="form-confirm__head">Подтверждение</h2>
					<p class="form-confirm__question">
						Вы хотите удалить
						<span class="form-confirm__course-name"></span>
						из выбранных направлений?
					</p>
					<div class="form-confirm__wrap-buttons">
						<button class="form-confirm__btn form-confirm__btn_confirm">Подтвердить</button>
						<button class="form-confirm__btn form-confirm__btn_cancel">Отмена</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>