<?php

namespace app\controllers;
use app\models\states;
use app\models\Cities;
use app\models\Department;
use app\models\DepartmentSearch;
use app\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        // return $this->render('index');
    }

    public function actionLists($id)
    { 
        
        // $citieslist= Cities::findBySql('select * from cities where state_id1="'.$id. '"')->all();
        $citieslist= Cities::find()->where(['state_id'=>$id])->all();
      
        if(count($citieslist)>0){
            $response = '<option value="">--Select City--</option>';
        foreach($citieslist as $city){
            $response .= '<option value="'.$city->id.'"> '.$city->name .'</option>';
        }
        return $response;
        } 
        return;
    }

    // public function actionLists($id)
    // {
    //     $countCities = Cities::find()
    //     ->where(['state_id' => $id])
    //     ->count();


    //     $cities =Cities::find()
    //     ->where(['state_id' => $id])
    //     ->all();

    //     if($countcities > 0 ){
    //         foreach($cities as $citie){
    //             echo "<option value='"$citie->citie_id"'>"$citie-> name "</option>";
    //         }
    //     }
    //     else{
    //         echo "<option> - </option>";
    //     }
    // }

    /**
     * Displays a single Department model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if ($id != null) {
            $department_model = $this->findModel($id);
            $model = new \app\models\form\DepartmentForm($department_model);
        } else {
            $model = new \app\models\form\DepartmentForm();
        }
        $model = new Department();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->save();

                Yii::$app->session->setFlash('success', "Created Department successfully."); 
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $model->save();


            Yii::$app->session->setFlash('success', "Department updated successfully."); 
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Employee::deleteAll(['dept_id'=>$id]);

        Yii::$app->session->setFlash('danger', "Delete departrment successfully."); 
        return $this->redirect(['index']);
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
