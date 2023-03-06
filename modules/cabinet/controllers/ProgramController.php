<?php

namespace app\modules\cabinet\controllers;


use app\models\Disciplines;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Competencies;
use app\models\LearningResult;
use app\models\LearningResultVote;
use app\modules\cabinet\models\Programs;
use app\modules\cabinet\models\ProgramsSearch;

class ProgramController extends \yii\web\Controller
{
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
     * Lists all Programs models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $expertPrograms = RopExperts::find()->select('rop_id')->where(['active'=>0, 'user_id'=>Yii::$app->user->id])->asArray()->all();
//        var_dump($expertPrograms);die();
        $searchModel = new ProgramsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Programs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $dId=0)
    {
//        $competencies = Competencies::find()->where(['op_id'=>$id])->orderBy('id DESC')->all();
        $newDis = new Disciplines();
        $newResult = new LearningResult();
//        foreach ($competencies as $competence){
//            $learningResult = LearningResult::find()->where(['competencies_id'=>$competence->id]);
//            $dataProviders[$competence->id] = new ActiveDataProvider([
//                'query' => $learningResult,
//                'sort' => false
//            ]);
//        }
//        var_dump($dataProviders);die();

        $discipline = Disciplines::find()->where(['op_id'=>$id]);
        $dataProviders = new ActiveDataProvider([
            'query' => $discipline,
            'sort' => false
        ]);
        $lerRes = LearningResult::find()->where(['op_id'=>$id]);
        $dataProviders2 = new ActiveDataProvider([
            'query' => $lerRes,
            'sort' => false
        ]);
        $activeTab2 = false;
        $activeTab1 = false;
        $activeTab = false;
        $contentTab = 'tabs/passport';
        if (isset($_GET['tab'])){
            if ($_GET['tab'] == 1){
                $activeTab1 = true;
                if (isset($_GET['dId'])){
                    $contentTab = 'tabs/discipline-view';
                    $discipline = Disciplines::findOne($dId);
                }else{
                    $contentTab = 'tabs/discipline';
                }
            }
            if ($_GET['tab'] == 2){
                $activeTab2 = true;
                $contentTab = 'tabs/learning-result';
            }
        }

        $items = [
            [
                'label' => '<b>Паспорт ОП</b>',
                'url' => 'view?id='.$id,
            ],
            [
                'label' => 'Дисциплины',
                'url' => 'view?id='.$id.'&tab=1',
                'active' => $activeTab1,
            ],
            [
                'label' => 'Результаты обучения',
                'url' => 'view?id='.$id.'&tab=2',
                'active' => $activeTab2,
            ],
//            [
//                'label' => 'Компетенции ОП',
//                'url' => 'view?id='.$id.'&tab=1',
//                'active' => $activeTab,
//            ],
        ];

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviders' => $dataProviders,
            'dataProviders2' => $dataProviders2,
            'items' => $items,
            'op_id' => $id,
            'contentTab' => $contentTab,
            'newDis' => $newDis,
            'newResult' => $newResult,
            'discipline' => $discipline,
        ]);
    }

    /**
     * Creates a new Programs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Programs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->autor = \Yii::$app->user->id;
                $model->save();
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Disciplines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionDisciplineAdd($op_id)
    {
        $model = new Disciplines();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->op_id = $op_id;
//                var_dump($model->op_id);die();
                if ($model->save())
                    return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    public function actionVoteAdd($id){
        $model = new LearningResultVote();
//        var_dump($_POST);die();
        if ($this->request->isPost) {
            if (isset($_POST['vote'])){
                $model->dp_id = (int)$_POST['vote']['discipline'];
                $model->lr_id = (int)$_POST['vote']['lr'];
                $model->autor = Yii::$app->user->id;
                if((int)$_POST['vote']['result'] <= 100) {
                    $model->result = (int)$_POST['vote']['result'];
                    if($model->save())
                        return $this->redirect(Yii::$app->request->referrer);
                }else{
                    var_dump('Рейтинг не должен привышать 100');die();
                }
            }
            var_dump('Рейтинг 100');die();
        }
    }

    public function actionVoteDelete($id,$dId){
        $model = LearningResultVote::find()
            ->where([
                'dp_id' => $dId,
                'lr_id' => $id,
                'autor' => Yii::$app->user->id,
            ])
            ->one();
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Creates a new LearningResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionResultAdd($op_id)
    {
        $model = new LearningResult();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->op_id = $op_id;
                if ($model->save())
                    return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    /**
     * Finds the Rop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Programs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    protected function findLearningResult($autor, $id)
//    {
//        if (($model = CompetenciesVote::find()->where(['autor'=>$autor, ])) !== null) {
//            return $model;
//        }
//
//        throw new NotFoundHttpException('The requested page does not exist.');
//    }

}
