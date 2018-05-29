<?php

namespace app\controllers;

use Yii;
use app\models\TblCategoryContent;
use app\models\CategorycontentSearch;
use app\models\TblCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile; 


/**
 * CategorycontentController implements the CRUD actions for TblCategoryContent model.
 */
class CategorycontentController extends Controller
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
     * Lists all TblCategoryContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorycontentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

       public function actionLists($id)
    {
        $countCategory = TblCategoryContent::find()
                ->where(['CATEGORY_ID' => $id])
                ->count();

        $category = TblCategoryContent::find()
                ->where(['CATEGORY_ID' => $id])
                ->all();

        if($countCategory > 0)
        {
            foreach($category as $categ){
                echo "<option value='".$categ->CATEGORYCONTENT_ID."'>".$categ->CATEGORYCONTENT_NAME."</option>";
            }
        }
        else
        {
            echo "<option> - </option>";
        }
    }

    /**
     * Displays a single TblCategoryContent model.
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
     * Creates a new TblCategoryContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblCategoryContent();

            $query = new \yii\db\Query;
            $query->select('CATEGORY_ID, CATEGORY_TITLE')
            ->from('tbl_category');
            $command    = $query->createCommand();
            $rows       = $command->queryAll();
            $category      = ArrayHelper::map($rows, 'CATEGORY_ID', 'CATEGORY_TITLE');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $image = UploadedFile::getInstance($model,'CATEGORYCONTENT_IMAGE');
                $basepath = Yii::getAlias('@app');
                $imagepath= $basepath.'/web/upload_categorycontentimages/';
                $rand_name=rand(10,100);

                if ($image)
                {
                    $model->CATEGORYCONTENT_IMAGE = "categorycontent_{$rand_name}-{$image}"; // change random name of image
                }

                    if($model->save()):
                        if($image):
                         $image->saveAs($imagepath.$model->CATEGORYCONTENT_IMAGE);
                        endif;
                    endif; 

            return $this->redirect(['view', 'id' => $model->CATEGORYCONTENT_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => $category,
            ]);
        }
    }

    /**
     * Updates an existing TblCategoryContent model.
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
            $command    = $query->createCommand();
            $rows       = $command->queryAll();
            $category      = ArrayHelper::map($rows, 'CATEGORY_ID', 'CATEGORY_TITLE');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CATEGORYCONTENT_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category' => $category,
            ]);
        }
    }

     

    public function actionUpdateImage($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update-image";
           

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $image = UploadedFile::getInstance($model,'CATEGORYCONTENT_IMAGE');
                $basepath = Yii::getAlias('@app');
                $imagepath= $basepath.'/web/upload_categorycontentimages/';
                $rand_name=rand(10,100);

                if ($image)
                {
                    $model->CATEGORYCONTENT_IMAGE = "categorycontent_{$rand_name}-{$image}"; // change random name of image
                }

                    if($model->save()):
                        if($image):
                         $image->saveAs($imagepath.$model->CATEGORYCONTENT_IMAGE);
                        endif;
                    endif; 

            return $this->redirect(['view', 'id' => $model->CATEGORYCONTENT_ID]);
        } else {
            return $this->render('update-image', [
                'model' => $model,
                
            ]);
        }
    }



    /**
     * Deletes an existing TblCategoryContent model.
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
     * Finds the TblCategoryContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCategoryContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCategoryContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
