<?

class IndexController extends Controller {

	private $pageTpl = '/views/main.tpl.php';

	public function __construct () {
		$this->model = new IndexModel();
		$this->view = new View();
	}

	public function index () {

		if (!empty($_POST)) {
			$action = $_POST['action'];

			if ($action == 'registration') {
				if ($this->registration()) {
					$this->pageData['msg'] = 'Вы зарегистрировались!';
				}
			}

			if ($action == 'login') {
				if (!$this->login()) {
					$this->pageData['error_login'] = 'Вы ввели не корректные данные';
				}
			}
		}
		$this->pageData['user_name'] = $this->getUserName();

		$this->pageData['title'] = 'Главная страница';
		$this->view->render($this->pageTpl, $this->pageData);
	}
 
	public function registration () {



		// if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['login']) && !empty($_POST['pass'])) {

		// 	$name = $_POST['name'];
		// 	$surname = $_POST['surname'];
		// 	$login = $_POST['login'];
		// 	$pass = $_POST['pass'];

		// 	$this->model->createUser($name, $surname, $login, $pass);
		// 	return true;
		// }

		// else {
		// 	$this->pageData['erorr'] = 'Заполните все поля пожалуйста';
		// 	return false;
		// }
	}

	public function login() {
		if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {
			
			$login = $_POST['login'];
			$pass = $_POST['pass'];

			if($this->model->checkUser($login, $pass)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	public function getUserName() {
		if (!empty($_SESSION['student'])) {
			$login = $_SESSION['student'];

			$user = $this->model->getNameUser($login);
			return $user;
		} else if (!empty($_SESSION['teacher'])) {
			$login = $_SESSION['teacher'];

			$user = $this->model->getNameUser($login);
			return $user;
		}
	}

	public function logout() {
		session_destroy();
		header('Location: /');
	}


	public function json() : string
	{
	
		$data = json_decode(file_get_contents('php://input'), true);

		$name = $data['name'];
		$surname = $data['surname'];
		$login = $data['login'];
		$password = $data['password'];
		
		if (!empty($name) and !empty($surname) and !empty($login) and !empty($password)) {
			$this->model->createUser($name, $surname, $login, $password);
			$data = [
				'ok' => 'yes',
				'error' => 'no',
			];

			$a = json_encode($data);
			echo $a;
			return $a;
		} else {
			$this->pageData['erorr'] = 'Заполните все поля пожалуйста';
			return false;
		}


	}

	
}
