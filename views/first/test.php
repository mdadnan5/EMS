<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
echo $name;
echo "<pre>" ; print_r($list);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Test page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
