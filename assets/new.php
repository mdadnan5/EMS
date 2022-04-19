<?php

namespace app\controllers;
use Yii;
class DepartmentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDepartment_home()
{
    $model = new \app\models\Department();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('department_home', [
        'model' => $model,
    ]);
}
}



///////DepartmentsController///////
