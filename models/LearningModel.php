	<? 

	class LearningModel extends Model {
		public function getIdUser($user)
		{
			$conn = $this->db;
			$result = $conn->prepare("SELECT id_user FROM `users` WHERE login= ?");
			$result->bind_param("s", $user);
			$result->execute();
			$result = $result->get_result();
			$res = $result->fetch_row();

			return $res[0];
		}

		public function getIdCourses() : array
		{
			$idTeacher = $this->getIdUser($_SESSION['teacher']);
			
			$conn = $this->db;
			$result = $conn->prepare("SELECT * FROM courses where id_user=?");
			$result->bind_param("i", $idTeacher);
			$result->execute();
			$result = $result->get_result();

			while ($row = $result->fetch_assoc()) {
			
				$idCourses[] = [
					'id_course' => $row['id_course'],
					'course_name' => $row['course_name'],
				];

				
			}

			return $idCourses;
		}

		public function getLessonById($idCorse) {
			$conn = $this->db;
			$result = $conn->prepare("SELECT id_lesson,number, name_lesson, recital ,url_video, url_poster, url_homework, url_lecture FROM lessons WHERE id_course=?");

			$result->bind_param("i", $idCorse);
			$result->execute();
			$result = $result->get_result();

			while ($row = $result->fetch_assoc()) {
				if (!empty($row['url_video'])) {
					$getString = explode('/', $row['url_video']);
				

					if (!empty($getString[5])) {
						$row['url_video'] = $getString[5];
					}
				} else {
					$row['url_video'] = 'Нет видео';
				}

				if (!empty($row['url_homework'])) {
					$getString = explode('/', $row['url_homework']);
				

					if (!empty($getString[5])) {
						$row['url_homework'] = $getString[5];
					}
				} else {
					$row['url_homework'] = 'Нет д/з';
				}

				if (!empty($row['url_poster'])) {
					$getString = explode('/', $row['url_poster']);
				

					if (!empty($getString[5])) {
						$row['url_poster'] = $getString[5];
					}
				} else {
					$row['url_poster'] = 'Нет фото для видео';
				}

				if (!empty($row['url_lecture'])) {
					$getString = explode('/', $row['url_lecture']);
				

					if (!empty($getString[5])) {
						$row['url_lecture'] = $getString[5];
					}
				} else {
					$row['url_lecture'] = 'Нет лекции';
				}

				$lesson[] = $row;
			}

			return $lesson;
			
		}

		public function getAllInfo()
		{
			$idCourses = $this->getIdCourses();
		
			foreach($idCourses as $idCorse => $index) {
				$lesson = $this->getLessonById($index['id_course']);

				$all[] = [
					'course' => $index['course_name'],
					'lessons' => $lesson,
				];
			}

			return $all;
		}

		private function getIdCourseByName($nameCourse) : string
		{
			$conn = $this->db;
			$result = $conn->prepare("SELECT * FROM courses where course_name=?");
			$result->bind_param("s", $nameCourse);
			$result->execute();
			$result = $result->get_result();

			while ($row = $result->fetch_assoc()) {
				$idCourseByName = $row['id_course'];
			}

			return $idCourseByName;
		}

		public function uploadInfoVideo($path, $nameCourse, $numberLesson, $tagFile) {
			$idCourse = $this->getIdCourseByName($nameCourse);
			$conn = $this->db;
			switch ($tagFile) {
				case 'video':
					$result = $conn->prepare("UPDATE lessons SET url_video = ? where number=? and id_course=?");
					break;
				
				case 'poster':
					$result = $conn->prepare("UPDATE lessons SET url_poster = ? where number=? and id_course=?");
					break;

				case 'homework':
					$result = $conn->prepare("UPDATE lessons SET url_homework = ? where number=? and id_course=?");
					break;
					
				case 'lecture':
					$result = $conn->prepare("UPDATE lessons SET url_lecture = ? where number=? and id_course=?");
					break;
			}
			$result->bind_param("sii", $path, $numberLesson, $idCourse);
			$result->execute();
		}

		public function changeText($nameCourse, $numberLesson, $text, $tagChange) : void
		{
			$idCourse = $this->getIdCourseByName($nameCourse);

			$conn = $this->db;
			switch ($tagChange) {
				case 'name':
					$result = $conn->prepare("UPDATE lessons SET name_lesson = ? where number=? and id_course=?");
					break;
				
				case 'recital':
					$result = $conn->prepare("UPDATE lessons SET recital = ? where number=? and id_course=?");
					break;
				}
			$result->bind_param("sii", $text, $numberLesson, $idCourse);
			$result->execute();


		}
	}