<?php

namespace app\models;

use codeonyii\yii2validators\AtLeastValidator;


/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $dob
 * @property int $salary
 * @property string $gender
 * @property string $btech
 * @property string $bca
 * @property string $mtech
 * @property string $mca
 * @property string $hobbies
 * @property string $resume
 * @property int $state_id
 * @property int $cities_id
 * @property int $dept_id
 * 
 */
class Employee extends \yii\db\ActiveRecord
{
    //public $state_id;
   // public $cities_id;
    public $resume_file;
    public $education;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $min = date('d-m-Y', strtotime(date("d-m-Y", strtotime("-18 year", time()))));
        $max = date('d-m-Y', strtotime(date("d-m-Y", strtotime("-60 year", time()))));
        return [
            [['name', 'dob', 'salary', 'gender', 'hobbies', 'dept_id', 'state_id', 'cities_id'], 'required', 'on' => ['create', 'update']],
            [
                ['name'], 'match',
                'pattern' => '/^[a-zA-Z\s]+$/',
                'message' => 'Name can only contain word characters'
            ],
            // 'in','range'=>range(5,20)
            //    ['dob', 'date', 'format' => 'yyyy-mm-dd', 'min' => $min, 'max' => $max, 'tooSmall'=>'The date is from past. Try another','tooBig' => 'The date is from future. Try another', 'message' => 'Try to input the date'],
            [['dob'], 'required', 'when' => function($model) use($min, $max) {
                return ($model->dob > $max && $model->dob < $min);
            },
            ],
            // 'compare', 'compareValue' => 18, 'operator' => '>='
            [['dob'], 'date','format' =>'yyyy-mm-dd', 'tooSmall' => 'Must be 18 years old and not older than 60'],
            // [['dob'], 'date', 'min' => $min, 'max' => $max, 'format' => 'yyyy-mm-dd', 'tooSmall' => 'Must be 18 years old and not older than 60'],
            [['salary'], 'integer'],
            [['name', 'dept_id'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 11],
            [['btech', 'bca', 'mtech', 'mca', 'resume'], 'string', 'max' => 255],
            [['btech', 'bca', 'mtech', 'mca'], AtLeastValidator::className(), 'in' => ['btech', 'bca', 'mtech', 'mca'], 'min' => 1],
            // [['education'], AtLeastValidator::className(), 'in' => ['btech', 'bca', 'mtech', 'mca'], 'min' => 1],
            [['hobbies'], 'string', 'max' => 5000],
            [['resume_file'], 'file','skipOnEmpty' => true,],
            // [['resume_file'], 'safe'],

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

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'dept_id']);
    }
}
