<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_book_content".
 *
 * @property integer $BOOKCONTENT_ID
 * @property integer $BOOKCOVER_ID
 * @property string $BOOKPAGES_IMAGE
 * @property integer $IS_ACTIVE
 *
 * @property TblBookCover $bOOKCOVER
 */
class TblBookContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_book_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {   
        return [
            [['BOOKCOVER_ID', 'BOOKPAGES_IMAGE'], 'required'],
            [['BOOKCOVER_ID'], 'integer'],
            [['BOOKPAGES_IMAGE'], 'file', 'extensions' => 'png,jpg','maxFiles'=>0,'skipOnEmpty'=>false],
            // [['BOOKCOVER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblBookCover::className(), 'targetAttribute' => ['BOOKCOVER_ID' => 'BOOKCOVER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BOOKCONTENT_ID' => 'Book Page  ID',
            'BOOKCOVER_ID' => 'Book Title',
            'BOOKPAGES_IMAGE' => 'Book Page Images',
            'IS_ACTIVE' => 'Is  Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookcover()
    {
        return $this->hasOne(TblBookCover::className(), ['BOOKCOVER_ID' => 'BOOKCOVER_ID']);
    }
}
