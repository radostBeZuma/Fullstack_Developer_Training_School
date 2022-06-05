<? 

class IndexModel extends Model {

	public function createUser($name, $surname, $login, $pass) {
		$conn = $this->db;
		$result = $conn->prepare("INSERT INTO `users` (`user_name`, `surname`, `login`, `password`, `role`) VALUES (?, ?, ?, ?, 'студент');");
		$result->bind_param("ssss", $name, $surname, $login, $pass);
		$result->execute();
	}

	public function checkUser($login, $pass) {
		$conn = $this->db;
		$result = $conn->prepare("SELECT * FROM `users` WHERE `login` = ? and `password` = ?");
		$result->bind_param("ss", $login, $pass);
		$result->execute();
		$result = $result->get_result();
		$res = $result->fetch_row();

		if ($res[5] == 'студент') {
			$_SESSION['student'] = $_POST['login'];
		} else if ($res[5] == 'преподаватель') {
			$_SESSION['teacher'] = $_POST['login'];
		}

	}

	public function getNameUser($login) {
		$conn = $this->db;
		$result = $conn->prepare("SELECT * FROM `users` WHERE `login` = ?");
		$result->bind_param("s", $login);
		$result->execute();
		$result = $result->get_result();
		$row = mysqli_fetch_array($result);
		$userName = $row[1] . ' ' . $row[2];
		return $userName;
	}
}