<?php

namespace app\controllers;

use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class BaseController extends Controller
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

        return $behaviors;
    }

    public function actionIndex()
    {

    }
}
