<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\helpers\ArrayHelper;

class Utility 
{
   
    // public static function state($department_id){
    //     //
    // }

    public static function city($state_id=NULL){
        $array = [];

        if(!empty($state_id)){
            $array= ArrayHelper::map(Cities::find()->where(['state_id'=>$state_id])->all(),'id','name');
        }
        return $array;
    }

    public static function department($city_id=NULL){
        $array = [];
        if(!empty($city_id)){
            $array= ArrayHelper::map(Department::find()->where(['cities_id'=>$city_id])->all(),'id','name');
        }
        return $array;
     }
}
