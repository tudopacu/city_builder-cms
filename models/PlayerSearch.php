<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Player;

/**
 * PlayerSearch represents the model behind the search form of `app\models\Player`.
 */
class PlayerSearch extends Player
{
    public $last_login_at_range;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'email', 'password', 'created_at', 'last_login_at', 'status', 'last_login_at_range', 'created_at_range'], 'safe'],
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
        $query = Player::find();

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
            'created_at' => $this->created_at,
            'last_login_at' => $this->last_login_at,
        ]);

        if (!empty($this->created_at_range)) {
            [$start, $end] = explode(' - ', $this->created_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }

        if (!empty($this->last_login_at_range)) {
            [$start, $end] = explode(' - ', $this->last_login_at_range);
            $start = date('Y-m-d H:i:s', strtotime($start));
            $end   = date('Y-m-d H:i:s', strtotime($end));
            $query->andFilterWhere(['between', 'last_login_at', $start, $end]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
