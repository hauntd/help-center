<?php

namespace app\controllers\management;

use app\components\WebController;
use Yii;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;
use yii\web\Response;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers\management
 */
class ManagementController extends WebController
{
    /** @var ActiveRecord */
    protected $model;

    /** @var string */
    public $layout = '@app/views/management/layouts/management.php';

    /**
     * @param $params
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function findModel($params)
    {
        $model = call_user_func([$this->model, 'find'])->where($params)->one();
        if ($model == null) {
            throw new NotFoundHttpException('Model not found');
        }

        return $model;
    }

    /**
     * @param $model
     * @return array
     */
    protected function toggleVisibility($model)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model->isVisible = $model->isVisible ? 0 : 1;
        if ($model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Item visibility updated'),
                'isVisible' => $model->isVisible,
            ];
        }
        return [
            'success' => false,
            'errors' => $model->errors,
        ];
    }
}
