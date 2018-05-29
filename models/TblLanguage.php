<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_language".
 *
 * @property integer $LANGUAGE_ID
 * @property string $LANGUAGE
 */
class TblLanguage extends \yii\db\ActiveRecord
{
    public $id;
    public $language;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE'], 'required'],
            [['LANGUAGE'], 'unique'],
            [['LANGUAGE'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LANGUAGE_ID' => 'Language  ID',
            'LANGUAGE' => 'Language',
        ];
    }
}
