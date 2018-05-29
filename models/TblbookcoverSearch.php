<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBookCover;

/**
 * TblbookcoverSearch represents the model behind the search form about `app\models\TblBookCover`.
 */
class TblbookcoverSearch extends TblBookCover
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BOOKCOVER_ID', 'CATEGORY_ID', 'BOOKCOUNT_PAGES', 'IS_ACTIVE'], 'integer'],
            [['BOOK_TITLE', 'BOOK_AUTHOR','COLOR_VALUE', 'CATEGORYCONTENT_ID','BOOK_ILLUSTRATOR', 'BOOK_PUBLISHER', 'BOOK_LANGUAGE', 'BOOK_SUMMARY', 'BOOK_DESCRIPTION','ISBN','LOCATION','CODELIBRARY'], 'safe'],
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
        $query = TblBookCover::find()->orderBy(['BOOK_TITLE' =>SORT_ASC]);

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
            'BOOKCOVER_ID' => $this->BOOKCOVER_ID,
            'CATEGORY_ID' => $this->CATEGORY_ID,
            'CATEGORYCONTENT_ID' => $this->CATEGORYCONTENT_ID,
            'COLOR_VALUE' => $this->COLOR_VALUE,
            'BOOKCOUNT_PAGES' => $this->BOOKCOUNT_PAGES,
            'IS_ACTIVE' => $this->IS_ACTIVE,
            'ISBN' => $this->ISBN,
            'LOCATION' => $this->LOCATION,
            'CODELIBRARY' => $this->CODELIBRARY,
        ]);
        
        
        $query->joinWith('tblCategoryContent');
        $query->andFilterWhere(['like', 'BOOK_TITLE', $this->BOOK_TITLE])
            ->andFilterWhere(['like', 'BOOK_AUTHOR', $this->BOOK_AUTHOR])
            ->andFilterWhere(['like', 'BOOK_ILLUSTRATOR', $this->BOOK_ILLUSTRATOR])
            ->andFilterWhere(['like', 'BOOK_PUBLISHER', $this->BOOK_PUBLISHER])
            ->andFilterWhere(['like', 'BOOK_SUMMARY', $this->BOOK_SUMMARY])
            ->andFilterWhere(['like', 'BOOK_DESCRIPTION', $this->BOOK_DESCRIPTION]);

        return $dataProvider;
    }
}
