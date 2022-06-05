<?

class DirectionsModel extends Model
{

	public $check = array();

	public function checkDate($idUser, $idCourse)
	{
		$conn = $this->db;
		$result = $conn->prepare("SELECT id_user, id_course FROM `users_courses` WHERE id_user= ? and id_course= ?");
		$result->bind_param("ii", $idUser, $idCourse);
		$result->execute();
		$result->store_result();
		$res = $result->num_rows();

		return $res;
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


	public function getAllCourses()
	{
		$conn = $this->db;
		$result = $conn->query("SELECT c.id_course, c.course_name, c.recital, c.lang, c.img, u.user_name, u.surname 
		FROM courses c 
		JOIN  users u 
		ON c.id_user=u.id_user");

		while ($row = $result->fetch_assoc()) {
			$allCourses[] = $row;
		}

		foreach ($allCourses as $index) {
			$indexCourse[] = $index['id_course'];
		}

		for ($i = 0; $i < count($indexCourse); $i++) {
			$result = $conn->prepare("SELECT l.name_lesson, l.recital, l.id_course, c.id_course, c.course_name FROM lessons l 
			JOIN courses c ON l.id_course=c.id_course and  l.id_course= ?");
			$result->bind_param("i", $indexCourse[$i]);
			$result->execute();
			$result->store_result();

			$allCourses[$i]['count_lesson'] = $result->num_rows;

			$id = $this->getIdUser($_SESSION['student']);

			if ($this->checkDate($id, $indexCourse[$i])) {
				$allCourses[$i]['check'] = 'true';
			} else {
				$allCourses[$i]['check'] = 'false';
			}
		}

		return $allCourses;
	}

	public function saveCourse($user, $course)
	{

		$id = $this->getIdUser($user);

		if (!$this->checkDate($id, $course)) {
			$conn = $this->db;
			$result = $conn->prepare("INSERT INTO users_courses (`id_user`, `id_course`) VALUES (? , ?)");
			$result->bind_param("ii", $id, $course);
			$result->execute();
			return true;
		} else {
			return false;
		}
	}

	public function deleteCourse($user, $idCourse)
	{

		$id = $this->getIdUser($user);


		if ($this->checkDate($id, $idCourse)) {
			$conn = $this->db;
			$result = $conn->prepare("DELETE FROM users_courses WHERE id_user=? AND id_course=?");
			$result->bind_param("ii", $id, $idCourse);
			$result->execute();

			return true;
		} else {
			return false;
		}
	}
}
