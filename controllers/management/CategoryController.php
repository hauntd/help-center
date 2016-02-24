<?php

namespace app\controllers\management;

use app\models\Category;
use app\models\User;
use app\components\AccessRule;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers\management
 */
class CategoryController extends ManagementController
{
    /** @var Category */
    protected $model = Category::class;

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

    /**
     * Get categories tree in JSON format
     * @return array|null
     */
    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return (new Category())->getCategoriesTree();
    }

    /**
     * @return array
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete()
    {
        $category = $this->findModel(['id' => Yii::$app->request->post('id', null)]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($category->delete()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Category removed'),
            ];
        } else {
            return [
                'success' => false,
                'message' => $category->errors,
            ];
        }
    }
}
