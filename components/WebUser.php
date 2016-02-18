<?php

namespace app\components;

use app\models\User;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class WebUser extends \yii\web\User
{
    /**
     * @param string $permissionName
     * @param array $params
     * @param bool|true $allowCaching
     * @return bool
     */
    public function can($permissionName, $params = [], $allowCaching = true)
    {
        if ($this->getIsGuest()) {
            return false;
        }

        $roles = [
            User::ROLE_USER => [
                User::ROLE_USER,
                User::ROLE_EDITOR,
                User::ROLE_ADMINISTRATOR,
            ],
            User::ROLE_EDITOR => [
                User::ROLE_EDITOR,
                User::ROLE_ADMINISTRATOR,
            ],
            User::ROLE_ADMINISTRATOR => [
                User::ROLE_ADMINISTRATOR,
            ],
        ];
        $userRole = $this->identity->role;
        if (!isset($roles[$permissionName])) {
            return false;
        }

        \Yii::trace(sprintf('User %s Permission %s', $userRole, $permissionName));
        return in_array($userRole, $roles[$permissionName]);
    }
}
