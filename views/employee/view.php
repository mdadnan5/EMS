<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>
         <hr>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <!-- <table class="table table-hover">
 
  <tbody>
  

    <tr>
        <th scope="col">Name</th>
        <td scope="col"><?=$model->name?></td>
    </tr>

    <tr>
    <th scope="col">Date of Birth</th>
    <td scope="col"><?=date('d-m-Y',strtotime($model->dob))?></td>
    </tr>

    <tr>
    <th scope="col">Salary</th>
    <td scope="col"><?=$model->salary?></td> 
    </tr>

      <tr>
    <th scope="col">Gender</th>
    <td scope="col"><?=$model->gender?></td> 
    </tr>
       
    <tr>
        <th scope="col">Education</th>
        <td scope="col"><?=$model->btech == 1 ? 'Btech':''?> <?=$model->bca == 1 ? 'BCA':''?> <?=$model->mtech == 1 ? 'Mtech':''?> <?=$model->mca == 1 ? 'MCA':''?></td>  
    </tr>

    <tr>
    <th scope="col">Hobbies</th>
    <td scope="col"><?=$model->hobbies?></td> 
    </tr>

    <tr>
    <th scope="col">Resume</th>
    <td scope="col">
    <a href="download?file_path=<?=$model->resume?>">download</a>
  
  </td> 
    </tr>
    <tr>
    <th scope="col">State</th>
    <td scope="col"><?=$model->department->city->state->name?></td> 
    </tr>
    <tr>
    <th scope="col">City</th>
    <td scope="col"><?=$model->department->city->name?></td> 
    </tr>
    <tr>
    <th scope="col">Department</th>
    <td scope="col"><?=$model->department->name?></td> 
    </tr>

  </tbody>
</table> -->

 <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Salary</th>
      <th scope="col">Gender</th>
      <th scope="col">Education</th>
      <th scope="col">Resume</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col">Department</th>
      <!-- <th scope="col">Hobbies</th> -->
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><?=$model->name?></td>
      <td><?=date('d-m-Y',strtotime($model->dob))?></td>
      <td><?=$model->salary?></td>
      <td><?=$model->gender?></td>
      <td><?=$model->btech == 1 ? 'Btech'.', ':''?> <?=$model->bca == 1 ? 'BCA'.', ':''?> <?=$model->mtech == 1 ? 'Mtech' . ', ':''?> <?=$model->mca == 1 ? 'MCA':''?></td>
      <td> <a href="download?file_path=<?=$model->resume?>">download</a></td>
      <td><?=$model->department->city->state->name?></td>
      <td><?=$model->department->city->name?></td>
      <td><?=$model->department->name?></td>
      <!-- <td><?=$model->hobbies?></td> -->
    </tr>
  </tbody>
</table> 

</div>
