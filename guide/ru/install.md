Установка
===

Устанавливаем зависимость:

```
composer require yii2lab/yii2-notify
```

Создаем полномочие в RBAC:

```
rNotifyManage
```

Объявляем модуль в админке:

```php
return [
	'modules' => [
		// ...
		'notify' => [
			'class' => 'yii2lab\notify\admin\Module',
			'as access' => Config::genAccess(PermissionEnum::NOTIFY_MANAGE),
		],
		// ...
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'notify' => [
			'class' => 'yii2lab\domain\Domain',
			'path' => 'yii2lab\notify\domain',
			'repositories' => [
				'transport',
				'email' => Driver::MOCK,
				'sms' => Driver::MOCK,
				'flash' => Driver::SESSION,
			],
			'services' => [
				'transport',
				'email',
				'sms',
				'flash',
			],
		],
		// ...
	],
];
```

Объявляем конфиг `common/config/main.php`

```php
return [
	'components' => [
		// ...
		'queue' => [
			'class' => 'yii\queue\file\Queue',
			'path' => '@common/runtime/queue',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@yii2lab/notify/domain/mail',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => YII_DEBUG,
			'fileTransportPath' => '@common/runtime/mail',
		],
		// ...
	],
];
```
