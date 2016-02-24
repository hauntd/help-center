<?php

namespace app\controllers\management;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers\management
 */
class ManagementController extends Controller
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
}
