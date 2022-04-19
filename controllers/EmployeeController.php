<?php

namespace app\controllers;

use app\models\Cities;
use app\models\Department;
use app\models\Employee;
use app\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * EmployeeController implements the CRUD actions for employee model.
 */
class EmployeeController extends Controller
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
     * Lists all employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLists($id)
    {

        // $citieslist= Cities::findBySql('select * from cities where state_id1="'.$id. '"')->all();
        $citieslist = Cities::find()->where(['state_id' => $id])->all();

        if (count($citieslist) > 0) {
            $response = '<option value="">--Select City--</option>';
            foreach ($citieslist as $city) {
                $response .= '<option value="' . $city->id . '"> ' . $city->name . '</option>';
            }
            return $response;
        }
        return;
    }

    public function actionDepartmentlists($id)
    {

        $departmentlist = Department::find()->where(['cities_id' => $id])->all();

        if (count($departmentlist) > 0) {
            $response = '<option value="">--Select Department--</option>';
            foreach ($departmentlist as $Department) {
                $response .= '<option value="' . $Department->id . '"> ' . $Department->name . '</option>';
            }
            return $response;
        }
        return;
    }


    /**
     * Displays a single employee model.
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
     * Creates a new employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if ($id != null) {
            $employee_model = $this->findModel($id);
            $model = new \app\models\form\EmployeeForm($employee_model);
        } else {
            $model = new \app\models\form\EmployeeForm();
        }
        $model = new employee();
        $model->scenario ="create";
        if ($this->request->isPost) {
        // if ($model->load($this->request->post())) {
        if ($model->load(Yii::$app->request->post())) {


            $model->resume_file = UploadedFile::getInstance($model,'resume_file');
            if( $model->validate()){
               
                if(!empty($model->resume_file)){
                    // $fileName = time().'.'.$model->resume_file->extension;
                    $fileName = $model->resume_file->name;
                    $filePath ='uploads/'.$fileName;
                
                    $model->resume_file->saveAs('uploads/'.$fileName);
                    $model->resume = $filePath;
                }
                
                $model->save();
                Yii::$app->session->setFlash('success', "User created successfully."); 
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        } else {
            // print_r($model->getErrors());
            // die();
            $model->loadDefaultValues();

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }






    
    // public function actionCreate($id = null)
    // {
    //     if ($id != null) {
    //         $employee_model = $this->findModel($id);
    //         $model = new \app\models\form\EmployeeForm($employee_model);
    //     } else {
    //         $model = new \app\models\form\EmployeeForm();
    //     }

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post())) {


    //             if ($model->validate()) {
    //                 if(!empty($model->resume_file)){
                        
    //                                     $fileName = $model->resume_file->name;
    //                                     $filePath ='uploads/'.$fileName;
    //                                     $model->resume_file->saveAs('uploads/'.$fileName);
    //                                     $model->resume = $filePath;
    //                                 }
    //                 $model->initializeForm();
    //                 if ($model->employee_model->save()) {
    //                     return $this->redirect(['index']);
    //                 }
    //             }
    //         }
    //     } else {
    //         $model->employee_model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario ="update";
        if ($model->load(Yii::$app->request->post()) ) {

            $model->resume_file = UploadedFile::getInstance($model, 'resume_file');
            // print_r($model->resume_file);
            // die();
            if( $model->validate()){
                if (!empty($model->resume_file)) {
                    // $fileName = time() . '.' . $model->resume_file->extension;
                    $fileName = $model->resume_file->name;
                    $filePath = 'uploads/' . $fileName;
                    $model->resume_file->saveAs('uploads/' . $fileName);
                    $model->resume = $filePath;
                }
    
                $model->save();
                Yii::$app->session->setFlash('success', "User updated successfully."); 
                return $this->redirect(['view', 'id' => $model->id]);
            }
           
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('danger', "User deleted successfully."); 
        return $this->redirect(['index']);
    }


    public function actionDownload($file_path)
    {

        if (!empty($file_path)) {
            $full_path = \Yii::$app->params['filelocation'] . '/' . $file_path;
            if (file_exists($full_path)) {
                return $this->response->sendFile($full_path);
            }
        }
        Yii::$app->session->setFlash('success', "File Download successfully."); 
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
