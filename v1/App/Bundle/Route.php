<?php 
	namespace bundle;

	/**
	 * 
	 */
	class Route
	{
		public static $setup = ["get"=>[], "post"=>[]];
		public static $template = ["header", "footer"];
		public $res = '';

		public static function __callStatic($name ,$args)
		{
			self::$setup[$name][unslash($args[0])] = $args[1];
		}

		public function __construct($url)
		{
			$url = explode('/', unslash($url));
			$method = strtolower($_SERVER['REQUEST_METHOD']);

			$setup = @self::$setup[$method];

			$cb = function() {
				return ["404"];
			};


			foreach ($setup as $target_url => $v) {
				$target_url = unslash($target_url);
				$target_urls = explode("/", $target_url);
				$params = [];

				if (count($target_urls) != count($url)) {
					continue;
				}

				foreach ($target_urls as $k => $target) {

					if (preg_match("/^{.*?}$/", $target)) {
						$params[] = $url[$k] ?? '';

						continue;
					}

					if ($url[$k] != $target) {
						continue 2;
					}
				}


				$cb = $v;
				break;
			}

			$this->res = $cb(...$params);
		}

		public function __destruct()
		{
			if ($this->res == "") {
				return false;
			}

			if (is_string($this->res[1] ?? [])) {
				return move(...$this->res);
			}

			extract($this->res[1] ?? []);

			if (in_array("header", self::$template)) {
				require_once ROOT."/App/View/header.php";
			}

			require_once ROOT."/App/View/{$this->res[0]}.php";

			if (in_array("footer", self::$template)) {
				require_once ROOT."/App/View/footer.php";
			}
		}
	}