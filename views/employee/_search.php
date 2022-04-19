<?php

use app\models\States;
use app\models\Utility;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        //'options' => ['class' => 'form-inline'],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
 <div class="card my-3">
    <div class="card-body">
        <div class="row row-sm">

            <div class="col-md-2">
                <?= $form->field($model, 'name')->textInput(['placeholder'=>'Enter Name'])->label(false) ?>

                </div>
                <div class="col-md-2">
                <?= $form->field($model, 'gender')->label(false)->dropDownList(['Male'=>'Male','Female'=>'Female'],['prompt'=>'Select Gender']); ?>
                </div>

<div class="col-md-2">

                <?= $form->field($model, 'state_id')->label(false)->dropDownList(
                    ArrayHelper::map(States::find()->all(), 'id', 'name'),
                    [
                           'prompt' => 'Select State',
                        'onchange' => '
             $.post( "/department/lists?id=' . '"+$(this).val(), function( data ) {
                $( "#' . Html::getInputId($model, 'cities_id') . '" ).html( data ); 
             });'
                    ]
                ); ?>

</div>

<div class="col-md-2">
                <?= $form->field($model, 'cities_id')->label(false)->dropDownList(
                    Utility::city($model->state_id),

                    [
                        'prompt' => 'Select District',
                        'onchange' => '
            $.post( "/employee/departmentlists?id=' . '"+$(this).val(), function( data ) {

              $( "#' . Html::getInputId($model, 'dept_id') . '" ).html( data ); 
            
            });'
                    ]
                );
                ?>
             </div>

<div class="col-md-3">
                <?= $form->field($model, 'dept_id')->label(false)->dropDownList(
                    Utility::department($model->cities_id),
                    [
                        'prompt' => 'Select Department',
                        // 'onchange'=>'
                        //  $.post( "/department/lists?id='.'"+$(this).val(), function( data ) {

                        //    $( "#'.Html::getInputId($model, 'dept_id').'" ).html( data ); 

                        // });'
                    ]
                );
                ?>
             </div>
            <div class="col-md-1 ">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    </div>
     
<!-- <div class="col-md-1 mx-2">
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        </div> -->
    </div>
</div>
 </div>
    </div> 
    </div>
        <?php ActiveForm::end(); ?>
   