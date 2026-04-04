<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * IntersectionSearch represents the model behind the search form of `app\models\Intersection`.
 */
class IntersectionSearch extends Intersection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'map_id', 'player_id', 'x', 'y'], 'integer'],
            [['type', 'created_at_range', 'updated_at_range'], 'safe'],
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
        $query = Intersection::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'map_id' => $this->map_id,
            'player_id' => $this->player_id,
            'x' => $this->x,
            'y' => $this->y,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);

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
