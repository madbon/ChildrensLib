<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_color".
 *
 * @property integer $COLOR_ID
 * @property string $COLOR_NAME
 * @property string $COLOR_VALUE
 * @property integer $IS_ACTIVE
 */
class TblColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $id;
    public $name;
    public $value;


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
            [['COLOR_NAME'], 'unique'],
            [['IS_ACTIVE'], 'integer'],
            [['COLOR_NAME'], 'string', 'max' => 50],
            [['COLOR_VALUE'], 'string', 'max' => 50],
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
            'COLOR_VALUE' => 'HEX Value',
            'IS_ACTIVE' => 'Is  Active',
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookCovers()
    {
        return $this->hasMany(TblBookCover::className(), ['COLOR_VALUE' => 'COLOR_ID']);
    }
}
