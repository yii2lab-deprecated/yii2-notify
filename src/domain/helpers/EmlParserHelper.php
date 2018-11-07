<?php

namespace yii2lab\notify\domain\helpers;

use yii\helpers\Inflector;

class EmlParserHelper {
	
	public static function parse($message) {
		$boundary = self::getBoundary($message);
		$parts = explode('--' . $boundary . '', $message);
		$item = [];
		foreach($parts as &$partCode) {
			$partCode = trim($partCode);
			$partCode = trim($partCode, '-');
			if($partCode) {
				$params = self::parseMessage($partCode);
				$content_type_arr = explode(';', $params['content_type']);
				$content_type = trim($content_type_arr[0]);
				if(!empty($params['message_id'])) {
					$item = $params;
				} elseif($content_type == 'text/plain' || $content_type == 'text/html') {
					$item['content'] = $params['content'];
				}
			}
		}
		return $item;
	}
	
	private static function getBoundary($message) {
		preg_match('/boundary=\"([^\)]+)\"/', $message, $matches);
		return $matches[1];
	}
	
	private static function parseMessage($message) {
		$messageLines = explode(PHP_EOL, $message);
		$params = [];
		$content = '';
		foreach($messageLines as $line) {
			if(strpos($line, 'boundary="') !== false) {
				return $params;
			}
			$arr = explode(':', $line);
			if(count($arr) > 1) {
				$name = strtolower($arr[0]);
				$name = trim($name);
				$name = Inflector::id2camel($name);
				$name = Inflector::underscore($name);
				$value = trim($arr[1], ' ;');
				$params[$name] = $value;
			} elseif(!empty($line)) {
				$content .= $line . PHP_EOL;
			}
		}
		$params['content'] = trim($content);
		return $params;
	}
	
}

