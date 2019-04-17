<?php 
	namespace model;
	use \Model\member;

	/**
	 * 
	 */
	class Boards extends _base
	{
		public function convert($val)
		{
			$val['writer'] = member::getItem($val['writer_id']);
			
			return $val;
		}
	}