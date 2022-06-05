<div class="lesson">
	<div class="lesson__wrap">
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
					<a class="nav__link" href="<?= '../course?cid=' . $pageData['course']['id_course'] ?>">
						<span class="nav__link">Курс: </span>
						<?= $pageData['course']['course_name'] ?>
					</a>
					<svg class="polygon" width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 4L0.75 7.4641L0.75 0.535898L6 4Z" fill="#2B2F3D" fill-opacity="0.6" />
					</svg>
					<a class="nav__link nav__link_active" href="/">
						<span>Урок №</span>
						<span><?= $pageData['lesson']['number'] ?></span>
						<?= $pageData['lesson']['name_lesson'] ?>
					</a>
				</div>
				<div class="user">
					<div class="user__inner">
						<div class="user__name-user">
							<?= $pageData['user']['user-name']  ?>
						</div>
						<div class="user__role-user">
							<?= $pageData['user']['user-role']  ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h3 class="lesson__head">Изучение урока</h3>
		<h3 class="lesson__les-title">
			<span>Урок №</span>
			<span><?= $pageData['lesson']['number'] ?></span>
			<span>-</span>
			<span><?= $pageData['lesson']['name_lesson'] ?></span>
		</h3>
		<div class="lesson-video">
			<video class="lesson-video__element" poster="<?= $pageData['lesson']['url_poster']?>">
				<source src="<?= $pageData['lesson']['url_video']?>" type='video/mp4'>
			</video>
			<div class="lesson-video__tools-container">
				<div class="lesson-video__play _active">
					<img src="/upload/images/icon/play.svg" alt="Проигрывание">
				</div>
				<div class="lesson-video__pause">
					<img src="/upload/images/icon/pause.svg" alt="Пауза">
				</div>
				<div class="lesson-video__progress-wrap">
					<div class="lesson-video__progress"></div>
				</div>
				<div class="lesson-video__resize">
					<div class="lesson-video__resize-line">
						<div class="lesson-video__resize-top-left lesson-video__resize-btn"></div>
						<div class="lesson-video__resize-top-right lesson-video__resize-btn"></div>
					</div>
					<div class="lesson-video__resize-line">
						<div class="lesson-video__resize-bottom-left lesson-video__resize-btn"></div>
						<div class="lesson-video__resize-bottom-right lesson-video__resize-btn"></div>
					</div>
				</div>
			</div>
		</div>
		<h3 class="lesson__desc-head">Описание урока:</h3>
		<p class="lesson__desc">
			<?= $pageData['lesson']['recital'] ?>
		</p>
		
		<div class="lesson__btn-wrap">
			<button class="lesson__btn lesson__btn-lecture" type="button">Лекция</button>
			<a class="lesson__btn-link" href="<?= './homework?cid=' . $pageData['course']['id_course'] . '&lid=' . $pageData['lesson']['id_lesson']?>">Домашняя работа</a>
		</div>
		<div class="lesson__lecture-wrap">
			<? if(!empty($pageData['lesson']['url_lecture'])): ?>
				<? require_once($pageData['lesson']['url_lecture']) ?>
			<? else: ?>
				<p>Лекция отсутствует</p>
			<? endif; ?>
		</div>

		<div class="notepad">
			<button class="notepad__btn" type="button">
				<img src="/upload/images/icon/note.svg" alt="Блокнот">
			</button>

			<!-- <div class="notepad-note">
				<div class="notepad-note__wrap-notes">
					<p class="notepad-note__head">Заметки</p>
					<div class="notepad-note__all-notes">
						<div class="notepad-note__note-name">Все задачи</div>
						<div class="notepad-note__note-name">Одинаково конкретное слово</div>
					</div>
					<div class="notepad-note__add-note">
						<button class="notepad-note__add-btn">Создать новою заметку +</button>
					</div>
				</div>
				<div class="notepad-note__window"></div>
			</div> -->
		</div>
	</div>
</div>