<?php

namespace frontend\modules\tools\controllers;

use trylife\ipAccess\models\IpAccess;
use Yii;

class PingController extends \yii\rest\Controller
{
    public $accessKey = 'jGajhDpsy2kKqDslFNcFt0zNF17BYqnT';

    public function actionPing($accessKey)
    {
        if ($accessKey != $this->accessKey) {
            return [1, false];
        }

        return IpAccess::addIpAccess();
    }
}
