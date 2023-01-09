<?php

namespace components\web;

use Yii;
use yii\base\UserException;
use yii\web\HttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{
    protected function convertExceptionToArray($exception): array
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(500, Yii::t('yii', 'An internal server error occurred.'));
        }

        $array = [
            'success' => false,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];

        if ($exception instanceof HttpException) {
            $array['status'] = $exception->statusCode;
        }

        if (YII_DEBUG) {
            $array['type'] = get_class($exception);
            if (!$exception instanceof UserException) {
                $array['file'] = $exception->getFile();
                $array['line'] = $exception->getLine();
                $array['stack-trace'] = explode("\n", $exception->getTraceAsString());
                if ($exception instanceof \yii\db\Exception) {
                    $array['error-info'] = $exception->errorInfo;
                }
            }
        }

        return $array;
    }
}
