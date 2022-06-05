<?

class HomeworkController extends Controller {

	private $pageTpl = '/views/homework.tpl.php';

	public function __construct () {
		$this->model = new HomeworkModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['student'])) {
			header('Location: /');
		}

		$this->getAllDate();
		$this->getUserName();
		$this->pageData['title'] = 'Выполнение д/з';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getAllDate() : void
	{
		if(!empty($_GET['lid']) and !empty($_GET['cid'])) {

			$this->pageData['lesson'] = $this->model->getLessonById($_GET['lid']);
			$this->pageData['course'] = $this->model->getCourseNameById($_GET['cid']);

			
		}
	}

	public function getUserName() : void 
	{ 
		if (!empty($_SESSION['student'])) {

			$login = $_SESSION['student'];
			$this->pageData['user'] = $this->model->getNameUser($login);

		}
	}
}
