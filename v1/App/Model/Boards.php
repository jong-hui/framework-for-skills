<?php 
	namespace model;
	use \Model\Users;

	/**
	 * 
	 */
	class Boards extends _base
	{
		public function convert($val)
		{
			$val['writer'] = Users::getItem($val['writer_id']);
			
			return $val;
		}
	}