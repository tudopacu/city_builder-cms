<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RoadSearch represents the model behind the search form of `app\models\Road`.
 */
class RoadSearch extends Road
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'start_intersection_id', 'end_intersection_id', 'road_type_id'], 'integer'],
            [['created_at_range', 'updated_at_range'], 'safe'],
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
        $query = Road::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start_intersection_id' => $this->start_intersection_id,
            'end_intersection_id' => $this->end_intersection_id,
            'road_type_id' => $this->road_type_id,
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

        return $dataProvider;
    }
}
