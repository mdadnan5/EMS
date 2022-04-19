<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\ckeditor\CKEditor;
use app\models\States;
use app\models\Utility;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (!empty($model->dept_id)) {
    $model->state_id = $model->department->city->state->id;
    $model->cities_id = $model->department->city->id;
} else {
    $model->state_id = null;
    $model->cities_id = null;
}
?>
<style>
    .field-employee-dob .invalid-feedback {
        display: block !important;

    }
</style>
<div class="employee-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name', ['inputOptions' => [
                'autocomplete' => 'off'
            ]])->textInput(['maxlength' => true, 'placeholder' => "Enter Your Name"]) ?>

        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'dob', ['inputOptions' => [
                'autocomplete' => 'off'
            ]])->widget(
                DatePicker::Classname(),
                [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pickerIcon' => '<i class="fa fa-calendar text-primary"></i>',
                    'removeIcon' => '<i class="fa fa-trash text-danger"></i>',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'endDate' => date('Y-m-d', strtotime(date("Y-m-d", strtotime("-18 year", time())))),
                        'startDate' => date('Y-m-d', strtotime(date("Y-m-d", strtotime("-60 year", time()))))
                    ]
                ]
            );
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'salary', ['inputOptions' => [
                'autocomplete' => 'off'
            ]])->textInput(['placeholder' => "Enter Your Salary"]) ?>

        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'gender')->radioList(['Male' => 'Male', 'Female' => 'Female'])->label('Gender'); ?>
            <!-- <?= $form->field($model, 'gender')->dropDownList(
                        ['Male' => 'Male', 'Female' => 'Female'],
                        ['prompt' => 'Enter Your Gender']
                    ) ?> -->
        </div>

        <div class="col-md-12">
                <?= $form->field($model, 'education')->hiddenInput()->label('Education'); ?>  

            
        </div>
        <div class="col-md-12">
            <div class="edu">


                <!-- <?= $form->field($model, 'btech')->checkboxList(['Btech' => 'Btech', 'BCA' => 'BCA', 'MCA' => 'BCA', 'Mtech' => 'Mtech'])->label('Education'); ?>   -->
                <?= $form->field($model, 'btech')->checkbox() ?>

                <?= $form->field($model, 'bca')->checkbox() ?>


                <?= $form->field($model, 'mtech')->checkbox() ?>

                <?= $form->field($model, 'mca')->checkbox() ?>
            </div>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'hobbies')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom',

            ]) ?>
        </div>
        <div class="col-md-12">
            <?php
            if (!empty($model->resume)) {
            ?>
                <a href="download?file_path=<?= $model->resume ?>">download</a>

            <?php
            } ?>
            <?= $form->field($model, 'resume_file')->fileInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'state_id')->dropDownList(
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
        <div class="col-md-4">
            <?= $form->field($model, 'cities_id')->dropDownList(
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
        <div class="col-md-4">
            <?= $form->field($model, 'dept_id')->dropDownList(
                Utility::department($model->cities_id),
                [
                    'prompt' => 'Select Department',
                ]
            );
            ?>
        </div>
        <div class="form-group col-md-12">


            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        </div>

    </div>

    <?php ActiveForm::end(); ?>
</div>
<style>
    .datepicker {
        z-index: 1031 !important;
    }
    .invalid-feedback{
        display: block !important;
    }
</style>