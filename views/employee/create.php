<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

<h2 class="text-center"><?= Html::encode($this->title) ?></h2>
    <hr>
    <div class="bg-light p-2">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
