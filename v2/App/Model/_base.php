<?php 
	namespace model;
	use \PDO;

	/**
	 * 
	 */
	class _base 
	{
		public static $pdo = null;
		public $primaryKey = "idx";
		public $table = "";
		public $data = null;

		public function __get($name)
		{
			return $this->data[$name];
		}

		public static function __callStatic($name, $args)
		{
			$model = "Model\\$name";
			if (!class_exists($model)) {
				$model = "model\\_base";
			}
			
			$inst = new $model();
			$inst->setTable($name);
			return $inst;
		}

		public function __call($name, $args)
		{
			return $this->mq(...$args)->{$name}();
		}

		public function __construct($idx = "")
		{
			if ($idx === "") {
				return false;
			}

			if ($this->table == "") {
				$this->setTable(strtolower(explode("\\", get_called_class())[1]));
			}

			$this->data = $this->for($idx, $this->primaryKey);
		}

		public function mq($sql ,$data = [])
		{
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=web001", "root", "", [
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				]);
			}

			$q = self::$pdo->prepare($sql);
			$q->execute($data);

			return $q;
		}

		public function save($save)
		{
			$v = array_values($save);
			$k = array_keys($save);

			$ik = exjoin($k);
			$iv = exjoin(array_fill(0, count($k), "?"));

			$up = exjoin($k, "= ?", "`");

			return $this->mq(
				(isset($save['idx'])) ? 
					"UPDATE `{$this->table}` SET $up WHERE `idx` = '{$save['idx']}'" :
					"INSERT INTO `{$this->table}` ($ik) vaLUES ($iv)", $v
			);
		}

		public function find($sql, $data = [])
		{
			return $this->data = $this->fetch("SELECT * FROM {$this->table} WHERE ".$sql, $data);
		}

		public function get($sql = '', $data = [])
		{
			return $this->data = $this->fetchAll("SELECT * FROM {$this->table} ".$sql, $data);
		}

		public function del($idx)
		{
			return $this->mq("DELETE FROM {$this->table} WHERE `idx` = ?", [$idx]);
		}

		public function for($val, $key = 'idx')
		{
			return $this->data = $this->find("{$key} = ?", [$val]);
		}

		public function getItem($idx)
		{
			$item = $this->for($idx);

			if (method_exists($this, "convert")) {
				$item = $this->convert($item);
			}

			return $this->data = $item;
		}

		public function getList($sql = '', $data = [])
		{
			$items = $this->get($sql, $data);

			if (method_exists($this, "convert")) {
				foreach ($items as $key => $item) {
					$items[$key] = $this->convert($item);
				}
			}

			return $this->data = $items;
		}

		public function setTable($t)
		{
			$this->table = $t;
			return $this;
		}
	}