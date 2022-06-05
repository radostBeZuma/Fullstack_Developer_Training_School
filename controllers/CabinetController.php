<?

class CabinetController extends Controller {

	private $pageTpl = '/views/cabinet.tpl.php';

	public function __construct () {
		$this->model = new CabinetModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['student'])) {
			header('Location: /');
		}

		$dateUser = $this->getUserName();
		$this->pageData['user-name'] = $dateUser['user-name'];
		$this->pageData['user-role'] = $dateUser['user-role'];

		$this->pageData['select-courses'] = $this->model->getSelectCourses($_SESSION['student']);

		$this->pageData['date'] = $this->getDate();
		
		$this->pageData['title'] = 'Личный кабинет студента';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getUserName() {
		if (!empty($_SESSION['student'])) {
			$login = $_SESSION['student'];

			$user = $this->model->getNameUser($login);

			return $user;
		}
	}

	public function getDate() {
		$arrMouth = [
			'января',
			'февраля',
			'марта',
			'апреля',
			'мая',
			'июня',
			'июля',
			'августа',
			'сентября',
			'октября',
			'ноября',
			'декабря'
		];

		$arrDay = [
			'Monday' => 'Понедельник',
			'Tuesday' => 'Вторник',
			'Wednesday' => 'Среда',
			'Thursday' => 'Четверг',
			'Friday' => 'Пятница',
			'Saturday' => 'Суббота',
			'Sunday' => 'Воскресенье'
		];

		$month = date('n') - 1;
		$day = date('l');
		
		return $arrDay[$day].', ' .date('d').' '.$arrMouth[$month].' '.date('Y'). ' г.';
	}
}
