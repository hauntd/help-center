<?php

namespace app\components;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @param \yii\web\User $user
     * @return bool
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif (!$user->getIsGuest() && $role === $user->identity->role) {
                return true;
            }
        }

        return false;
    }
}
