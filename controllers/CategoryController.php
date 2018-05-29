<?php

namespace app\controllers;

use Yii;
use app\models\TblCategory;
use app\models\CategorySearch;
use app\models\TblCategoryContent;
use app\models\CategorycontentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile; 

/**
 * CategoryController implements the CRUD actions for TblCategory model.
 */
class CategoryController extends Controller
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
     * Lists all TblCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new CategorycontentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = CategorycontentSearch::find()->andWhere([ 'CATEGORY_ID' => $id ]);

        //Pagination by 5 data
        $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [ 'pageSize' => 10 ],    // data rows to show
                    'sort' => [                             // Sorting of data to Descending order
                        'defaultOrder' => [                
                            'CATEGORYCONTENT_ID' => SORT_DESC,    // Sort by column_name BOOKCOVER_ID 
                        ],

                    ],
                ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   

    public function actionUpdateImage($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update-image";
         
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $image = UploadedFile::getInstance($model,'CATEGORY_IMAGE');
                $basepath = Yii::getAlias('@app');
                $imagepath= $basepath.'/web/upload_categoryimages/';
                $rand_name=rand(10,100);

                if ($image)
                {
                    $model->CATEGORY_IMAGE = "category_{$rand_name}-{$image}"; // change random name of image
                }

                    if($model->save()):
                        if($image):
                         $image->saveAs($imagepath.$model->CATEGORY_IMAGE);
                        endif;
                    endif; 

            return $this->redirect(['view', 'id' => $model->CATEGORY_ID]);
        } else {
            return $this->render('update-image', [
                'model' => $model,
                
            ]);
        }
    }

    /**
     * Creates a new TblCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblCategory();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $image = UploadedFile::getInstance($model,'CATEGORY_IMAGE');
                $basepath = Yii::getAlias('@app');
                $imagepath= $basepath.'/web/upload_categoryimages/';
                $rand_name=rand(10,100);

                if ($image)
                {
                    $model->CATEGORY_IMAGE = "category_{$rand_name}-{$image}"; // change random name of image
                }

                    if($model->save()):
                        if($image):
                         $image->saveAs($imagepath.$model->CATEGORY_IMAGE);
                        endif;
                    endif; 

            return $this->redirect(['view', 'id' => $model->CATEGORY_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CATEGORY_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblCategory model.
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
     * Finds the TblCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
