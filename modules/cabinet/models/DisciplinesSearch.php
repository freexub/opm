<?php

namespace app\modules\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Disciplines;

/**
 * DisciplinesSearch represents the model behind the search form of `app\models\Disciplines`.
 */
class DisciplinesSearch extends Disciplines
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'op_id', 'credits', 'cycle_id', 'component_id','active'], 'integer'],
            [['name', 'obout', 'date_create', 'date_update'], 'safe'],
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
        $query = Disciplines::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'op_id' => $this->op_id,
            'credits' => $this->credits,
            'cycle_id' => $this->cycle_id,
            'component_id' => $this->component_id,
//            'code' => $this->code,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'obout', $this->obout]);

        return $dataProvider;
    }
}
