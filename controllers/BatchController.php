<?php

namespace app\controllers;

use Yii;
use app\models\TblBatch;
use app\models\BatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;   
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * BatchController implements the CRUD actions for TblBatch model.
 */
class BatchController extends Controller
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
     * Lists all TblBatch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblBatch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblBatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblBatch();

        if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $uploadExists = 0;
                if ($model->file)
                {
                    $imagepath = "upload_file/";
                    $model->FILE_IMPORT = $imagepath .rand(10,100).'-'.str_replace('','-',$model->file->name);

                    $bulkInsertArray = array();
                    $uploadExists = 1;
                }
                if($uploadExists){
                    $model->file->saveAs($model->FILE_IMPORT);

                    $handle = fopen($model->FILE_IMPORT,'r');

                    if($handle){
                       if($model->save()){
                        while ( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                            $bulkInsertArray[] = [
                                
                                'CATEGORY_ID' => isset($line[0]) ? $line[0] : null,
                                'CATEGORYCONTENT_ID' => isset($line[1]) ? $line[1] : null,
                                'COLOR_VALUE' => isset($line[2]) ? $line[2] : null,
                                'BOOK_TITLE' => isset($line[3]) ? $line[3] : null,
                                'BOOK_AUTHOR' => isset($line[4]) ? $line[4] : null,
                                'BOOK_ILLUSTRATOR' => isset($line[5]) ? $line[5] : null,
                                'BOOK_PUBLISHER' => isset($line[6]) ? $line[6] : null,
                                'BOOK_PUBLICATIONDATE' => isset($line[7]) ? $line[7] : null,
                                'LANGUAGE_ID' => isset($line[8]) ? $line[8] : null,
                                'BOOK_SUMMARY' => isset($line[9]) ? $line[9] : null,
                                'BOOK_DESCRIPTION' => isset($line[10]) ? $line[10] : null,
                                'BOOKCOUNT_PAGES' => isset($line[11]) ? $line[11] : null,
                                'ISBN' => isset($line[12]) ? $line[12] : null,
                                'LOCATION' => isset($line[13]) ? $line[13] : null,
                                'CODELIBRARY' => isset($line[14]) ? $line[14] : null,   


                            ];
                           
                        }
                       }
                       fclose($handle);

                       $tableName = "tbl_book_cover";
                       $columnNameArray = ['CATEGORY_ID','CATEGORYCONTENT_ID','COLOR_VALUE','BOOK_TITLE','BOOK_AUTHOR','BOOK_ILLUSTRATOR','BOOK_PUBLISHER','BOOK_PUBLICATIONDATE','LANGUAGE_ID','BOOK_SUMMARY','BOOK_DESCRIPTION','BOOKCOUNT_PAGES','ISBN','LOCATION','CODELIBRARY'];
                       Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                        // print_r($bulkInsertArray);
                    }
                }

               return $this->redirect(['view', 'id' => $model->BATCH_ID]);
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblBatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->BATCH_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblBatch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblBatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblBatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
