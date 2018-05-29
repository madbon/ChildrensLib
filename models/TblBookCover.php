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
 * @property integer $LANGUAGE_ID
 * @property string $BOOK_SUMMARY
 * @property string $BOOK_DESCRIPTION
 * @property integer $BOOKCOUNT_PAGES
 * @property string $BOOKCOVER_IMAGE
 * @property integer $IS_ACTIVE
 *
 * @property TblBookContent[] $tblBookContents
 * @property TblCategory $cATEGORY
 * @property TblLanguage $lANGUAGE
 * @property TblCategoryContent $tblCategoryContent
 */
class TblBookCover extends \yii\db\ActiveRecord
{

    public $id;
    public $title;
    public $author;
    public $image;
    public $colorTag;
    public $categoryTag;


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
            [['CATEGORY_ID', 'CATEGORYCONTENT_ID', 'BOOK_TITLE'], 'required'],
            [['CATEGORY_ID', 'LANGUAGE_ID', 'BOOKCOUNT_PAGES', 'IS_ACTIVE'], 'integer'],
            [['BOOK_SUMMARY','BOOK_DESCRIPTION'], 'string'],
            [['BOOK_TITLE', 'BOOK_AUTHOR', 'BOOK_ILLUSTRATOR', 'BOOK_PUBLISHER', 'BOOKCOVER_IMAGE','ISBN','LOCATION','CODELIBRARY'], 'string', 'max' => 100],
            [['BOOK_PUBLICATIONDATE'], 'string', 'max' => 20],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblLanguage::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
            // [['COLOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TblColor::className(), 'targetAttribute' => ['COLOR_ID' => 'COLOR_ID']],
            [['BOOKCOVER_IMAGE'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['COLOR_VALUE'], 'required'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update-image'] = ['image'];

        $scenarios['update-color'] = ['COLOR_VALUE'];

        $scenarios['update-tags'] = ['CATEGORYCONTENT_ID'];
        return $scenarios;
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BOOKCOVER_ID' => 'Bookcover  ID',
            'CATEGORY_ID' => 'Category',
            'CATEGORYCONTENT_ID' => 'Subcategory',
            'COLOR_VALUE' => 'Color',
            'BOOK_TITLE' => 'Title',
            'BOOK_AUTHOR' => 'Author',
            'BOOK_ILLUSTRATOR' => 'Illustrator',
            'BOOK_PUBLISHER' => 'Publisher',
            'BOOK_PUBLICATIONDATE' => 'Publication Date',
            'LANGUAGE_ID' => 'Language',
            'BOOK_SUMMARY' => 'Summary',
            'BOOK_DESCRIPTION' => 'Description',
            // 'BOOK_TAGS' => 'Tags',
            'BOOKCOUNT_PAGES' => 'How many pages?',
            'BOOKCOVER_IMAGE' => 'Cover Image',
            'IS_ACTIVE' => 'Is  Active',
            'ISBN' => 'ISBN',
            'LOCATION' => 'LOCATION',
            'CODELIBRARY'=>'CODELIBRARY',
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
    public function getLanguage()
    {
        return $this->hasOne(TblLanguage::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
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
        return $this->hasOne(TblColor::className(), ['COLOR_ID' => 'COLOR_VALUE']);
    }
}
