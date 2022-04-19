<?php

namespace app\controllers;


use yii\web\Controller;


class FirstController extends Controller
{
    public function actionIndex(){
        echo "MOHAMMAD ADNAN";   die;
    }
    public function actionTest(){

        $response = [];
        $response['name'] = 'code Improve';
        $response['list'] = ['Test'.'Demo'.'Crud'];
      return   $this-> render('test', $response);
    }
}
