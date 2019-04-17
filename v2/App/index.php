<?php 
	session_start();

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	
	date_default_timezone_set("Asia/seoul");

	spl_autoload_register(function($cn) {
		if (file_exists($f = __DIR__."/".$cn.".php")) {
			require_once $f;
		}
	});

	function move($msg = '', $loc = '') {
		if ($msg) {
			echo "<script>alert('$msg')</script>";
		}
		if ($loc) {
			echo "<script>location.href='$loc'</script>";
		}
		echo "<script>history.back()</script>";
	}

	function dd(...$val) {
		echo "<pre>";
			array_map("var_dump", $val);
		echo "</pre>";
	}

	function exjoin($arr,$a=null,$b=null,$c=",") {
		return $b.implode("$b $a$c $b", $arr)."$b $a";
	}

	function unslash($str) {
		return preg_replace("~(^\/|\/$)~", "", $str);
	}

	require_once 'Http/web.php';