<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_color".
 *
 * @property integer $COLOR_ID
 * @property integer $COLOR_NAME
 * @property integer $IS_ACTIVE
 *
 * @property TblBookCover[] $tblBookCovers
 */
class TblColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COLOR_NAME'], 'required'],
            [['COLOR_ID',  'IS_ACTIVE'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COLOR_ID' => 'Color  ID',
            'COLOR_NAME' => 'Color  Name',
            // 'IS_ACTIVE' => 'Is  Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookCovers()
    {
        return $this->hasMany(TblBookCover::className(), ['COLOR_ID' => 'COLOR_ID']);
    }
}
