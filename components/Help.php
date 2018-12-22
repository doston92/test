<?php
	namespace app\components;

	class Help
	{
		public function strCount($str,$text){
			return substr_count($text, $str);
		}
	}
