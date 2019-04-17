<?php 
	namespace Model;
	use \Model\Boards;

	/**
	 * 
	 */
	class Users extends _base
	{
		public function convert($val)
		{
			$val['level'] = $val['id'] == "admin" ? "관리자" : "사용자";
			$val['boards'] = Boards::get("where `user_id` = ?", [$val['id']]);
			
			return $val;
		}
	}