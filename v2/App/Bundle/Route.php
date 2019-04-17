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
			$setup = self::$setup[$method];
			$error_page = function() {
				return ["404"];
			};

			list($cb, $params) = $this->getCallback($setup, $url);

			if ($cb === false) {
				$cb = $error_page;
				$params = [];
			}

			$this->res = $cb(...$params);
		}

		public function getCallback($setup, $url)
		{
			$cb = false;

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

				if ($params && !($params = $this->reDefineParams($v, $params))) {
					continue;
				}

				$cb = $v;

				break;
			}

			return [$cb, $params];
		}

		public function reDefineParams($cb, $params)
		{
			$reflection = new \ReflectionFunction($cb);
			$parameters = $reflection->getParameters();

			foreach ($parameters as $key => $parameter) {
				if ($parameter->getType()) {
					$concreat_base = $parameter->getType()->getName();

					if (class_exists($concreat_base)) {
						$concreat = new $concreat_base($params[$key]);

						if (!$concreat->data) {
							$params = false;
							break;
						} else {
							$params[$key] = $concreat;
						}
					}
				}
			}

			return $params;
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