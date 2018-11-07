<?php

namespace yii2lab\notify\domain\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

class EmlParserHelper {
	
	public static function parse($message) {
		$parts = self::splitToParts($message);
		$item = [];
		foreach($parts as &$partCode) {
			$partCode = trim($partCode);
			$partCode = trim($partCode, '-');
			if($partCode) {
				$params = self::parsePart($partCode);
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
	
	private static function splitToParts(string $message) : array {
		$boundary = self::getBoundary($message);
		$parts = explode('--' . $boundary, $message);
		return $parts;
	}
	
	private static function getBoundary(string $message) : string {
		preg_match('/boundary=\"([^\)]+)\"/', $message, $matches);
		return $matches[1];
	}
	
	private static function parsePart(string $partCode) : array {
		$messageLines = explode(PHP_EOL, $partCode);
		$params = self::parseParams($messageLines);
		$params['content'] = trim(implode(PHP_EOL, $params['content']));
		return $params;
	}
	
	private static function parseParams(array $messageLines) : array {
		$params = [];
		foreach($messageLines as $line) {
			if(strpos($line, 'boundary="') !== false) {
				return $params;
			}
			$newParams = self::parseLine($line);
			if($newParams) {
				$params = ArrayHelper::merge($params, $newParams);
			}
		}
		return $params;
	}
	
	private static function parseLine(string $line) : array {
		if(empty($line)) {
			return [];
		}
		$arr = explode(':', $line);
		$params = [];
		$params['content'] = [];
		if(count($arr) > 1) {
			$name = self::prepareName($arr[0]);
			$params[$name] = self::prepareValue($arr[1]);
		} elseif(!empty($line)) {
			$params['content'][] = $line;
		}
		return $params;
	}
	
	private static function prepareValue(string $value) : string {
		$value = trim($value, ' ;');
		return $value;
	}
	
	private static function prepareName(string $name) : string {
		$name = strtolower($name);
		$name = trim($name);
		$name = Inflector::id2camel($name);
		$name = Inflector::underscore($name);
		return $name;
	}
	
}

