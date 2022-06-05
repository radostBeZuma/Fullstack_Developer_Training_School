<div class="my-courses">
	<div class="my-courses__wrap">
	<div class="nav-user">
			<div class="nav-user__wrapper">
				<div class="nav">
					<a class="nav__link" href="/">Главная</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link nav__link_active" href="/directions">Мои курсы</a>
				</div>
				<div class="user">
					<div class="user__inner">
						<div class="user__name-user">
							Ксюшка Антонова
						</div>
						<div class="user__role-user">
							преподаватель
						</div>
					</div>
				</div>
			</div>
		</div>
		<h3 class="my-courses__title">Курсы, которые вы ведете в данный момент</h3>
		<div class="my-courses__courses">
			<? $i = 0 ?>
			<? foreach($pageData['data'] as $index) : ?>
				
			<div class="my-courses__course-wrap">
				<div class="my-courses__course-inner">
					
					<p class="my-courses__course-name"><?= $index['course'] ?></p>
					<div class="my-courses__btn-open-circle">
						<div class="my-courses__btn-open-rectangle"></div>
					</div>
				</div>
				<div class="my-courses__course-table">
					<div class="my-courses__table-main-row">
						<div class="my-courses__table-col-main my-courses__table-col_number">Н/у</div>
						<div class="my-courses__table-col-main my-courses__table-col_name">Название урока</div>
						<div class="my-courses__table-col-main my-courses__table-col_desc">Описание урока</div>
						<div class="my-courses__table-col-main my-courses__table-col_video">
							<p>Видео</p>
							<p>(.mp4, .webm, .mpeg)</p>
						</div>
						<div class="my-courses__table-col-main my-courses__table-col_poster">
							<p>Постер</p>
							<p>(.jpeg, .jpg, .png)</p>
						</div>
						<div class="my-courses__table-col-main my-courses__table-col_homework">
							<p>Домашняя работа</p>
							<p>(.docx, .doc)</p>
						</div>
						<div class="my-courses__table-col-main my-courses__table-col_lecture">
							<p>Лекция</p>
							<p>(.php)</p>
						</div>
						<div class="my-courses__table-col-main my-courses__table-col_tools">Инстр.</div>
					</div>
					<? foreach($index['lessons'] as $lesson) : ?>
						<!-- Итератор для того, чтобы лейблы могли обращаться к своему инпуту, иначе краш -->
						<? $i++ ?> 
					<div class="my-courses__table-regular-row">
						<div class="my-courses__table-col-regular my-courses__table-col_number my-courses__col-regular-number"><?=  $lesson['number'] ?></div>
						<div class="my-courses__table-col-regular my-courses__table-col_name my-courses__table-col-name">
							<textarea class="my-courses__table-col-regular_textarea my-courses__table-col-regular_textarea-name" rows="10"><?= $lesson['name_lesson'] ?></textarea>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_desc">
							<textarea class="my-courses__table-col-regular_textarea my-courses__table-col-regular_textarea-recital" rows="10"><?= $lesson['recital'] ?></textarea>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_video my-courses__col-regular-video">
							<span class="my-courses__upload-text"><?= $lesson['url_video'] ?></span>
							<div class="my-courses__upload">
								<div class="my-courses__upload-wrap">
									<input class="my-courses__upload-input my-courses__upload-input-video" id="input__file-video-<?= $i?>" type="file" accept=".mp4, .webm, .mpeg">
									<div class="my-courses__file-inner">
										<label for="input__file-video-<?= $i?>">
											<div class="my-courses__upload-icon">
												<img src="./upload/images/icon/upload.svg" alt="Файл">
											</div>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_poster my-courses__col-regular-poster">
							<span class="my-courses__upload-text"><?= $lesson['url_poster'] ?></span>
							<div class="my-courses__upload">
								<div class="my-courses__upload-wrap">
									<input class="my-courses__upload-input my-courses__upload-input-poster" id="input__file-poster-<?= $i?>" type="file" accept=".jpeg, .jpg, .png">
									<div class="my-courses__file-inner">
										<label for="input__file-poster-<?= $i?>">
											<div class="my-courses__upload-icon">
												<img src="./upload/images/icon/upload.svg" alt="Файл">
											</div>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_homework my-courses__col-regular-homework">
							<span class="my-courses__upload-text"><?= $lesson['url_homework'] ?></span>
							<div class="my-courses__upload">
								<div class="my-courses__upload-wrap">
									<input class="my-courses__upload-input my-courses__upload-input-homework" id="input__file-homework-<?= $i?>" type="file" accept=".docx, .doc">
									<div class="my-courses__file-inner">
										<label for="input__file-homework-<?= $i?>">
											<div class="my-courses__upload-icon">
												<img src="./upload/images/icon/upload.svg" alt="Файл">
											</div>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_lecture my-courses__col-regular-lecture">
							<span class="my-courses__upload-text"><?= $lesson['url_lecture'] ?></span>
							<div class="my-courses__upload">
								<div class="my-courses__upload-wrap">
									<input class="my-courses__upload-input my-courses__upload-input-lecture" id="input__file-lecture-<?= $i?>" type="file" accept=".php">
									<div class="my-courses__file-inner">
										<label for="input__file-lecture-<?= $i?>">
											<div class="my-courses__upload-icon">
												<img src="./upload/images/icon/upload.svg" alt="Файл">
											</div>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="my-courses__table-col-regular my-courses__table-col_tools">Инстр.</div>
					</div>
					<? endforeach; ?>
				</div>
			</div>
			<? endforeach; ?>
		</div>
		<div class="preloader">
			<div class="preloader__wrap">
				<div class="preloader__text">
					<span class="preloader__title"></span>
					<span class="preloader__desc"></span>
				</div>
				<div class="preloader__load"></div>
			</div>
		</div>
		<!-- <button class="btn_xml">Кнопка</button> -->
	</div>
</div>