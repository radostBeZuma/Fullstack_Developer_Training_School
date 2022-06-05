<?

class LessonController extends Controller
{

	private $pageTpl = '/views/lesson.tpl.php';

	public function __construct()
	{
		$this->model = new LessonModel();
		$this->view = new View();
	}

	public function index()
	{
		if (empty($_SESSION['student'])) {
			header('Location: /');
		}

		$this->getLessonInfo();
		$this->getUserName();

		$this->pageData['title'] = 'Изучение урока';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getLessonInfo() : void
	{
		if (!empty($_GET) and !empty($_GET['lid']) and !empty($_GET['cid'])) {

			$lesson = $this->model->getLessonById($_GET['lid']);
			$course = $this->model->getCourseNameById($_GET['cid']);

			$this->pageData['lesson'] = $lesson;
			$this->pageData['course'] = $course;
		}
	}

	public function getUserName() : void 
	{ 
		if (!empty($_SESSION['student'])) {
			$login = $_SESSION['student'];

			$user = $this->model->getNameUser($login);
			
			$this->pageData['user'] = $user;
		}
	}
}
