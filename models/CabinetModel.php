<? 

class CabinetModel extends Model {

	public $indexCourse;

	public function getIdUser($user) {
		$conn = $this->db;
		$result = $conn->prepare("SELECT id_user FROM `users` WHERE login= ?");
		$result->bind_param("s", $user);
		$result->execute();
		$result = $result->get_result();
		$res = $result->fetch_row();
		
		return $res[0];
	}

	public function getNameUser($login) {
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

	public function getCountLessons($idCourse) {
		$conn = $this->db;
		$result = $conn->prepare("SELECT l.name_lesson, l.recital, l.id_course, c.id_course, c.course_name FROM lessons l 
		JOIN courses c ON l.id_course=c.id_course and  l.id_course= ?");
		
		$result->bind_param("i", $idCourse);
		$result->execute();
		$result->store_result();
		$countLessons = $result->num_rows;

		return $countLessons;
	}


	public function getSelectCourses($user) {

		$id = $this->getIdUser($user);

		$conn = $this->db;
		$result = $conn->prepare("SELECT id_user, id_course FROM `users_courses` WHERE id_user= ?");
		$result->bind_param("i", $id);
		$result->execute();
		$result = $result->get_result();

		while ($row = $result->fetch_assoc()) {
			$allCourses[] = $row;
		}

		if (!empty($allCourses)) {
			foreach ($allCourses as $index) {
				$conn = $this->db;
				$result = $conn->prepare("SELECT * FROM `courses` WHERE id_course = ?");
				$result->bind_param("i", $index['id_course']);
				$result->execute();
	
				$result = $result->get_result();
	
				while ($res = $result->fetch_assoc()) {
					$selectedCourses[] =  $res;
				}
	
			}

			for ($i = 0; $i < count($selectedCourses); $i++) { 
				$selectedCourses[$i]['count_lessons'] = $this->getCountLessons($selectedCourses[$i]['id_course']) . ' уроков';
			}

		} else {
			$selectedCourses = '';
		}

		return $selectedCourses;
	}
}