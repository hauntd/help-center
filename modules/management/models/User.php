<?php

namespace app\modules\management\models;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\models
 */
class User extends \app\models\User
{
    /** @var string */
    public $newPassword;

    /** @var string */
    public $newPasswordRepeat;

    /**
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat'], 'string', 'min' => 2, 'max' => 64],
            ['newPassword', 'compare', 'compareAttribute' => 'newPasswordRepeat'],
            [['newPassword', 'newPasswordRepeat'], 'required', 'when' => function($model) {
                return $model->isNewRecord;
            }, 'enableClientValidation' => false],
        ]);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'newPassword' => Yii::t('management', 'New password'),
            'newPasswordRepeat' => Yii::t('management', 'New password (repeat)'),
        ]);
    }

    /**
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (isset($this->newPassword) && mb_strlen($this->newPassword)) {
            $this->setPassword($this->newPassword);
        }

        return parent::beforeSave($insert);
    }
}
