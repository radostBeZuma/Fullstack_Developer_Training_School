<?

class CourseModel extends Model
{
	public function getLessons($idCourse)
	{
		$conn = $this->db;
		$result = $conn->prepare("SELECT l.id_lesson, l.name_lesson, l.number, l.id_course, c.id_course FROM lessons l 
		JOIN courses c ON l.id_course=c.id_course and  l.id_course= ?");
		$result->bind_param("i", $idCourse);
		$result->execute();
		$re = $result->get_result();

		while ($row = $re->fetch_assoc()) {
			$lessons[] = $row;
		}

		$data = [
			'lessons' => $lessons,
			'count_lessons' => $re->num_rows,
		];

		return $data;
	}

	public function getCourse($idCourse)
	{
		$conn = $this->db;
		$result = $conn->prepare("SELECT c.id_course, c.course_name, c.recital, c.lang, c.img, u.user_name, u.surname 
		FROM courses c 
		JOIN  users u 
		ON c.id_user=u.id_user and c.id_course=?");

		$result->bind_param("i", $idCourse);
		$result->execute();
		$result = $result->get_result();

		while ($row = $result->fetch_assoc()) {
			$course[] = $row;
		}

		$dataLessons = $this->getLessons($idCourse);

		$course['0']['lessons'] = $dataLessons['lessons'];
		$course['0']['count_lessons'] = $dataLessons['count_lessons'] . ' уроков';
		return $course;
	}

	public function getNameUser($login)
	{
		$conn = $this->db;
		$result = $conn->prepare("SELECT * FROM `users` WHERE `login` = ?");
		$result->bind_param("s", $login);
		$result->execute();
		$result = $result->get_result();
		$row = mysqli_fetch_array($result);
		$dateUser = [
			'user-name' => $row[1] . ' ' . $row[2],
			'user-role' => $row[5],
		];

		return $dateUser;
	}
}
