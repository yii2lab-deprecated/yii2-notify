<?php

namespace yii2lab\notify\admin;

use yii\base\Module as YiiModule;
use yii2lab\notify\domain\enums\NotifyPermissionEnum;
use yii2lab\extension\web\helpers\Behavior;

/**
 * dashboard module definition class
 */
class Module extends YiiModule
{

    public function behaviors()
    {
        return [
            'access' => Behavior::access(NotifyPermissionEnum::MANAGE),
        ];
    }

}
