<?php

namespace hellobyte\employee\controllers;

use Yii;
use hellobyte\employee\models\ECertificate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ECertifcateController implements the CRUD actions for ECertificate model.
 */
class ECertifcateController extends Controller
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
     * Lists all ECertificate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ECertificate::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ECertificate model.
     * @param string $degree
     * @param string $year
     * @param string $certificated_by
     * @return mixed
     */
    public function actionView($degree, $year, $certificated_by)
    {
        return $this->render('view', [
            'model' => $this->findModel($degree, $year, $certificated_by),
        ]);
    }

    /**
     * Creates a new ECertificate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ECertificate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'degree' => $model->degree, 'year' => $model->year, 'certificated_by' => $model->certificated_by]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ECertificate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $degree
     * @param string $year
     * @param string $certificated_by
     * @return mixed
     */
    public function actionUpdate($degree, $year, $certificated_by)
    {
        $model = $this->findModel($degree, $year, $certificated_by);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'degree' => $model->degree, 'year' => $model->year, 'certificated_by' => $model->certificated_by]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ECertificate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $degree
     * @param string $year
     * @param string $certificated_by
     * @return mixed
     */
    public function actionDelete($degree, $year, $certificated_by)
    {
        $this->findModel($degree, $year, $certificated_by)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ECertificate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $degree
     * @param string $year
     * @param string $certificated_by
     * @return ECertificate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($degree, $year, $certificated_by)
    {
        if (($model = ECertificate::findOne(['degree' => $degree, 'year' => $year, 'certificated_by' => $certificated_by])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
