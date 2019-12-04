<?php

namespace backend\controllers;

use Yii;
use backend\models\CityaddrSearchModel;
use common\models\{CityaddrModel, CountryModel, CityModel };
use yii\web\{Controller, NotFoundHttpException} ;
use yii\filters\{VerbFilter, AccessControl};
use dosamigos\google\maps\LatLng;
use yii\helpers\Json;

/**
 * CityaddrController implements the CRUD actions for CityaddrModel model.
 */
class CityaddrController extends Controller
{
    /**
     * {@inheritdoc}
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'view'],
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all CityaddrModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CityaddrSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        $cities = CityModel::find()->orderby('city_name')->all();
        foreach($cities as $city){
            $arrCity[$city->city_id] = $city->city_name;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrCountry'=>$arrCountry,
            'arrCity'=>$arrCity,

        ]);
    }

    

    /**
     * Creates a new CityaddrModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CityaddrModel();

        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }
       // $address = "Ukraine, Mariupol";
       // $model->city_addr_full = $address;
        return $this->render('create', [
            'model' => $model,
            'arrCountry'=>$arrCountry,
            'arrCity'=>[],
            'address' => "Ukraine, Mariupol",
            'mapkey' => Yii::$app->params['googleMapKey'],  
        ]);
    }

    /**
     * Updates an existing CityaddrModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        $cities = CityModel::find()->where(['country_id'=>$model->country_id])->orderby('city_name')->all();
        foreach($cities as $city){
            $arrCity[$city->city_id] = $city->city_name;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->Id]);
        }

        $countr_name = CountryModel::findOne($model->country_id);
        $city_name = CityModel::findOne($model->city_id);
        $address = $countr_name->c_name.', '.$city_name->city_name.', '.$model->city_addr;

        $model->city_addr_full = $address;

        return $this->render('update', [
            'model' => $model,
            'arrCountry'=>$arrCountry,
            'arrCity'=>$arrCity,
            'address'=>$address,
            'mapkey' => Yii::$app->params['googleMapKey'],
        ]);
    }

    /**
     * Updates an existing CityaddrModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        $cities = CityModel::find()->where(['country_id'=>$model->country_id])->orderby('city_name')->all();
        foreach($cities as $city){
            $arrCity[$city->city_id] = $city->city_name;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        $countr_name = CountryModel::findOne($model->country_id);
        $city_name = CityModel::findOne($model->city_id);
        $address = $countr_name->c_name.', '.$city_name->city_name.', '.$model->city_addr;

        $model->city_addr_full = $address;

        return $this->render('view', [
            'model' => $model,
            'arrCountry'=>$arrCountry,
            'arrCity'=>$arrCity,
            'address'=>$address,
            'mapkey' => Yii::$app->params['googleMapKey'],
        ]);
    }
    

    /**
     * Deletes an existing CityaddrModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CityaddrModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CityaddrModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CityaddrModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
