<?php

namespace app\modules\cabinet\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectOp;
use app\modules\cabinet\models\ProgramsSearch;
use yii\data\ActiveDataProvider;

class ProjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $autor = \Yii::$app->user->id;
        $modalForm = new Project();
        $model = Project::find()->where(['autor'=>$autor]);
        $dataProviders = new ActiveDataProvider([
            'query' => $model,
            'sort' => false
        ]);

        return $this->render('index',[
            'dataProviders' => $dataProviders,
            'modalForm' => $modalForm,
        ]);
    }

    public function actionGenerate($id){

        $project = Project::findOne($id);
        if ($project->hash == null){
            $projectOp = ProjectOp::find()
                ->where(['project_id' => $id])
                ->all();

            $dis0 = $projectOp[0]->program->discipline;
            $dis1 = $projectOp[1]->program->discipline;
            var_dump($projectOp);die();
            shuffle( $dis0);
            shuffle( $dis1);

            $d0 = array_slice($dis0, count($dis0)/2);
            $d1 = array_slice($dis1, count($dis1)/2);

            $allDis = array_merge($d0, $d1);
//            var_dump($allDis);die();
            for ($i=0; count($dis0)/2 > $i; $i++){
                foreach ($allDis as $dd){
                    $array[$i][] = $dd->id;
                }
            }

            $project->hash = json_encode($array);
            $project->save(false);
        }
        var_dump(json_decode($project->hash));die();
    }

    public function actionCreate()
    {
        $model = new Project();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->autor = \Yii::$app->user->id;
                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

    public function actionView($id)
    {
        $projectOp = new ProjectOp();
        $query = ProjectOp::find()->where(['project_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $searchModel = new ProgramsSearch();
        $dataProviders = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'projectOp' => $projectOp,
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProviders' => $dataProviders,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOpAdd(){
        $model = new ProjectOp();
        if ($model->load($this->request->post())) {
            if($model->save())
                return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionOpDel($id){
        $model = ProjectOp::findOne($id);
        if ($this->request->isPost) {
            if($model->delete())
                return $this->redirect(Yii::$app->request->referrer);
        }
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
