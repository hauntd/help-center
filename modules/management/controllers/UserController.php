<?php

namespace app\modules\management\controllers;

use Yii;
use app\modules\management\models\User;
use app\modules\management\models\UserQuery;
use app\components\AccessRule;
use yii\filters\AccessControl;
use yii\base\Exception;
use yii\filters\VerbFilter;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\controllers
 */
class UserController extends ManagementController
{
    /** @var User */
    protected $model = User::class;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR],
                    ],
                ],
                'ruleConfig' => [
                    'class' => AccessRule::class,
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'helper' => $this->module->getHelper(),
        ]);
    }

    /**
     * Creates a new User model.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->post())) {
            $this->performModelSave($user, [
                'success' => function() {
                    return ['message' => Yii::t('management', 'User has been added')];
                },
                'fallback' => function($user) {
                    return $this->redirect(['update', 'id' => $user->id]);
                }
            ]);
        }

        return $this->render('create', [
            'user' => $user,
            'helper' => $this->module->getHelper(),
        ]);
    }

    /**
     * Updates an existing User model.
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel(['id' => $id]);

        if ($user->load(Yii::$app->request->post())) {
            $this->performModelSave($user, [
                'success' => function() {
                    return ['message' => Yii::t('management', 'User has been updated')];
                },
                'fallback' => function($user) {
                    return $this->redirect(['update', 'id' => $user->id]);
                }
            ]);
        }

        return $this->render('update', [
            'user' => $user,
            'helper' => $this->module->getHelper(),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @throws Exception
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->id == $id) {
            throw new Exception('You can not delete active user');
        }
        $this->findModel(['id' => $id])->delete();

        return $this->redirect(['index']);
    }
}
