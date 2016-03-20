<?php

namespace app\modules\management\controllers;

use app\components\WebController;
use Yii;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\controllers
 */
class ManagementController extends WebController
{
    /** @var ActiveRecord */
    protected $model;

    /** @var string */
    public $layout = '@app/modules/management/views/layouts/management.php';

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
     * @param ActiveRecord $model
     * @param array $params
     * @return bool|mixed
     */
    public function performModelSave(ActiveRecord $model, array $params)
    {
        $ajax = Yii::$app->request->isAjax;
        if ($model->save()) {
            if ($ajax) {
                $data = [
                    'success' => true,
                    'message' => Yii::t('management', 'Model saved'),
                ];
                if (isset($params['success']) && is_callable($params['success'])) {
                    $data = array_merge($data, call_user_func($params['success'], $model));
                }
                return $this->sendJson($data);
            }
            if (isset($params['fallback']) && is_callable($params['fallback'])) {
                return call_user_func($params['fallback'], $model);
            }
        } else {
            if ($ajax) {
                $data = [
                    'success' => false,
                    'message' => Yii::t('management', 'Model not saved'),
                    'messages' => ActiveForm::validate($model),
                ];
                if (isset($params['error']) && is_callable($params['error'])) {
                    $data = array_merge($data, call_user_func($params['error'], $model));
                }
                return $this->sendJson($data);
            }
        }

        return false;
    }

    /**
     * @param ActiveRecord $model
     * @param array $params
     * @return bool
     * @throws \Exception
     */
    public function performModelDelete(ActiveRecord $model, array $params)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->delete()) {
            if (isset($params['afterDelete']) && is_callable($params['afterDelete'])) {
                call_user_func($params['afterDelete'], $model);
            }
            $data = [
                'success' => true,
                'message' => Yii::t('management', 'Model has been removed'),
            ];
            if (isset($params['success']) && is_callable($params['success'])) {
                $data = array_merge($data, call_user_func($params['success'], $model));
            }
        } else {
            $data = [
                'success' => false,
                'message' => Yii::t('management', 'Model not saved'),
                'messages' => ActiveForm::validate($model),
            ];
            if (isset($params['error']) && is_callable($params['error'])) {
                $data = array_merge($data, call_user_func($params['error'], $model));
            }
        }

        return $this->sendJson($data);
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        }

        return parent::render($view, $params);
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
