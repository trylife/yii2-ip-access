<?php

namespace trylife\ipAccess;

use Yii;

/**
 * This is the model class for table "ip_access".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $createdAt
 * @property integer $endAt
 */
class IpAccess extends \yii\db\ActiveRecord
{
    /**
     * 授权持续时间
     */
    public $endurance = 86400;
    public $time;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{ip_access}}';
    }

    public static function addIpAccess()
    {
        $instance = new static();
        /* @var trylife\ipAccess\models\IpAccess $ipAccessModel */
        if ($ipAccessModel = $instance->hasActiveRecord()) {
            $ipAccessModel->endAt = $instance->time + $instance->endurance;
            return $ipAccessModel->save();
        }
        $instance->createdAt = time();
        $instance->endAt = $instance->time + $instance->endurance;
        return $instance->save();
    }

    public function hasActiveRecord()
    {
        return $this->find()
            ->where([
                'ip' => $this->ip,
            ])
            ->andWhere(['<', 'endAt', time() + $this->endurance])
            ->one();
    }

    public static function hasIpAccess()
    {
        $instance = new static();
        return $instance->hasActiveRecord() ? true : false;
    }

    public function init()
    {
        parent::init();
        $this->ip = Yii::$app->request->getUserIP();
        $this->time = time();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdAt', 'endAt'], 'integer'],
            [['ip'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#ID'),
            'ip' => Yii::t('app', 'IP'),
            'createdAt' => Yii::t('app', '创建时间'),
            'endAt' => Yii::t('app', '授权结束时间'),
        ];
    }
}
