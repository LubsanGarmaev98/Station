<?php

namespace app\controllers;

use app\models\form\StationCreateForm;
use app\models\form\StationUpdateForm;
use app\models\Station;
use HttpException;
use Yii;
use yii\rest\ActiveController;

class StationController extends ActiveController
{
    public $modelClass = Station::class;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }

    public function verbs(): array
    {
        $verbs = parent::verbs();

        $verbs['update'] = ['POST'];
        return $verbs;
    }

    public function actionCreate()
    {
        $form = new StationCreateForm();
        $form->setAttributes(Yii::$app->request->post());

        if ($form->save()) {
            return $form->getStation();
        }

        return ['errors' => $form->getErrors()];
    }

    public function actionUpdate($id)
    {
        $form = new StationUpdateForm();
        $form->station = $this->findModel($id);
        $form->setAttributes(Yii::$app->request->post());

        if ($form->save()) {
            return $form->getStation();
        }

        return ['errors' => $form->getErrors()];
    }

    protected function findModel($id): ?Station
    {
        if (($station = Station::findOne($id)) !== null) {
            return $station;
        }
        throw new HttpException(404, 'The requested page does not exist.');
    }
}