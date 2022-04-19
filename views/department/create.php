<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = 'Create Department';
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
       <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    

</div>
