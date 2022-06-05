<section class="main">
		<div class="main__wrapper">
			<div class="nav-user">
				<div class="nav-user__wrapper">
					<div class="nav">
						<a class="nav__link" href="/">Главная</a>
						<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6"/>
						</svg>
						<a class="nav__link nav__link_active" href="/cabinet">Основной экран</a>
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
			<div class="greeting">
				<div class="greeting__wrap">
					<p class="greeting__text">
						Здравствуйте,
						<?= $pageData['user-name'] ?>
					</p>
					<p class="greeting__text">Рады вас видеть.</p>
				</div>
			</div>
			<div class="date">
				<div class="date__wrap">
					<p class="date__text">
						<?= $pageData['date'] ?>
					</p>
				</div>
			</div>
			<div class="directions">
				<div class="directions__wrap">
					<div class="directions__inner-title-btn">
						<p class="directions__title">Выбранные направления</p>
						<button class="directions__btn">
							<div class="directions__triangle"></div>
						</button>
					</div>
					
					<? if(empty($pageData['select-courses'])) :?>
						<div class="direction__all">
							<p class="direction__text">
								У вас еще не добавлено ни одного направления. <br>
								Хотите добавить?
								<a class="direction__link" href="/directions">Все направления.</a>
							</p>
						</div>
					<? else: ?>
						<div class="directions__all-courses">
							<div class="name-fields">
								<div class="name-fields__wrapper">
									<span class="name-fields__text">Название и описание направления</span>
									<div class="name-fields__inner">
										<span class="name-fields__text">Язык</span>
										<span class="name-fields__text name-fields__text_count">Кол-во уроков</span>
									</div>
								</div>
							</div>
							<div class="directions__courses">
								<div class="directions__courses__wrap">
									<? foreach($pageData['select-courses'] as $course) : ?>
										<div class="card-course">
											<a class="card-course__link-course" href="<?= '../course?cid=' . $course['id_course']?>">
												<div class="card-course__wrap">
													<div class="card-course__inner">
														<h2 class="card-course__name"><?= $course['course_name'] ?></h2>
														<p class="card-course__desc"><?= $course['recital'] ?></p>
													</div>
													<div class="card-course__inner">
														<p class="card-course__text"><?= $course['lang'] ?></p>
														<p class="card-course__text card-course__text_lesson"><?= $course['count_lessons'] ?></p>
													</div>
												</div>
											</a>
										</div>
									<? endforeach; ?>
								</div>
							</div>
						</div>
					<? endif; ?>
				</div>
			</div>
		</div>
	</section>