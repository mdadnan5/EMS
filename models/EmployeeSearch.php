<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends employee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'salary'], 'integer'],
            [['name', 'dob', 'gender', 'btech', 'bca', 'mtech', 'mca', 'hobbies', 'resume','state_id', 'cities_id', 'dept_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = employee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize'=>5
            ],
            // 'sort'=>[
            //     'attributes'=>['name','salary'],
            //     'defaultOrder'=>['name'=>SORT_DESC,'salary'=>SORT_ASC]
            // ],
            'sort'=>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dob' => $this->dob,
            'salary' => $this->salary,
            'state_id' => $this->state_id,
            'cities_id' => $this->cities_id,
            'dept_id' => $this->dept_id,
            
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'btech', $this->btech])
            ->andFilterWhere(['like', 'bca', $this->bca])
            ->andFilterWhere(['like', 'mtech', $this->mtech])
            ->andFilterWhere(['like', 'mca', $this->mtech])
            ->andFilterWhere(['like', 'hobbies', $this->hobbies])
            ->andFilterWhere(['like', 'resume', $this->resume]);
            
        return $dataProvider;
    }
}
