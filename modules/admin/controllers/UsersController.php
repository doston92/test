<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\models\Users;
use app\modules\models\UsersSearch;
use app\components\BoshqaController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BoshqaController
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if (\yii\web\UploadedFile::getInstance($model,'image')) {
                 $vaqt = date('Y-d-H-m-i');
                    $model->image = \yii\web\UploadedFile::getInstance($model,'image');
                    $model->image->saveAs('papka/usersss/'.$vaqt.'.'.$model->image->extension);
                    $image = 'papka/usersss/'.$vaqt.'.'.$model->image->extension;
                    $model->image = $image;
                    $model->save();
                }            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if (\yii\web\UploadedFile::getInstance($model,'image')) {
                 $vaqt = date('Y-d-H-m-i');
                    if(isset($model->image) && $model->image !=''){
                        $massiv = explode('/', $model->image);
                        if(is_dir('papka')){
                            chdir('papka');
                        }
                        if(is_dir('usersss')){
                            chdir('usersss');
                        }
                        if(is_file($massiv[2])){
                            unlink($massiv[2]);
                        }
                    }
                    $model->image = \yii\web\UploadedFile::getInstance($model,'image');
                    $model->image->saveAs('papka/usersss/'.$vaqt.'.'.$model->image->extension);
                    $image = 'papka/usersss/'.$vaqt.'.'.$model->image->extension;
                    $model->image = $image;
                    $model->save();
                }else{
                    $model->image = (isset($_POST['imagess'])) ? $_POST['imagess'] : $model->image;
                    $model->save(); 
                }            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                        ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(isset($this->findModel($id)->image) && $this->findModel($id)->image !=""){
            $massiv = explode('/', $this->findModel($id)->image);
            if(is_dir('papka'))
                chdir('papka');
            if(is_dir('usersss'))
                chdir('usersss');
            if(is_file($massiv[2]))
                unlink($massiv[2]);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionFaollashtir($id){
        $article = Users::findOne($id);
        $article->status = ($article->status=='faol') ? 'nofaol' : 'faol';
        $article->save();
        return $this->redirect('index');
    }
}
