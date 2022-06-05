<?

class DirectionsController extends Controller {

	private $pageTpl = '/views/directions.tpl.php';

	public function __construct () {
		$this->model = new DirectionsModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['student'])) {
			header('Location: /');
		}

		$dateUser = $this->getUserName();
		$this->pageData['user-name'] = $dateUser['user-name'];
		$this->pageData['user-role'] = $dateUser['user-role'];
		
		$this->pageData['courses'] = $this->model->getAllCourses();
		$this->pageData['title'] = 'Все направления';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getUserName() {
		if (!empty($_SESSION['student'])) {
			$login = $_SESSION['student'];

			$user = $this->model->getNameUser($login);

			return $user;
		}
	}

	public function save() {
		
		if (!empty($_POST) && !empty($_POST['id'])) {

			if($this->model->saveCourse($_SESSION['student'], $_POST['id'])){

				return $this->index();
			}
			else {
				header("HTTP/1.0 404 Not Found");
			}
		
		}

		return false;
	}

	public function delete() {
		if (!empty($_POST) && !empty($_POST['id'])) {
			if($this->model->deleteCourse($_SESSION['student'], $_POST['id'])){

				return $this->index();
			}
			else {
				header("HTTP/1.0 404 Not Found");
			}
		}
	}
}
