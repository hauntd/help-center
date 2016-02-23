<?php

namespace app\controllers\management;

use app\models\Category;
use app\models\User;
use app\components\AccessRule;
use yii\filters\AccessControl;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers\management
 */
class CategoryController extends ManagementController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_EDITOR, User::ROLE_ADMINISTRATOR],
                    ],
                ],
                'ruleConfig' => [
                    'class' => AccessRule::class,
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new Category();

        return $this->render('index', [
            'categories' => $model->getCategoriesTree(),
        ]);
    }
}
