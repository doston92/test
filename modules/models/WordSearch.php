<?php

namespace app\modules\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\models\Word;

/**
 * WordSearch represents the model behind the search form about `app\modules\models\Word`.
 */
class WordSearch extends Word
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bal', 'view'], 'integer'],
            [['work', 'word', 'created_time', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Word::find();

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
            'bal' => $this->bal,
            'view' => $this->view,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'word', $this->word])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
