<?php

namespace app\controllers;
use Yii;
class StatesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStates_home()
{
    $model = new \app\models\states();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('states_home', [
        'model' => $model,
    ]);
}
}
