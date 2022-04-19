<?php

 use yii\helpers\Html;
// use yii\grid\GridView;
// use kartik\export\ExportMenu;
//use yii\grid\GridView;
use kartik\export\ExportMenu;
// use kartik\grid\GridView as GridGridView;
use kartik\grid\GridView;
// use yii\grid\GridView;
//use yii\kartik\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">

    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
          <hr>
          <div class="row my-3">
        <div class="col-6">
        <?= Html::a('Create Department', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-6">
            <div class="export text-right"></div>

        </div>
    </div>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

 <?php
    $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
   //'id',
   'state_id',
   'cities_id',
   'name',
    ['class' => 'yii\grid\ActionColumn'],
];


echo ExportMenu::widget([
    
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]);
?>

    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           'name',
          
            [
                'attribute' => 'cities_id',
                'value' => function ($model) {
                    return $model->city->name;
                },
            ],
            [
                'attribute' => 'state_id',
                'value' => function ($model) {
                    return $model->city->state->name;
                },
            ],
         
            

           
            ['class' => 'yii\grid\ActionColumn',
            'header'=> 'Action',
        ],
        ],
        'layout'=>"\n{items}<div class='row'><div class='col-6'>{pager}</div><div class='col-6 text-right'>{summary}</div></div>"
    ]); ?>
     <div class="rowshowingstring">
        
        </div>
    
</div>
<style>
    #w1-xlsx {
        display: none;
    }

    #w1-txt {
        display: none;
    }
</style>

<?php
$this->registerJs("
$(document).ready(function(){
    
    var btnGroup=$('.container .btn-group');
    $('.export').html(btnGroup.html());
    btnGroup.hide();

    }); 
 ");
?>