<?php

namespace todo\components;

use RedBeanPHP\R;

class Db
{
		public static function getConnection()
		{
            R::setup( 'mysql:host=localhost;dbname=todo', 'root', 'root' );
		}
}
