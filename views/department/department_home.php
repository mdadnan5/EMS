<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form ActiveForm */
?>
<div class="department-department_home">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'state_id') ?>
        <?= $form->field($model, 'cities_id') ?>
        <?= $form->field($model, 'name') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
