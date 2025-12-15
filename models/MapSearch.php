<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Map;

/**
 * MapSearch represents the model behind the search form of `app\models\Map`.
 */
class MapSearch extends Map
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'width', 'length', 'created_at', 'updated_at'], 'integer'],
            [['name', 'created_at_range', 'updated_at_range'], 'safe'],
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
        $query = Map::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'width' => $this->width,
            'length' => $this->length,
        ]);

        if (!empty($this->created_at_range)) {
            [$start, $end] = explode(' - ', $this->created_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }

        if (!empty($this->updated_at_range)) {
            [$start, $end] = explode(' - ', $this->updated_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'updated_at', $start, $end]);
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
