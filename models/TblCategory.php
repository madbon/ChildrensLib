<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_category".
 *
 * @property integer $CATEGORY_ID
 * @property string $CATEGORY_TITLE
 * @property string $CATEGORY_IMAGE
 * @property string $CATEGORY_DESCRIPTION
 * @property integer $IS_ACTIVE
 *
 * @property TblBookCover[] $tblBookCovers
 * @property TblCategoryContent[] $tblCategoryContents
 */
class TblCategory extends \yii\db\ActiveRecord
{

    public $id;
    public $title;
    public $image;
    public $description;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_TITLE'], 'required'],
            [['CATEGORY_TITLE'], 'unique'],
            [['CATEGORY_DESCRIPTION'], 'string'],
            [['CATEGORY_TITLE'], 'string', 'max' => 50],
            [['CATEGORY_IMAGE'], 'string', 'max' => 100],
        ];
    }   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [    
            'CATEGORY_ID' => 'Category  ID',
            'CATEGORY_TITLE' => 'Category  Title',
            'CATEGORY_IMAGE' => 'Category  Image',
            'CATEGORY_DESCRIPTION' => 'Category  Description',
            
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update-image'] = ['image'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookCovers()
    {
        return $this->hasMany(TblBookCover::className(), ['CATEGORY_ID' => 'CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCategoryContents()
    {
        return $this->hasMany(TblCategoryContent::className(), ['CATEGORY_ID' => 'CATEGORY_ID']);
    }

    

}
