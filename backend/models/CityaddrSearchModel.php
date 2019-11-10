<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CityaddrModel;

/**
 * CityaddrSearchModel represents the model behind the search form of `common\models\CityaddrModel`.
 */
class CityaddrSearchModel extends CityaddrModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'country_id', 'city_id'], 'integer'],
            [['city_addr', 'city_addr_full'], 'safe'],
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
        $query = CityaddrModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'city_addr', $this->city_addr]);

        return $dataProvider;
    }
}
