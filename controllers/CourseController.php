<?

class CourseController extends Controller {

	private $pageTpl = '/views/course.tpl.php';

	public function __construct () {
		$this->model = new CourseModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['student'])) {
			header('Location: /');
		}

		$this->pageData = $this->getUserName();
		$this->pageData['all-data'] = $this->getCourse();

		$this->pageData['title'] = 'Список уроков';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getCourse() {
		if (!empty($_GET) && !empty($_GET['cid'])) {

			return $this->model->getCourse($_GET['cid']);

		}
	}

	public function getUserName() {
		if (!empty($_SESSION['student'])) {
			$login = $_SESSION['student'];

			$user = $this->model->getNameUser($login);

			return $user;
		}
	}
}


