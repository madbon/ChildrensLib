<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_book_cover".
 *
 * @property integer $BOOKCOVER_ID
 * @property integer $CATEGORY_ID
 * @property integer $CATEGORYCONTENT_ID
 * @property integer $COLOR_ID
 * @property string $BOOK_TITLE
 * @property string $BOOK_AUTHOR
 * @property string $BOOK_ILLUSTRATOR
 * @property string $BOOK_PUBLISHER
 * @property string $BOOK_PUBLICATIONDATE
 * @property string $BOOK_LANGUAGE
 * @property string $BOOK_SUMMARY
 * @property string $BOOK_DESCRIPTION
 * @property integer $BOOKCOUNT_PAGES
 * @property string $BOOKCOVER_IMAGE
 * @property integer $IS_ACTIVE
 *
 * @property TblBookContent[] $tblBookContents
 * @property TblCategory $cATEGORY
 * @property TblCategoryContent $tblCategoryContent
 */
class TblBookCover extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_book_cover';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID', 'CATEGORYCONTENT_ID', 'BOOK_TITLE', 'BOOK_AUTHOR'], 'required'],
            [['CATEGORY_ID', 'CATEGORYCONTENT_ID', 'COLOR_ID', 'BOOKCOUNT_PAGES', 'IS_ACTIVE'], 'integer'],
            [['BOOK_SUMMARY', 'BOOK_DESCRIPTION'], 'string'],
            [['BOOK_TITLE', 'BOOK_AUTHOR', 'BOOK_ILLUSTRATOR', 'BOOK_PUBLISHER', 'BOOK_LANGUAGE', 'BOOKCOVER_IMAGE'], 'string', 'max' => 100],
            [['BOOK_PUBLICATIONDATE'], 'string', 'max' => 20],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_ID']],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_ID']],
            [['COLOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblColor::className(), 'targetAttribute' => ['COLOR_ID' => 'COLOR_ID']],
            [['BOOKCOVER_IMAGE'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update-image'] = ['image'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BOOKCOVER_ID' => 'Bookcover  ID',
            'CATEGORY_ID' => 'Category  ID',
            'CATEGORYCONTENT_ID' => 'Categorycontent  ID',
            'COLOR_ID' => 'Color  ID',
            'BOOK_TITLE' => 'Book  Title',
            'BOOK_AUTHOR' => 'Book  Author',
            'BOOK_ILLUSTRATOR' => 'Book  Illustrator',
            'BOOK_PUBLISHER' => 'Book  Publisher',
            'BOOK_PUBLICATIONDATE' => 'Book  Publicationdate',
            'BOOK_LANGUAGE' => 'Book  Language',
            'BOOK_SUMMARY' => 'Book  Summary',
            'BOOK_DESCRIPTION' => 'Book  Description',
            'BOOKCOUNT_PAGES' => 'Bookcount  Pages',
            'BOOKCOVER_IMAGE' => 'Bookcover  Image',
            'IS_ACTIVE' => 'Is  Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookContents()
    {
        return $this->hasMany(TblBookContent::className(), ['BOOKCOVER_ID' => 'BOOKCOVER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TblCategory::className(), ['CATEGORY_ID' => 'CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCategoryContent()
    {
        return $this->hasOne(TblCategoryContent::className(), ['CATEGORYCONTENT_ID' => 'CATEGORYCONTENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(TblColor::className(), ['COLOR_ID' => 'COLOR_ID']);
    }
}
