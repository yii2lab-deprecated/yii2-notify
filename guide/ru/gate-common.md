Общие принципы
===

Вместо темы или содержания мы можем использовать доступ к переводам

```php
Yii::$app->notify->flash->send(['main', 'not_found'], Alert::TYPE_DANGER);
```

SMS и Email Отправляются через очередь по CRON.
