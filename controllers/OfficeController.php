<?

class OfficeController extends Controller {

	private $pageTpl = '/views/office.tpl.php';

	public function __construct () {
		$this->model = new OfficeModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['teacher'])) {
			header('Location: /');
		}

		$this->pageData['title'] = 'Личный кабинет преподавателя';
		$this->view->render($this->pageTpl, $this->pageData);
	}
}
