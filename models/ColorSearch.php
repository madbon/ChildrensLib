<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblColor;

/**
 * ColorSearch represents the model behind the search form about `app\models\TblColor`.
 */
class ColorSearch extends TblColor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COLOR_ID', 'IS_ACTIVE'], 'integer'],
            [['COLOR_NAME','COLOR_VALUE'], 'safe'],
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
        $query = TblColor::find()->orderBy(['COLOR_NAME' =>SORT_ASC]);

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
            'COLOR_ID' => $this->COLOR_ID,
            'IS_ACTIVE' => $this->IS_ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'COLOR_NAME', $this->COLOR_NAME]);

        return $dataProvider;
    }
}
