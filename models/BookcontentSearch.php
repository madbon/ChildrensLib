<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBookContent;

/**
 * BookcontentSearch represents the model behind the search form about `app\models\TblBookContent`.
 */
class BookcontentSearch extends TblBookContent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BOOKCONTENT_ID', 'BOOKCOVER_ID', 'IS_ACTIVE'], 'integer'],
            [['BOOKPAGES_IMAGE'], 'safe'],
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
        $query = TblBookContent::find();

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
            'BOOKCONTENT_ID' => $this->BOOKCONTENT_ID,
            'BOOKCOVER_ID' => $this->BOOKCOVER_ID,
            'IS_ACTIVE' => $this->IS_ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'BOOKPAGES_IMAGE', $this->BOOKPAGES_IMAGE]);

        return $dataProvider;
    }
}
