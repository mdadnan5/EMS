<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form ActiveForm */
?>
<div class="employee-employee_home">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'dob') ?>
        <?= $form->field($model, 'salary') ?>
        <?= $form->field($model, 'gender') ?>
        <?= $form->field($model, 'education') ?>
        <?= $form->field($model, 'hobbies') ?>
        <?= $form->field($model, 'resume') ?>
        <?= $form->field($model, 'dept_id') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
