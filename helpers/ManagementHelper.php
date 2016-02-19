<?php

namespace app\helpers;

use app\models\User;
use Yii;
use yii\bootstrap\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\helpers
 */
class ManagementHelper
{
    /**
     * @return array
     */
    public static function getUserRoles()
    {
        return [
            User::ROLE_USER => Yii::t('app', 'User'),
            User::ROLE_EDITOR => Yii::t('app', 'Editor'),
            User::ROLE_ADMINISTRATOR => Yii::t('app', 'Administrator'),
        ];
    }

    /**
     * @return array
     */
    public static function getUserStatuses()
    {
        return [
            User::STATUS_ACTIVE => Yii::t('app', 'Active'),
            User::STATUS_DELETED => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * Returns Bootstrap label with user's status
     * @param User $user
     * @return string
     */
    public static function getStatusLabel(User $user)
    {
        $statuses = [
            User::STATUS_ACTIVE => ['success', Yii::t('app', 'Active')],
            User::STATUS_DELETED => ['danger', Yii::t('app', 'Deleted')],
        ];
        if (isset($statuses[$user->status])) {
            return Html::tag('span', $statuses[$user->status][1], [
                'class' => 'label label-' . $statuses[$user->status][0],
            ]);
        }

        return 'N/A';
    }

    /**
     * Returns Bootstrap label widget with user's role
     * @param User $user
     * @return string
     */
    public static function getRoleLabel(User $user)
    {
        $roles = [
            User::ROLE_USER => ['success', Yii::t('app', 'User')],
            User::ROLE_EDITOR => ['warning', Yii::t('app', 'Editor')],
            User::ROLE_ADMINISTRATOR => ['danger', Yii::t('app', 'Administrator')],
        ];
        if (isset($roles[$user->role])) {
            return Html::tag('span', $roles[$user->role][1], [
                'class' => 'label label-' . $roles[$user->role][0],
            ]);
        }

        return 'N/A';
    }
}
