<?php

namespace app\modules\management\controllers;

use app\modules\management\forms\CategorySortForm;
use app\modules\management\models\Category;
use app\modules\management\models\User;
use app\components\AccessRule;
use Yii;
use yii\bootstrap\ActiveForm;;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\helpers\VarDumper;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\controllers
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'toggle' => ['POST'],
                    'sort-items' => ['POST'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'category' => new Category(),
        ]);
    }

    /**
     * Creates new category
     * @return string|Response
     */
    public function actionCreate()
    {
        $category = new Category();
        $ajax = Yii::$app->request->isAjax;

        if ($category->load(Yii::$app->request->post())) {
            if ($category->save()) {
                if ($ajax) {
                    $this->sendJson([
                        'success' => true,
                        'message' => Yii::t('app', 'Category added'),
                        'category' => $category,
                    ]);
                }
                $this->redirect(['index']);
            } else {
                if ($ajax) {
                    $this->sendJson(['messages' => ActiveForm::validate($category)]);
                }
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'category' => $category,
            ]);
        }

        return $this->render('create', [
            'category' => $category,
        ]);
    }

    /**
     * Updates category
     * @param integer $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $category = $this->findModel(['id' => $id]);
        $ajax = Yii::$app->request->isAjax;

        if ($category->load(Yii::$app->request->post())) {
            if ($category->save()) {
                if ($ajax) {
                    $this->sendJson([
                        'success' => true,
                        'message' => Yii::t('app', 'Category updated'),
                        'category' => $category,
                    ]);
                }
                $this->redirect(['index']);
            } else {
                if ($ajax) {
                    $this->sendJson(['messages' => ActiveForm::validate($category)]);
                }
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'category' => $category,
            ]);
        }

        return $this->render('update', [
            'category' => $category,
        ]);
    }

    /**
     * Get categories tree in JSON format
     * @return array|null
     */
    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tree = (new Category())->getCategoriesTree();
        return count($tree) ? $tree : [
            [
                'id' => 0,
                'label' => Yii::t('app', 'No categories yet'),
                'isEmpty' => true,
            ],
        ];
    }

    /**
     * Toggles visibility
     * @param $id
     * @return array
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionToggle($id)
    {
        $category = $this->findModel(['id' => $id]);
        return $this->toggleVisibility($category);
    }

    /**
     * @return array
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionSortItems()
    {
        $form = new CategorySortForm();
        if ($form->load(Yii::$app->request->post()) && !$form->validate()) {
            throw new InvalidParamException(VarDumper::dumpAsString($form->errors));
        }

        $movedNode = $this->findModel(['id' => $form->movedNodeId]);
        $targetNode = $this->findModel(['id' => $form->targetNodeId]);

        if ($form->type == CategorySortForm::TYPE_SET_PARENT_AND_MOVE) {
            $movedNode->parentId = $form->newParentId;
            $movedNode->save();
        }

        switch ($form->position) {
            case CategorySortForm::BEFORE:
                $movedNode->moveBefore($targetNode)->save();
                break;
            case CategorySortForm::AFTER:
                $movedNode->moveAfter($targetNode)->save();
                break;
            case CategorySortForm::INSIDE:
                $movedNode->moveFirst()->save();
                break;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => true,
        ];
    }

    /**
     * @return array
     * @param integer $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $category = $this->findModel(['id' => $id]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($category->delete()) {
            $category->updateAll(['parentId' => $category->parentId], ['parentId' => $category->id]);
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
