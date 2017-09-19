<?php

use yii2lab\migration\db\MigrationCreateTable as Migration;

/**
* Handles the creation of table `notify`.
*/
class m170712_163423_create_notify_table extends Migration
{
	public $table = '{{%notify}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->primaryKey(),
			'type' => $this->string()->notNull(),
			'subject' => $this->string(),
			'message' => $this->text()->notNull(),
			'address' => $this->string()->notNull(),
			'created_at' => $this->timestamp(),
		];

	}

	public function afterCreate()
	{
		
	}

}
