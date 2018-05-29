<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_batch".
 *
 * @property integer $BATCH_ID
 * @property string $BATCH
 * @property string $FILE
 */
class TblBatch extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_batch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BATCH'], 'required'],
            [['BATCH'], 'string', 'max' => 100],
            [['FILE_IMPORT'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BATCH_ID' => 'Batch  ID',
            'BATCH' => 'Batch',
            'FILE_IMPORT' => 'File',
        ];
    }
}
