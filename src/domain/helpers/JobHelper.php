<?php

namespace yii2lab\notify\domain\helpers;

use Yii;
use yii2lab\extension\yii\helpers\FileHelper;

class JobHelper {
	
	public static function getAll() {
		$dir = self::getDir();
		$jobList = FileHelper::scanDir($dir, ['only'=>['*.data']]);
		$jobList2 = [];
		foreach($jobList as $id => $fileName) {
			if($fileName == 'index.data') {
				continue;
			}
			$job = self::loadJob($fileName);
			$jobList2[] = $job;
		}
		return $jobList2;
	}
	
	private static function loadJob($fileName) {
		$dir = self::getDir();
		$file = $dir . DS . $fileName;
		$content = FileHelper::load($file);
		$job = unserialize($content);
		return $job;
	}
	
	private static function getDir() {
		$dir = Yii::getAlias('@common/runtime/queue');
		$dir = FileHelper::normalizePath($dir);
		return $dir;
	}
	
}
