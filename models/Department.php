<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $state_id
 * @property string $cities_id
 * @property string $name
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_id', 'cities_id', 'name'], 'required'],
            [['state_id', 'cities_id', 'name'], 'string', 'max' => 50],
            // ['name', 'unique']
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

    public function getCity(){
        return $this->hasOne(Cities::className(), ['id' => 'cities_id']);
    }

    
}
