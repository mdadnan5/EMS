<?php

use yii\helpers\Html;
// use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
// use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
\yii\bootstrap4\Modal::begin([
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
\yii\bootstrap4\Modal::end();
?>
<?=

\aayushmhu\popupbutton\PopupButton::widget([
                    'options' => [
                        'value'=>'create',
                        'class'=>'btn btn-primary me-3 popupButton',
                        'data-id'=>'department-form',
                    ],
                    'label'=>'Popup'               
                ]); 
                
                ?>
<div class="employee-index">

    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
    <hr>
    <div class="row my-3">
        <div class="col-6">
            <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>

        </div>
        <div class="col-6">
            <div class="export text-right"></div>

        </div>
    </div>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
      //  'dob',
      [
        'attribute' => 'dob',
        'format' => ['date', 'php:d-m-Y']
    ],
        'salary',
        'gender',
        [
            'attribute' => 'Education',
            'value' => function ($model) {
                $text='';
               $text .= $model->btech == 1 ? 'B.tech'.', ' : '';
               $text .= $model->bca == 1 ? 'BCA'.', ' : '';
               $text .= $model->mtech == 1 ? 'M.tech'.', ' : '';
               $text .= $model->mca == 1 ? 'MCA' : '';
                return $text;


            },
        ],
        'hobbies',
        // 'resume',

        [
            'attribute' => 'state_id',
            'value' => function ($model) {
                return $model->department->city->state->name;
            },
        ],
        [
            'attribute' => 'cities_id',
            'value' => function ($model) {
                return $model->department->city->name;
            },
        ],

        [
            'attribute' => 'dept_id',
            'value' => function ($model) {
                return  $model->department->name;
            },
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ];
    
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,

    ]);
    ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //   'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                // 'header'=> 'S.NO. ',
            ],



            'name',
            // 'dob',
            [
                'attribute' => 'dob',
                'format' => ['date', 'php:d-m-Y']
            ],
            // [
            //     'attribute' => 'dob',
            //      'format' => 'date',
            //      'value' => 'termination_date',
            //       'filterInputOptions' => [
            //              'class'       => 'form-control',
            //              'placeholder' => 'MM/DD/YYYY'
            //        ],
            // ],
            'salary',
            'gender',
            [
                'attribute' => 'Education',
                'value' => function ($model) {
                    $text='';
                   $text .= $model->btech == 1 ? 'B.tech'.', ' : '';
                   $text .= $model->bca == 1 ? 'BCA'.', ' : '';
                   $text .= $model->mtech == 1 ? 'M.tech'.', ' : '';
                   $text .= $model->mca == 1 ? 'MCA' : '';
                    return $text;


                },
            ],
            // 'label'=>'btech',
            // [
            //     'attribute' => 'btech',
            //     'value' => function ($model) {
            //         return $model->btech == 1 ? 'Yes' : 'No';
            //     },
            // ],
            // 'bca',
            // [
            //     'attribute' => 'bca',
            //     'value' => function ($model) {
            //         return $model->bca == 1 ? 'Yes' : 'No';
            //     },
            // ],
            // 'mtech',
            // [
            //     'attribute' => 'mtech',
            //     'value' => function ($model) {
            //         return $model->mtech == 1 ? 'Yes' : 'No';
            //     },
            // ],
            // 'mca',
            // [
            //     'attribute' => 'mca',
            //     'value' => function ($model) {
            //         return $model->mca == 1 ? 'Yes' : 'No';
            //     },
            // ],
             [
                'attribute' => 'Resume',
                'format'=>'html',
                'value' => function ($model) {
                    return '<a href="download?file_path='.$model->resume.'">download</a>';
                },
            ],
            // 'hobbies',
            // 'resume',
            [
                'attribute' => 'state_id',
                'value' => function ($model) {
                    return $model->department->city->state->name;
                },
            ],
            [
                'attribute' => 'cities_id',
                'value' => function ($model) {
                    return $model->department->city->name;
                },
            ],
            [
                'attribute' => 'dept_id',
                'value' => function ($model) {
                    return  $model->department->name;
                },
            ],
            // 'dept_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Operations ',
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