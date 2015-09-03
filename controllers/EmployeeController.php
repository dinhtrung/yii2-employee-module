<?php

namespace hellobyte\employee\controllers;

use Yii;
use hellobyte\employee\models\Employee;
use hellobyte\employee\search\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use hellobyte\employee\models\ECertificate;
use hellobyte\employee\models\hellobyte\employee\models;
use yii\helpers\VarDumper;
use yii\data\yii\data;
use yii\web\UploadedFile;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        		'certs' => new ActiveDataProvider(['query' => $model->getECertificates()]),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $cert = new ECertificate();

        if ($model->load(Yii::$app->request->post())) {
        	// Handle file upload & save
        	$model->photoFile = UploadedFile::getInstance($model, 'photoFile');
        	if ($model->save()){
	        	foreach (Yii::$app->request->post('ECertificate') as $k => $v){
	        		$m = new ECertificate();
	        		$m->e_id = $model->id;
	        		$m->setAttributes($v);
	        		if (!$m->save()){
	        			foreach ($m->getErrors() as $f => $msg){
	        				Yii::$app->getSession()->addFlash('warning', implode(', ', $msg));
	        			}
	        		}
	        	}
	        	Yii::$app->getSession()->addFlash('success', Yii::t('hellobyte', 'Successfully create info for {name}', ['name' => $model->name]));
        	} else {
	        	Yii::$app->getSession()->addFlash('error', Yii::t('hellobyte', 'Error create employee {name}', ['name' => $model->name]));
        	}

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'cert' => $cert
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cert = new ECertificate();

        if ($model->load(Yii::$app->request->post())) {
        	// Handle file upload & save
        	$model->photoFile = UploadedFile::getInstance($model, 'photoFile');
        	if ($model->save()){
	        	// Handle certificates
	        	ECertificate::deleteAll(['e_id' => $model->id]);
	        	foreach (Yii::$app->request->post('ECertificate') as $k => $v){
	        		if (!$v['degree']) continue;
	        		$m = new ECertificate();
	        		$m->e_id = $model->id;
	        		$m->setAttributes($v);
	        		if (!$m->save()){
	        			foreach ($m->getErrors() as $f => $msg){
	        				Yii::$app->getSession()->addFlash('warning', implode(', ', $msg));
	        			}
	        		}
	        	}
        		Yii::$app->getSession()->addFlash('success', Yii::t('hellobyte', 'Successfully update info for {name}', ['name' => $model->name]));
        	} else {
        		Yii::$app->getSession()->addFlash('error', Yii::t('hellobyte', 'Error update info for {name}', ['name' => $model->name]));
        	}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            		'cert' => $cert,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
