<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\States;


/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 
 * @author Mohammad Adnan <rahilashraf555@gmail.com>
 */

class StatesForm extends model
{

    public $id;
    public $name;
    public $country_id;
    



    public function __construct($state_model = null)
    {
        $this->state_model = Yii::createObject([
            'class' => States::className()
        ]);
        if ($state_model != null) {
            $this->state_model = $state_model;
            $this->id = $this->state_model->id;
            $this->name = $this->state_model->name;
            $this->country_id = $this->state_model->country_id;
            
           
        }
    }

    public function rules()
    {
       
        return [
            [['name'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'country_id' => 'Country ID',
        ];
    }

    /**
     *
     * @return void
     */
    public function initializeForm()
    {
        $this->state_model->name = $this->name;
        $this->state_model->country_id = $this->country_id;
       
      
    }
}
