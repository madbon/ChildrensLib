<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblCategoryContent;

/**
 * CategorycontentSearch represents the model behind the search form about `app\models\TblCategoryContent`.
 */
class CategorycontentSearch extends TblCategoryContent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORYCONTENT_ID', 'CATEGORY_ID', 'IS_ACTIVE'], 'integer'],
            [['CATEGORYCONTENT_NAME', 'CATEGORYCONTENT_IMAGE'], 'safe'],
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
        $query = TblCategoryContent::find()->orderBy(['CATEGORYCONTENT_NAME' =>SORT_ASC]);

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
            'CATEGORYCONTENT_ID' => $this->CATEGORYCONTENT_ID,
            'CATEGORY_ID' => $this->CATEGORY_ID,
            'IS_ACTIVE' => $this->IS_ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'CATEGORYCONTENT_NAME', $this->CATEGORYCONTENT_NAME])
            ->andFilterWhere(['like', 'CATEGORYCONTENT_IMAGE', $this->CATEGORYCONTENT_IMAGE]);

        return $dataProvider;
    }
}
