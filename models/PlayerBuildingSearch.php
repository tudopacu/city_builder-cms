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
    public $player_username;
    public $building_name;
    public $map_name;
    public $building_level;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'player_id', 'building_id', 'map_id', 'building_level_id', 'x', 'y', 'created_at', 'updated_at'], 'integer'],
            [['created_at_range', 'updated_at_range', 'player_username', 'building_name', 'map_name', 'building_level'], 'safe'],
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

        $query->joinWith(['player']);
        $query->joinWith(['building']);
        $query->joinWith(['map']);
        $query->joinWith(['buildingLevel']);

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

        $query->andFilterWhere(['like', 'players.username', $this->player_username]);
        $query->andFilterWhere(['like', 'buildings.name', $this->building_name]);
        $query->andFilterWhere(['like', 'maps.name', $this->map_name]);
        $query->andFilterWhere(['like', 'building_levels.level', $this->building_level]);

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
            'player_buildings.id' => $this->id,
            'player_buildings.x' => $this->x,
            'player_buildings.y' => $this->y,
        ]);

        $dataProvider->sort->attributes['player_username'] = [
            'asc' => ['players.username' => SORT_ASC],
            'desc' => ['players.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['building_name'] = [
            'asc' => ['buildings.name' => SORT_ASC],
            'desc' => ['buildings.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['map_name'] = [
            'asc' => ['maps.name' => SORT_ASC],
            'desc' => ['maps.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['building_level'] = [
            'asc' => ['building_levels.level' => SORT_ASC],
            'desc' => ['building_levels.level' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
