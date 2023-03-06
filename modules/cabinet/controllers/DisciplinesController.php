<?php

namespace app\modules\cabinet\controllers;

use Yii;
use app\models\Disciplines;
use app\models\DisciplinesMatrix;
use app\modules\cabinet\models\DisciplinesSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplinesController implements the CRUD actions for Disciplines model.
 */
class DisciplinesController extends Controller
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
     * Lists all Disciplines models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DisciplinesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disciplines model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $disciplines = Disciplines::find()
            ->where([
                'op_id' => $model->op_id,
                'active' => 0
            ])
            ->andWhere([
                '!=',
                'id',
                $id
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $disciplines,
            'sort' => false,
        ]);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Disciplines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Disciplines();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionAddMatrix($id, $hid)
    {
//        var_dump($_POST);die;
        $model = DisciplinesMatrix::find()
            ->where([
               'discipline_id' => $id ,
               'head_id' => $hid
            ])
            ->one();
        if (isset($model->id)){
            $model->delete();
            return $this->redirect(Yii::$app->request->referrer);
        }else{

            $check = $this->checkMatrix($hid, $id);
//                var_dump($check);die;
            if ($check == 0){
                $add = new DisciplinesMatrix();
                $add->discipline_id = $id;
                $add->head_id = $hid;

//                var_dump($check);die;
                if ($add->save()){
                    Yii::$app->session->setFlash('success', 'Успешно!');
                }
            }else{
                Yii::$app->session->setFlash('danger', 'Ошибка! Дисциплина уже зависима!');
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * @param object $model
     * @param int $id ID дисциплины
     * @param int $hid ID потомка
     *
     */

    private function checkMatrix($hid, $id){
        $dModel = DisciplinesMatrix::find()
            ->where([
                'discipline_id'=> $hid
            ])
            ->all();
        foreach ($dModel as $dis){
            if ($dis->head_id == $id){
                return 1;
                break;
            }
//            else{
//                $this->checkMatrix($dis->head_id, $id);
//            }
        }
        return 0;
    }

    /**
     * Updates an existing Disciplines model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Disciplines model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Disciplines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Disciplines the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disciplines::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
