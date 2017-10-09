<?php

namespace yii2lab\notify\domain\entities;

/**
 * Class FlashEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property string $type
 * @property boolean $closable
 * @property boolean $autoHide
 */
class FlashEntity extends MessageEntity {

	const DELAY_DEFAULT = 5000;

	protected $type;
	protected $closable = true;
	protected $delay = self::DELAY_DEFAULT;

}
