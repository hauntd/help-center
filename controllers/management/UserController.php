<?php

namespace app\controllers\management;

use Yii;
use app\models\User;
use app\models\UserQuery;
use app\components\AccessRule;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use yii\filters\VerbFilter;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers\management
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
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be refreshed.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel(['id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('primary', Yii::t('app', 'User has been updated.'));
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
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
        Yii::$app->session->setFlash('danger', Yii::t('app', 'User has been deleted.'));

        return $this->redirect(['index']);
    }
}
