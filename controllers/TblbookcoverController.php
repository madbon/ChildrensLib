<?php

namespace app\controllers;


use Yii;
use app\models\TblBookCover;
use app\models\TblbookcoverSearch;
use app\models\TblCategory;
use app\models\TblCategoryContent;
use app\models\TblLanguage;
use app\models\TblColor;
use app\models\TblBookContent;
use app\models\BookcontentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;   
use yii\web\UploadedFile; 
use yii\data\ActiveDataProvider;


/**
 * TblbookcoverController implements the CRUD actions for TblBookCover model.
 */
class TblbookcoverController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblBookCover models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblbookcoverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // // // show data where IS_ACTIVE = 1
        // $query = TblbookcoverSearch::find()->andWhere([ 'IS_ACTIVE' => 1 ]);

        // //Pagination by 5 data
        // $dataProvider = new ActiveDataProvider([
        //             'query' => $query,
        //             'pagination' => [ 'pageSize' => 5 ],    // data rows to show
        //             'sort' => [                             // Sorting of data to Descending order
        //                 'defaultOrder' => [                
        //                     'BOOKCOVER_ID' => SORT_DESC,    // Sort by column_name BOOKCOVER_ID 
        //                 ],

        //             ],
        //         ]);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblBookCover model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         $searchModel = new BookcontentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = BookcontentSearch::find()->andWhere([ 'BOOKCOVER_ID' => $id ]);

        //Pagination by 5 data
        $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [ 'pageSize' => 5 ],    // data rows to show
                    'sort' => [                             // Sorting of data to Descending order
                        'defaultOrder' => [                
                            'BOOKCONTENT_ID' => SORT_ASC,    // Sort by column_name BOOKCOVER_ID 
                        ],

                    ],
                ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TblBookCover model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblBookCover();
    
        
        if ($model->load(Yii::$app->request->post())) {
           // save the tag value of description field
            $POST_VARIABLE=Yii::$app->request->post('TblBookCover');
            $request = $POST_VARIABLE['CATEGORYCONTENT_ID']; 
            $tags = implode(',', $request);
            $model->CATEGORYCONTENT_ID = $tags;
            // $model->save();

            $request2 = $POST_VARIABLE['COLOR_VALUE']; 
            $tags2 = implode(',', $request2);
            $model->COLOR_VALUE = $tags2;
            // $model->save();
            

            $image = UploadedFile::getInstance($model,'BOOKCOVER_IMAGE');
            $basepath = Yii::getAlias('@app');
            $imagepath= $basepath.'/web/upload_bookcover/';
            $rand_name=rand(10,100);

            if ($image)
            {
                $model->BOOKCOVER_IMAGE = "category_{$rand_name}-{$image}"; // change random name of image
            }

                if($model->save()):
                    if($image):
                     $image->saveAs($imagepath.$model->BOOKCOVER_IMAGE);
                    endif;
                endif;     

           return $this->redirect(['view', 'id'=>$model->BOOKCOVER_ID ]);
          
            
        } else {
            $query = new \yii\db\Query;
            $query->select('CATEGORY_ID, CATEGORY_TITLE')
            ->from('tbl_category');
            $command    = $query->createCommand();
            $rows       = $command->queryAll();
            $items      = ArrayHelper::map($rows, 'CATEGORY_ID', 'CATEGORY_TITLE');

            $query1 = new \yii\db\Query;
            $query1->select('COLOR_ID, COLOR_NAME')
            ->from('tbl_color');
            $command1   = $query1->createCommand();
            $rows1      = $command1->queryAll();
            $colors     = ArrayHelper::map($rows1, 'COLOR_ID', 'COLOR_NAME');

            $query2 = new \yii\db\Query;
            $query2->select('LANGUAGE_ID, LANGUAGE')
            ->from('tbl_language');
            $command2   = $query2->createCommand();
            $rows2      = $command2->queryAll();
            $language     = ArrayHelper::map($rows2, 'LANGUAGE_ID', 'LANGUAGE');

            $query3 = new \yii\db\Query;
            $query3->select('CATEGORYCONTENT_ID, CATEGORYCONTENT_NAME')
            ->from('tbl_category_content');
            $command3   = $query3->createCommand();
            $rows3      = $command3->queryAll();
            $catecontent     = ArrayHelper::map($rows3, 'CATEGORYCONTENT_ID', 'CATEGORYCONTENT_NAME');

           
          

            return $this->render('create', [
                'model' => $model,
                'items' =>  $items,
                'colors' => $colors,
                'language' => $language,
                'catecontent' => $catecontent,
                
                
            ]);
        }
    }


    // public function actionLists($id)
    // {


    // }

    /**
     * Updates an existing TblBookCover model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
            $query = new \yii\db\Query;
            $query->select('CATEGORY_ID, CATEGORY_TITLE')
            ->from('tbl_category');
            $command = $query->createCommand();
            $rows = $command->queryAll();
            $items = ArrayHelper::map($rows, 'CATEGORY_ID', 'CATEGORY_TITLE');

            // $query1 = new \yii\db\Query;
            // $query1->select('COLOR_ID, COLOR_NAME')
            // ->from('tbl_color');
            // $command1   = $query1->createCommand();
            // $rows1      = $command1->queryAll();
            // $colors     = ArrayHelper::map($rows1, 'COLOR_ID', 'COLOR_NAME');

            $query2 = new \yii\db\Query;
            $query2->select('LANGUAGE_ID, LANGUAGE')
            ->from('tbl_language');
            $command2   = $query2->createCommand();
            $rows2      = $command2->queryAll();
            $language     = ArrayHelper::map($rows2, 'LANGUAGE_ID', 'LANGUAGE');

            $query3 = new \yii\db\Query;
            $query3->select('CATEGORYCONTENT_ID, CATEGORYCONTENT_NAME')
            ->from('tbl_category_content');
            $command3   = $query3->createCommand();
            $rows3      = $command3->queryAll();
            $catecontent     = ArrayHelper::map($rows3, 'CATEGORYCONTENT_ID', 'CATEGORYCONTENT_NAME');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->BOOKCOVER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'items' =>  $items,
                // 'colors' => $colors,
                'language' => $language,
                'catecontent' => $catecontent,
            ]);
        }
    }

    public function actionUpdateColor($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update-color"; 
        $POST_VARIABLE=Yii::$app->request->post('TblBookCover');
        
            $query1 = new \yii\db\Query;
            $query1->select('COLOR_ID, COLOR_NAME')
            ->from('tbl_color');
            $command1   = $query1->createCommand();
            $rows1      = $command1->queryAll();
            $colors     = ArrayHelper::map($rows1, 'COLOR_ID', 'COLOR_NAME');  

            if(!empty($model))
            {
                $tags3 = explode(',', $model->COLOR_VALUE);
                $model->COLOR_VALUE = $tags3;
            }
            else
            {
                $tags3 = [''];
                $model->COLOR_VALUE = $tags3;
            }


        if ($model->load(Yii::$app->request->post())) {
            $request2 = $POST_VARIABLE['COLOR_VALUE']; 
            $tags2 = implode(',', $request2);
            $model->COLOR_VALUE = $tags2;
            $model->save();

            return $this->redirect(['view', 'id' => $model->BOOKCOVER_ID]);
        } else {
            return $this->render('update-color', [
                'model' => $model,
                'colors' => $colors,
                
            ]);
        }
    }

     public function actionUpdateTags($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update-tags"; 
        $POST_VARIABLE=Yii::$app->request->post('TblBookCover');
        
            $query1 = new \yii\db\Query;
            $query1->select('CATEGORYCONTENT_ID, CATEGORYCONTENT_NAME')
            ->from('tbl_category_content');
            $command1   = $query1->createCommand();
            $rows1      = $command1->queryAll();
            $colors     = ArrayHelper::map($rows1, 'CATEGORYCONTENT_ID', 'CATEGORYCONTENT_NAME');  

            if(!empty($model))
            {
                $tags3 = explode(',', $model->CATEGORYCONTENT_ID);
                $model->CATEGORYCONTENT_ID = $tags3;
            }
            else
            {
                $tags3 = [''];
                $model->CATEGORYCONTENT_ID = $tags3;
            }


        if ($model->load(Yii::$app->request->post())) {
            $request2 = $POST_VARIABLE['CATEGORYCONTENT_ID']; 
            $tags2 = implode(',', $request2);
            $model->CATEGORYCONTENT_ID = $tags2;
            $model->save();

            return $this->redirect(['view', 'id' => $model->BOOKCOVER_ID]);
        } else {
            return $this->render('update-tags', [
                'model' => $model,
                'colors' => $colors,
                
            ]);
        }
    }

  


    public function actionUpdateImage($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update-image";
         
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model,'BOOKCOVER_IMAGE');

            $basepath = Yii::getAlias('@app');
            $imagepath= $basepath.'/web/upload_bookcover/';

            $rand_name=rand(10,100);

            if ($image)
            {
                $model->BOOKCOVER_IMAGE = "category_{$rand_name}-{$image}"; // change random name of image
            }

                if($model->save()):
                    if($image):
                     $image->saveAs($imagepath.$model->BOOKCOVER_IMAGE);
                    endif;
                endif;             

            return $this->redirect(['update-image', 'id' => $model->BOOKCOVER_ID]);
        } else {
            return $this->render('update-image', [
                'model' => $model,
                
            ]);
        }
    }


    /**
     * Deletes an existing TblBookCover model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

     public function actionDeletePages($id)
    {
        // $this->findModel($id)->deleteAll();

        TblBookContent::deleteAll('BOOKCOVER_ID = "'.$id.'"');  

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblBookCover model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblBookCover the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblBookCover::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
