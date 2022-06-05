<div class="lessons">
	<div class="lessons__wrap">
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
					<a class="nav__link nav__link_active" href="/">
						<span>Курс: </span>
						<?= $pageData['all-data']['0']['course_name'] ?>
					</a>
				</div>
				<div class="user">
					<div class="user__inner">
						<div class="user__name-user">
							<?= $pageData['user-name']  ?>
						</div>
						<div class="user__role-user">
							<?= $pageData['user-role']  ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h3 class="lessons__head">
			<?= $pageData['all-data']['0']['course_name'] ?>
		</h3>
		<p class="lessons__lang">
			<span class="lessons__subtitle">Язык:</span>
			<span class="lessons__sub-desc">
				<?= $pageData['all-data']['0']['lang'] ?>
			</span>
		</p>
		<p class="lessons__teacher">
			<span class="lessons__subtitle">Преподаватель:</span>
			<span class="lessons__sub-desc">
				<?= $pageData['all-data']['0']['user_name'] . ' ' . $pageData['all-data']['0']['surname'] ?>
			</span>
		</p>
		<p class="lessons__desc-les">
			<span class="lessons__subtitle">Описание курса:</span>
		</p>

		<p class="lessons__desc">
			<?= $pageData['all-data']['0']['recital'] ?>
		</p>
		<div class="list-lessons">
			<div class="list-lessons__info-wrap">
				<p class="list-lessons__head">Список уроков</p>
				<div class="list-lessons__info-inner">
					<div class="list-lessons__amount-lesson">
						<span class="list-lessons__text-desc-col">Кол-во уроков:</span>
						<span class="list-lessons__text-exp">
							<?= $pageData['all-data']['0']['count_lessons'] ?>
						</span>
					</div>
					<div class="list-lessons__duration-lesson">
						<span class="list-lessons__text-desc-col">Продолжительность:</span>
						<span class="list-lessons__text-exp">02:16:00</span>
					</div>
					<div class="list-lessons__check-lesson-info">
						<span class="list-lessons__text-desc-col">Пройдено:</span>
						<span class="list-lessons__text-exp">0 уроков</span>
					</div>
				</div>
			</div>
			<div class="list-lessons__list-wrap">
				<? foreach ($pageData['all-data']['0']['lessons'] as $index => $lesson) : ?>
					<div class="list-lessons__card-line">
						<a class="list-lessons__card-link" href="<?= '../lesson?cid=' . $pageData['all-data']['0']['id_course']  . '&lid=' . $lesson['id_lesson']?>">
							<div class="list-lessons__card-line-wrap">
								<div class="list-lessons__card-text">
									<span class="list-lessons__count-lesson">
										<?= $lesson['number'] . '.' ?>
									</span>
									<span class="list-lessons__name-lesson">
										<?= $lesson['name_lesson'] ?>
									</span>
									<span class="list-lessons__duration-lesson">(08:20)</span>
									<span class="list-lessons__check-lesson">Пройдено</span>
								</div>
							</div>
						</a>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>
</div>