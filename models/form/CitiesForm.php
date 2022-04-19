<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\Cities;


/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 
 * @author Mohammad Adnan <rahilashraf555@gmail.com>
 */

class CitiesForm extends model
{

    public $id;
    public $name;
    public $state_id;
    public $cities_model;
    




    public function __construct($cities_model = null)
    {
        $this->cities_model = Yii::createObject([
            'class' => Cities::className()
        ]);
        if ($cities_model != null) {
            $this->cities_model = $cities_model;
            $this->id = $this->cities_model->id;
            $this->name = $this->cities_model->name;
            $this->state_id = $this->cities_model->state_id;
            $this->cities_model = $this->cities_model->cities_model;
           
        }
    }

    public function rules()
    {
       
        return [
            [['name', 'state_id'], 'required'],
            [['state_id'], 'integer'],
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
            'state_id' => 'State',
        ];
    }

    /**
     *
     * @return void
     */
    public function initializeForm()
    {
        $this->cities_model->name = $this->name;
        $this->cities_model->state_id = $this->state_id;
        $this->cities_model->cities_id = $this->cities_id;
      
       
      
    }
}
