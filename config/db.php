<?
class DB {
	protected static $_instance;
	private $conn;

	public static function getInstance()
	{
		if (self::$_instance === null) {
			self::$_instance = new self;
		}
		
		return self::$_instance;
	}

	private function __construct()
	{
		$this->conn = new mysqli('localhost', 'root', 'root', 'education');
		$this->conn->query("SET NAMES utf8");
	}

	public static function getConnection()
	{
		$get = self::getInstance();
		return $get->conn;
	}
}