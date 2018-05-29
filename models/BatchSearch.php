<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBatch;

/**
 * BatchSearch represents the model behind the search form about `app\models\TblBatch`.
 */
class BatchSearch extends TblBatch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BATCH_ID'], 'integer'],
            [['BATCH', 'FILE_IMPORT'], 'safe'],
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
        $query = TblBatch::find();

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
            'BATCH_ID' => $this->BATCH_ID,
        ]);

        $query->andFilterWhere(['like', 'BATCH', $this->BATCH])
            ->andFilterWhere(['like', 'FILE_IMPORT', $this->FILE_IMPORT]);

        return $dataProvider;
    }
}
