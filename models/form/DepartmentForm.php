<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\Department;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $state_id
 * @property string $cities_id
 * @property string $name
 
 * @author Mohammad Adnan <rahilashraf555@gmail.com>
 */

class DepartmentForm extends model
{

    public $id;
    public $state_id;
    public $cities_id;
    public $name;
    public $department_model;
    




    public function __construct($department_model = null)
    {
        $this->department_model = Yii::createObject([
            'class' => Department::className()
        ]);
        if ($department_model != null) {
            $this->department_model = $department_model;
            $this->id = $this->department_model->id;
            $this->state_id = $this->department_model->state_id;
            $this->cities_id = $this->department_model->cities_id;
            $this->name = $this->department_model->name;
           
        }
    }

    public function rules()
    {
       
        return [
            [['state_id', 'cities_id', 'name'], 'required'],
            [['state_id', 'cities_id', 'name'], 'string', 'max' => 50],
            ['name', 'unique', 'targetAttribute' => ['cities_id', 'name']]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Department ',
             'state_id' => 'State ',
             'cities_id' => 'City  ',
             'name' => 'Department ',
         ];
    }

    /**
     *
     * @return void
     */
    public function initializeForm()
    {
     
        $this->department_model->state_id = $this->state_id;
        $this->department_model->cities_id = $this->cities_id;
        $this->department_model->name = $this->name;
       
      
    }
}
