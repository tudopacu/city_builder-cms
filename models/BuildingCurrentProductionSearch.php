<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BuildingCurrentProductionSearch represents the model behind the search form of `app\models\BuildingCurrentProduction`.
 */
class BuildingCurrentProductionSearch extends BuildingCurrentProduction
{
    public $end_time_range;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'player_id', 'player_building_id', 'building_production_id'], 'integer'],
            [['end_time', 'status', 'created_at', 'updated_at', 'created_at_range', 'updated_at_range', 'end_time_range'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     * @param string|null $formName
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = BuildingCurrentProduction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'player_id' => $this->player_id,
            'player_building_id' => $this->player_building_id,
            'building_production_id' => $this->building_production_id,
            'status' => $this->status,
        ]);

        if (!empty($this->end_time_range)) {
            [$start, $end] = explode(' - ', $this->end_time_range);
            $query->andFilterWhere(['between', 'end_time', date('Y-m-d H:i:s', strtotime($start)), date('Y-m-d H:i:s', strtotime($end))]);
        }

        if (!empty($this->created_at_range)) {
            [$start, $end] = explode(' - ', $this->created_at_range);
            $query->andFilterWhere(['between', 'created_at', date('Y-m-d H:i:s', strtotime($start)), date('Y-m-d H:i:s', strtotime($end))]);
        }

        if (!empty($this->updated_at_range)) {
            [$start, $end] = explode(' - ', $this->updated_at_range);
            $query->andFilterWhere(['between', 'updated_at', date('Y-m-d H:i:s', strtotime($start)), date('Y-m-d H:i:s', strtotime($end))]);
        }

        return $dataProvider;
    }
}
