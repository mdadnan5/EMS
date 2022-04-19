<?php

namespace app\controllers;
use Yii;
class citiesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    // public function actionLists($id)
    // {
    //     $countCities = Cities::find()
    //     ->where(['state_id' => $id])
    //     ->count();


    //     $cities =Cities::find()
    //     ->where(['state_id' => $id])
    //     ->all();

    //     if($countcities > 0 ){
    //         foreach($cities as $citie){
    //             echo "<option value='"$citie->citie_id"'>"$citie-> name "</option>";
    //         }
    //     }
    //     else{
    //         echo "<option> - </option>";
    //     }
    // }
    
    public function actionCities_home()
    {
        $model = new \app\models\cities();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('cities_home', [
            'model' => $model,
        ]);
    }
}
