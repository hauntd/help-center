<?php

namespace app\actions;

use Yii;
use yii\web\Response;
use yii\web\HttpException;
use yii\base\Exception;
use yii\base\UserException;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\actions
 */
class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * Runs the action
     *
     * @return string result content
     */
    public function run()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = $this->defaultName ?: Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        }

        $data = [
            'name' => $name,
            'message' => $message,
            'exception' => $exception,
        ];
        if (Yii::$app->getRequest()->getIsAjax()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->controller->render($this->view ?: $this->id, $data);
        }
    }
}
