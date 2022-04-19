<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\Employee;
use codeonyii\yii2validators\AtLeastValidator;


/**
 * This is the model class for table "employee".
 *
 
 
 * @author Mohammad Adnan <rahilashraf555@gmail.com>
 */

class EmployeeForm extends model
{

    public $id;
    public $name;
    public $dob;
    public $salary;
    public $gender;
    public $education;
    public $btech;
    public $bca;
    public $mtech;
    public $mca;
    public $hobbies;
    public $resume_file;
    public $resume;
    public $state_id;
    public $cities_id;
    public $dept_id;
    public $employee_model;




    public function __construct($employee_model = null)
    {
        $this->employee_model = Yii::createObject([
            'class' => Employee::className()
        ]);
        if ($employee_model != null) {
            $this->employee_model = $employee_model;
            $this->id = $this->employee_model->id;
            $this->name = $this->employee_model->name;
            $this->dob = $this->employee_model->dob;
            $this->salary = $this->employee_model->salary;
            $this->gender = $this->employee_model->gender;
            $this->btech = $this->employee_model->btech;
            $this->bca = $this->employee_model->bca;
            $this->mtech = $this->employee_model->mtech;
            $this->mca = $this->employee_model->mca;
            $this->hobbies = $this->employee_model->hobbies;
            $this->state_id = $this->employee_model->state_id;
            $this->cities_id = $this->employee_model->cities_id;
            $this->dept_id = $this->employee_model->dept_id;
        }
    }

    public function rules()
    {
        $min = date('d-m-Y', strtotime(date("d-m-Y", strtotime("-18 year", time()))));
        $max = date('d-m-Y', strtotime(date("d-m-Y", strtotime("-60 year", time()))));
        return [
            [['name', 'dob', 'salary', 'gender', 'hobbies','resume', 'dept_id', 'state_id', 'cities_id'], 'required', 'on' => ['create', 'update']],
            [
                ['name'], 'match',
                'pattern' => '/^[a-zA-Z\s]+$/',
                'message' => 'Name can only contain word characters'
            ],
           
            [['dob'], 'required', 'when' => function($model) use($min, $max) {
                return ($model->dob > $max && $model->dob < $min);
            },
            ],
            
            [['dob'], 'date','format' =>'yyyy-mm-dd', 'tooSmall' => 'Must be 18 years old and not older than 60'],
           
            [['salary'], 'integer'],
            [['name', 'dept_id'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 11],
            [['btech', 'bca', 'mtech', 'mca', 'resume'], 'string', 'max' => 255],
            [['btech', 'bca', 'mtech', 'mca'], AtLeastValidator::className(), 'in' => ['btech', 'bca', 'mtech', 'mca'], 'min' => 1],
            
            [['hobbies'], 'string', 'max' => 5000],
            [['resume_file'], 'file','skipOnEmpty' => true,],

            [['resume_file'], 'required', 'on' => ['create']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'dob' => 'Date of Birth',
            'salary' => 'Salary',
            'gender' => 'Gender',
            'btech' => 'Btech',
            'bca' => 'BCA',
            'mtech' => 'Mtech',
            'mca' => 'MCA',
            'hobbies' => 'Hobbies',
            'resume' => 'Resume',
            'state_id' => 'State ',
            'cities_id' => 'City ',
            'dept_id' => 'Department',
        ];
    }

    /**
     *
     * @return void
     */
    public function initializeForm()
    {
    
        $this->employee_model->name = $this->name;
        $this->employee_model->dob = $this->dob;
        $this->employee_model->salary = $this->salary;
        $this->employee_model->gender = $this->gender;
        $this->employee_model->btech = $this->btech;
        $this->employee_model->bca = $this->bca;
        $this->employee_model->mtech = $this->mtech;
        $this->employee_model->mca = $this->mca;
        $this->employee_model->hobbies = $this->hobbies;
        $this->employee_model->state_id = $this->state_id;
        $this->employee_model->cities_id = $this->cities_id;
        $this->employee_model->dept_id = $this->dept_id;
    }
}
