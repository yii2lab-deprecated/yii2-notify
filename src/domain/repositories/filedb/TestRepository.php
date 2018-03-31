<?php

namespace yii2lab\notify\domain\repositories\filedb;

use yii2lab\domain\repositories\ActiveDiscRepository;
use yii2lab\notify\domain\interfaces\repositories\TestInterface;

class TestRepository extends ActiveDiscRepository implements TestInterface {
	
	public $table = 'notify_test';
	public $path = '@common/runtime/data';
	
}