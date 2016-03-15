<?php

namespace app\modules\management\controllers;

use app\components\AccessRule;
use app\modules\management\models\Category;
use app\modules\management\models\Post;
use app\modules\management\models\PostSearch;
use app\modules\management\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\controllers
 */
class PostController extends ManagementController
{
    /** @var string */
    public $model = Post::class;

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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = new Post();
        $categories = Category::find()->orderBy('title')->all();

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->redirect(['update', 'id' => $post->id]);
        } else {
            return $this->render('create', [
                'post' => $post,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = $this->findModel(['id' => $id]);
        $categories = Category::find()->orderBy('title')->all();

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->redirect(['update', 'id' => $post->id]);
        } else {
            return $this->render('update', [
                'post' => $post,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel(['id' => $id])->delete();

        return $this->redirect(['index']);
    }
}
