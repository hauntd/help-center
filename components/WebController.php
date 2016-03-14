<?php

namespace app\components;

use Yii;
use yii\web\Controller;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class WebController extends Controller
{
    /**
     * @param $data
     */
    protected function sendJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->data = $data;
        Yii::$app->response->send();
        Yii::$app->end();
    }
}
