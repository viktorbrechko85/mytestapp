<?php

namespace backend\controllers;

use Yii;
use backend\models\CitySearchModel;
use common\models\{CityModel, CountryModel};
use yii\web\{Controller, NotFoundHttpException};
use yii\filters\{VerbFilter, AccessControl};
use yii\helpers\Json;

/**
 * CityController implements the CRUD actions for CityModel model.
 */
class CityController extends Controller
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
                        'actions' => ['index', 'lists', 'create'],
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
     * Lists all CityModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CitySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrCountry'=>$arrCountry
        ]);
    }

    
    /**
     * Creates a new CityModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CityModel();

        $counties = CountryModel::find()->orderby('c_name')->all();
        foreach($counties as $country){
            $arrCountry[$country->c_id] = $country->c_name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->city_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'arrCountry'=>$arrCountry,
        ]);
    }

    /**
     * Updates an existing CityModel model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->city_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'arrCountry'=>$arrCountry
        ]);
    }
    public function actionLists($id){
        $countCities = CityModel::find()
                    ->where(['country_id'=>$id])
                    ->count();
        $cities = CityModel::find()
                    ->where(['country_id'=>$id])
                    ->orderby('city_name')
                    ->all();
        if(count($cities)>0){
            echo "<option>Выбрать город...</option>";
            foreach($cities as $city){
                echo "<option value='".$city->city_id."'>".$city->city_name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }
    
    /**
     * Deletes an existing CityModel model.
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
     * Finds the CityModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CityModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CityModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
