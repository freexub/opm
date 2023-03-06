<?php

namespace app\modules\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LearningOutcome;

/**
 * LearningOutcomeSearch represents the model behind the search form of `app\models\LearningOutcome`.
 */
class LearningOutcomeSearch extends LearningOutcome
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'autor', 'active', 'op_id'], 'integer'],
            [['name', 'date_create', 'date_update'], 'safe'],
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
        $query = LearningOutcome::find();

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
            'autor' => $this->autor,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'active' => $this->active,
            'op_id' => $this->op_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
