<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\helpers\VarDumper;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\commands
 */
class UserController extends Controller
{
    /** @var string */
    public $username;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $role = 'user';

    /** @var array */
    private $_roles = [
        'user' => User::ROLE_USER,
        'editor' => User::ROLE_EDITOR,
        'administrator' => User::ROLE_ADMINISTRATOR,
    ];

    /**
     * @param string $action
     * @return array
     */
    public function options($action)
    {
        return array_merge(parent::options($action), [
            'username', 'email', 'password', 'role',
        ]);
    }

    /**
     * Creates new user
     * @return bool|int
     */
    public function actionCreate()
    {
        if (!isset($this->_roles[$this->role])) {
            return $this->stderr("Wrong role\n");
        }
        if (!isset($this->username) || !isset($this->password) || !isset($this->email)) {
            return $this->stdout("Usage:\n./yii user/create --username=%user% " .
                "--email=%email --password=%password% [--role=%user%]\n");
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->role = $this->_roles[$this->role];
        $user->status = User::STATUS_ACTIVE;
        if ($user->save()) {
            return $this->stdout(sprintf("User #%d created\n", $user->id));
        } else {
            return $this->stderr(VarDumper::dumpAsString($user->errors));
        }
    }
}
