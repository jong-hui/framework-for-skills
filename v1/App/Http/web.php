<?php 
	use \Bundle\Route;
	use \Model\_base as DB;

	// get : mainpage
	Route::get("", function() {
		return ["index", [
			"sitename" => "Webskills blog"
		]];
	});

	// get : /register
	Route::get("register", function() {
		return ["register"];
	});

	// post : /register
	Route::post("register", function() {
		// DB::Users()->insert([ "id" => "user", ..... ]);

		return ["회원가입이 완료되었습니다.", "/"];
	});

	// get : /userpage/user1
	Route::get("/userpage/{userid}", function($userid) {
		return ["userpage", [
			"userid" => $userid
		]];
	});

	new Route($_SERVER["REQUEST_URI"]);