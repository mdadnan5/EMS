<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
if(yii::$app->session->hasFlash('success')){
    echo yii::$app->session->getFlash('success');
}
?>
<?php $form = ActiveForm::begin();  ?>
<?= $form->Field($model,'name'); ?>
<?= $form->Field($model,'email'); ?>

<?= Html::submitButton('submit',['class'=>'btn btn-success']);  ?>