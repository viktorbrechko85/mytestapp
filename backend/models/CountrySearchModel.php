<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CountryModel;

/**
 * CountrySearchModel represents the model behind the search form of `common\models\CountryModel`.
 */
class CountrySearchModel extends CountryModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_id'], 'integer'],
            [['c_code', 'c_name'], 'safe'],
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
        $query = CountryModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->pagination->pageSize = 10;    

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'c_id' => $this->c_id,
        ]);

        $query->andFilterWhere(['like', 'c_code', $this->c_code])
            ->andFilterWhere(['like', 'c_name', $this->c_name]);

        return $dataProvider;
    }
}
