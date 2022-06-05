<? 

class LessonModel extends Model {
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

	public function getLessonById($idLesson) {
		$conn = $this->db;
		$result = $conn->prepare("SELECT * FROM lessons WHERE id_lesson=?");

		$result->bind_param("i", $idLesson);
		$result->execute();
		$result = $result->get_result();

		while ($row = $result->fetch_assoc()) {
			$lesson = $row;
		}

		return $lesson;
	}

	public function getCourseNameById($idCourse)
	{
		$conn = $this->db;
		$result = $conn->prepare("SELECT id_course, course_name FROM courses WHERE id_course=?");

		$result->bind_param("i", $idCourse);
		$result->execute();
		$result = $result->get_result();

		while ($row = $result->fetch_assoc()) {
			$course = $row;
		}

		return $course;
	}

}