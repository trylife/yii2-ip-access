<?php

namespace trylife\IpAccess\controllers;

use trylife\ipAccess\models\IpAccess;
use Yii;

class PingController extends \yii\rest\Controller
{
    public $accessKey = 'jGajhDpsy2kKqDslFNcFt0zNF17BYqnT';

    public function actionPing($accessKey)
    {
        if ($accessKey != $this->accessKey) {
            return [
                'code' => 0,
                'message' => 'no access'
            ];
        }

        return IpAccess::addIpAccess();
    }
}
