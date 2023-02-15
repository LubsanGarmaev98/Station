<?php

namespace app\controllers;

use app\models\form\LineCreateForm;
use app\models\Line;
use yii\rest\ActiveController;

class LineController extends ActiveController
{
    public $modelClass = Line::class;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create']);

        return $actions;
    }

    public function actionCreate()
    {
        $form = new LineCreateForm();
        $form->setAttributes(\Yii::$app->request->post());

        if ($form->save()) {
            return $form->getLine();
        }

        return ['errors' => $form->getErrors()];

    }
}