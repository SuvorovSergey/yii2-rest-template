<?php

namespace app\controllers;

use components\web\ResponseCodes;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => ['*' => ['POST']],
        ];

        return $behaviors;
    }

    public function actionIndex(): array
    {
        return $this->prepare(ResponseCodes::CODE_OK);
    }

    public function prepare(int $code, array $data = [], string $message = ''): array
    {
        if (empty($message)) {
            $message = ResponseCodes::getMessageByCode($code);
        }

        return [
            'success' => $code < 400,
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }
}
