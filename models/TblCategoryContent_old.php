<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_category_content".
 *
 * @property integer $CATEGORYCONTENT_ID
 * @property integer $CATEGORY_ID
 * @property string $CATEGORYCONTENT_NAME
 * @property string $CATEGORYCONTENT_IMAGE
 * @property integer $IS_ACTIVE
 *
 * @property TblBookCover $cATEGORYCONTENT
 * @property TblCategory $cATEGORY
 */
class TblCategoryContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID', 'CATEGORYCONTENT_NAME'], 'required'],
            [['CATEGORY_ID'], 'integer'],
            [['CATEGORYCONTENT_NAME'], 'string', 'max' => 100],
            // [['CATEGORYCONTENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblBookCover::className(), 'targetAttribute' => ['CATEGORYCONTENT_ID' => 'CATEGORYCONTENT_ID']],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CATEGORYCONTENT_ID' => 'Categorycontent  ID',
            'CATEGORY_ID' => 'Category  ID',
            'CATEGORYCONTENT_NAME' => 'Categorycontent  Name',
            'CATEGORYCONTENT_IMAGE' => 'Categorycontent  Image',
            'IS_ACTIVE' => 'Is  Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORYCONTENT()
    {
        return $this->hasOne(TblBookCover::className(), ['CATEGORYCONTENT_ID' => 'CATEGORYCONTENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TblCategory::className(), ['CATEGORY_ID' => 'CATEGORY_ID']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update-image'] = ['image'];
        return $scenarios;
    }
}
