<?

class LearningController extends Controller {

	private $pageTpl = '/views/learning.tpl.php';

	public function __construct () {
		$this->model = new LearningModel();
		$this->view = new View();
	}

	public function index () {
		if (empty($_SESSION['teacher'])) {
			header('Location: /');
		}
		
		$this->getInfo();

		$this->pageData['title'] = 'Мои курсы';
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getInfo()
	{
		$this->pageData['data'] = $this->model->getAllInfo();
	}


	public function deleteFile() {
		$currentDir = getcwd();
		$link = '/upload/test/';

		$fileName = 'lecture.php';
		$allPath = $currentDir . $link . $fileName;
		unlink($allPath);
	}

	private function generateError($num, $nameFile = '') : string
	{
		$arrayError = [
			0 => 'Файл превысил исходное ограничение в 50 Мб',
			1 => 'Файл имеет запрещенное расширение',
			2 => 'Папка ' . $nameFile . ' для расположения файлов не создана',
			3 => 'Файл ' . $nameFile . ' не был удален на сервере',
			4 => 'Файл '. $nameFile . ' не был загружен на сервер',
		];

		return $arrayError[$num];
	}

	private function response($error = '') : void
	{

		if (empty($error)) {
			$req = [
				'success' => 'true',
			];
		} else {
			$req = [
				'success' => 'false',
				'error' => $error
			];
		}

		$data = json_encode($req);
		print_r($data);
	}

	public function uploadVideo() : void
	{
		if (!empty($_FILES) && !empty($_POST)) {
			
			$previousFile = $_POST['previousTitle'];
			$fileNameForUpload = $_FILES['video']['name'];
			$tagFile = 'video';
			$fileTmpName = $_FILES['video']['tmp_name'];

			$data = [
				'nameCourse' => $_POST['nameCourse'],
				'numberLesson' => $_POST['numberLesson'],
			];

			$this->uploadFile($previousFile, $fileNameForUpload, $tagFile, $data, $fileTmpName);
		} else {

			$err = $this->generateError(0);
			$this->response($err);
		}
		
	}

	public function uploadPoster() : void
	{
		if (!empty($_FILES)) {

			$previousFile = $_POST['previousTitle'];
			$fileNameForUpload = $_FILES['poster']['name'];
			$tagFile = 'poster';
			$fileTmpName = $_FILES['poster']['tmp_name'];

			$data = [
				'nameCourse' => $_POST['nameCourse'],
				'numberLesson' => $_POST['numberLesson'],
			];

			$this->uploadFile($previousFile, $fileNameForUpload, $tagFile, $data, $fileTmpName);
		} else {

			$err = $this->generateError(0);
			$this->response($err);
		}
		
	}

	public function uploadHomework() : void
	{
		if (!empty($_FILES) && !empty($_POST)) {

			$previousFile = $_POST['previousTitle'];
			$fileNameForUpload = $_FILES['homework']['name'];
			$tagFile = 'homework';
			$fileTmpName = $_FILES['homework']['tmp_name'];

			$data = [
				'nameCourse' => $_POST['nameCourse'],
				'numberLesson' => $_POST['numberLesson'],
			];

			$this->uploadFile($previousFile, $fileNameForUpload, $tagFile, $data, $fileTmpName);
		} else {

			$err = $this->generateError(0);
			$this->response($err);
		}
		
	}

	public function uploadLecture() : void
	{
		if (!empty($_FILES) && !empty($_POST)) {

			$previousFile = $_POST['previousTitle'];
			$fileNameForUpload = $_FILES['lecture']['name'];
			$tagFile = 'lecture';
			$fileTmpName = $_FILES['lecture']['tmp_name'];

			$data = [
				'nameCourse' => $_POST['nameCourse'],
				'numberLesson' => $_POST['numberLesson'],
			];

			$this->uploadFile($previousFile, $fileNameForUpload, $tagFile, $data, $fileTmpName);
		} else {

			$err = $this->generateError(0);
			$this->response($err);
		}
		
	}

	private function uploadFile($previousFile, $fileNameForUpload, $tagFile, $data, $fileTmpName) : void
	{

		$fileNameCmps = explode(".", $fileNameForUpload);
	
		$fileExtension = strtolower(end($fileNameCmps));

		switch ($tagFile) {
			case 'video':
				$allowedfileExtensions = array('mp4', 'webm', 'mpeg');
				break;
			
			case 'poster':
				$allowedfileExtensions = array('jpeg', 'jpg', 'png');
				break;

			case 'homework':
				$allowedfileExtensions = array('docx', 'doc');
				break;

			case 'lecture':
				$allowedfileExtensions = array('php'); // по хорошему тут должен быть html
				break;
		}

		if (in_array($fileExtension, $allowedfileExtensions)) {

			$current = getcwd();
			$link = '/upload/courses/';

			// Проверка на точки в названиях папок (все \ / : * ? " < > | .)

			// $nameCourse = preg_replace("(\.)", '', $data['nameCourse']);

			$dirCourse = $current . $link . $data['nameCourse'] . '/';
			$dirLesson = $current . $link . $data['nameCourse']. '/' . $data['numberLesson'] . '/';

			/* внутреняя проверка на необходимые папки 
			eсли их нет создание */
			if(!is_dir($dirCourse)) {
				if (!mkdir($dirCourse, 0777, true)) {
					$err = $this->generateError(2);
					$this->response($err);
					return;
				}
			}

			if (!is_dir($dirLesson)) {
				mkdir($dirLesson, 0777, true);
			}

			if ($previousFile == 'Нет видео' || 
				$previousFile == 'Нет фото для видео' || 
				$previousFile == 'Нет д/з' || 
				$previousFile == 'Нет лекции') {
			} else {
				$pathDelete = $dirLesson . $previousFile;

				if (!unlink($pathDelete)) {
					$err = $this->generateError(3);

					$this->response($err);

					return;
				}
			}

			
			$pathUpload = $dirLesson . $fileNameForUpload;

			$allPath =  $link . $data['nameCourse'] . '/' . $data['numberLesson'] . '/';
			$pathUploadForBd = $allPath . $fileNameForUpload;
			
			if (!move_uploaded_file($fileTmpName, $pathUpload)) {

				$err = $this->generateError(4);
				$this->response($err);
				return;

			} else {

				$this->model->uploadInfoVideo($pathUploadForBd, $data['nameCourse'], $data['numberLesson'], $tagFile);
				$this->response();
				return;

			}
		} else {
			$err = $this->generateError(1);
			$this->response($err);
		}
	}

	private function generateErrorText($numError, $field = '') {

		$arrayError = [
			'Поле ' . $field . ' не заполнено',
			'Не отлавливаемая ошибка'
		];


		return $arrayError[$numError];
	}

	public function textEntry() {
		$data = json_decode(file_get_contents('php://input'), true);

		foreach($data as $key => $value) {
			if (empty($value)) {

				switch ($key) {
					case 'textInTextarea':
						
						$nameField = 'текстовое поле';

						$err = $this->generateErrorText(0, $nameField);
						$this->response($err);
						
						return;

						break;
				}

				$err = $this->generateErrorText(1);
				$this->response($err);

				return;
			}
		}

		$nameCourse = $data['nameCourse'];
		$numberLesson = $data['numberLesson'];
		$text = $data['textInTextarea'];
		$tagChange = $data['tagChange'];

		

		$this->model->changeText($nameCourse, $numberLesson, $text, $tagChange);

		echo 'da';

	}
}
