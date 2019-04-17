<?php 
	use \bundle\route;
	use \model\_base as DB;


	// /users
	route::get("/users/", function() {
		dd("!!");
	});


	// /users/login
	route::get("/users/login", function() {
		return ["login"];
	});

	// /users/register
	route::get("/users/register", function() {
		return ["register"];
	});

	// /users/user1
	route::get("/users/{user_id}", function($user) {
		return ["memberPage", [
			'user' => $user
		]];	
	});

	// /user or /admin
	route::get("{user_id}", function(\Model\Member $user) {
		return ["blog", [
			'user' => $user
		]];
	});

	route::get("", function($test = '') {

		// $User = DB::Member();
		// $User->for("admin", "id");

		// dd($User->pw);

		return ["index", [
			'list' => [
				"메인페이지" => "/",
				"로그인페이지" => "/users/login",
				"회원가입페이지" => "/users/register",
				"회원정보페이지(user1)" => "/users/user1",
				"회원정보페이지(user2)" => "/users/user2",
				"회원 블로그(admin)" => "/admin",
				"없는 회원의 블로그(user1)" => "/user1",
				"404에러페이지" => "/fouadshgfiuadhsfouijas"
			]
		]];
	});

	new route($_SERVER['REQUEST_URI']);