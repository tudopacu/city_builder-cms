<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Age;

/**
 * AgeSearch represents the model behind the search form of `app\models\Age`.
 */
class AgeSearch extends Age
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort_order'], 'integer'],
            [['name', 'period', 'description', 'created_at_range', 'updated_at_range'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Age::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sort_order' => SORT_ASC, 'id' => SORT_ASC]],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sort_order' => $this->sort_order,
        ]);

        if (!empty($this->created_at_range) && strpos($this->created_at_range, ' - ') !== false) {
            [$start, $end] = explode(' - ', $this->created_at_range, 2);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }

        if (!empty($this->updated_at_range) && strpos($this->updated_at_range, ' - ') !== false) {
            [$start, $end] = explode(' - ', $this->updated_at_range, 2);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'updated_at', $start, $end]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'period', $this->period])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
