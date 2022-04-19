<?php

use app\models\Cities;
use app\models\States;
use app\models\Utility;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'state_id')->dropDownList(
        ArrayHelper::map(States::find()->all(),'id','name'),
        [
            'prompt'=>'Select State',
              'onchange'=>'
             $.post( "/department/lists?id='.'"+$(this).val(), function( data ) {

                $( "#'.Html::getInputId($model, 'cities_id').'" ).html( data ); 
            //  
             });'

        ]); ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'cities_id')->dropDownList(
          Utility::city($model->state_id),
        [
            'prompt'=>'Select District',
            'onchange'=>'
            $.post( "/department/lists?id='.'"+$(this).val(), function( data ) {

               $( "#'.Html::getInputId($model, 'name').'" ).html( data ); 
           //  
            });'
            ]);
             ?>
    </div>
    <div class="col-md-12">
<?= $form->field($model, 'name',['inputOptions' => [
'autocomplete' => 'off']])->textInput(['maxlength' => true,'placeholder' => "Create Department"])?>
    </div>
 
    <div class="col-md-12">
    <div class="form-group">
    <!-- <div class="text-center"> -->
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <!-- </div> -->
    </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
