<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Terrain;

/**
 * TerrainSearch represents the model behind the search form of `app\models\Terrain`.
 */
class TerrainSearch extends Terrain
{
    public $tile_type;
    public $map_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'map_id', 'tile_id', 'x', 'y', 'created_at', 'updated_at'], 'integer'],
            [['created_at_range', 'updated_at_range', 'tile_type', 'map_name'], 'safe'],
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
        $query = Terrain::find();

        $query->joinWith(['tile']);
        $query->joinWith(['map']);

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

        $query->andFilterWhere(['like', 'tiles.type', $this->tile_type]);
        $query->andFilterWhere(['like', 'maps.name', $this->map_name]);

        // grid filtering conditions
        $query->andFilterWhere([
            'terrains.id' => $this->id,
            'terrains.x' => $this->x,
            'terrains.y' => $this->y,
        ]);

        if (!empty($this->created_at_range)) {
            [$start, $end] = explode(' - ', $this->created_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'terrains.created_at', $start, $end]);
        }

        if (!empty($this->updated_at_range)) {
            [$start, $end] = explode(' - ', $this->updated_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'terrains.updated_at', $start, $end]);
        }

        $dataProvider->sort->attributes['tile_type'] = [
            'asc' => ['tiles.type' => SORT_ASC],
            'desc' => ['tiles.type' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['map_name'] = [
            'asc' => ['maps.name' => SORT_ASC],
            'desc' => ['maps.name' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
