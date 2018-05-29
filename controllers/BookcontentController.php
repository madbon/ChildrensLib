<?php

namespace app\controllers;

use Yii;
use app\models\TblBookContent;
use app\models\TblBookCover;
use app\models\BookcontentSearch;
use app\models\TblbookcoverSearch;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;   
use yii\web\UploadedFile; 
use yii\data\ActiveDataProvider;
use yii\helpers\Url; //Class 'app\controllers\Url' not found

/**
 * BookcontentController implements the CRUD actions for TblBookContent model.
 */
class BookcontentController extends Controller
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
     * Lists all TblBookContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookcontentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblBookContent model.
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
     * Creates a new TblBookContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblBookContent();
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            return $this->redirect(['view', 'id' => $model->BOOKCONTENT_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
               
                
            ]);
        }
    }

    public function actionMultiple(){
        $searchModel = new TblbookcoverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

           $upload = new TblBookContent();
           $bookcover = TblBookCover::find()->where(['IS_ACTIVE'=>1])->all();

           if($upload->load(Yii::$app->request->post()))
           {
                $upload->BOOKPAGES_IMAGE = UploadedFile::getInstances($upload,'BOOKPAGES_IMAGE');
                if($upload->BOOKPAGES_IMAGE && $upload->validate())
                {
                   
                    $basepath = Yii::getAlias('@app');
                    $imagepath= $basepath.'/web/upload_bookcontentimages/';
                    
                    foreach ($upload->BOOKPAGES_IMAGE as $image) {
                        $model = new TblBookContent();
                        $model->BOOKCOVER_ID = $upload->BOOKCOVER_ID;
                        $rand_name=rand(10,100);
                        $model->BOOKPAGES_IMAGE = "bookpage_{$rand_name}-{$image}";

                        if($model->save(false))
                        {
                            $image->saveAs($imagepath.$model->BOOKPAGES_IMAGE);
                        }
                    }
                    return $this->redirect(['index']);

                }
           }

           return $this->render('multiple',['upload'=>$upload,
            'bookcover'=>ArrayHelper::map($bookcover,'BOOKCOVER_ID','BOOK_TITLE'),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);

    }

    // public function beforeAction($action) 
    // { 
    //     $this->enableCsrfValidation = false; 
    //     return parent::beforeAction($action); 
    // }

    /**
     * Updates an existing TblBookContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->BOOKCONTENT_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblBookContent model.
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
     * Finds the TblBookContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblBookContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblBookContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
