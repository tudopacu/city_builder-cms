<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlayerBuilding;

/**
 * PlayerBuildingSearch represents the model behind the search form of `app\models\PlayerBuilding`.
 */
class PlayerBuildingSearch extends PlayerBuilding
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'player_id', 'building_id', 'map_id', 'building_level_id', 'x', 'y', 'created_at', 'updated_at'], 'integer'],
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
        $query = PlayerBuilding::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->created_at_range)) {
            [$start, $end] = explode(' - ', $this->created_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'player_buildings.created_at', $start, $end]);
        }

        if (!empty($this->updated_at_range)) {
            [$start, $end] = explode(' - ', $this->updated_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'player_buildings.updated_at', $start, $end]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'building_level_id' => $this->building_level_id,
            'map_id' => $this->map_id,
            'building_id' => $this->building_id,
            'player_id' => $this->player_id,
        ]);


        return $dataProvider;
    }
}
