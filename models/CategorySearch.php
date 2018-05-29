<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblCategory;

/**
 * CategorySearch represents the model behind the search form about `app\models\TblCategory`.
 */
class CategorySearch extends TblCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID'], 'integer'],
            [['CATEGORY_TITLE', 'CATEGORY_IMAGE', 'CATEGORY_DESCRIPTION'], 'safe'],
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
        $query = TblCategory::find()->orderBy(['CATEGORY_TITLE' =>SORT_ASC]);

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
            'CATEGORY_ID' => $this->CATEGORY_ID,
            'IS_ACTIVE' => $this->IS_ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'CATEGORY_TITLE', $this->CATEGORY_TITLE])
            ->andFilterWhere(['like', 'CATEGORY_IMAGE', $this->CATEGORY_IMAGE])
            ->andFilterWhere(['like', 'CATEGORY_DESCRIPTION', $this->CATEGORY_DESCRIPTION]);

        return $dataProvider;
    }
}
