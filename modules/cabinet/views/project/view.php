<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $contentTab yii\web\View */
/* @var $model app\models\Op */
/* @var $projectOp app\models\ProjectOp */
/* @var $competencies app\models\Competencies */
/* @var $dataProviders yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
//    var_dump($dataProviders->models);die;
    foreach ($dataProviders->models as $dm){
        echo '
            <div class="modal modal-default fade" id="modal'.$dm->id.'">
                <div class="modal-dialog">
                    <div class="modal-content">'.
                        $this->render('forms/_form', [
                            'model' => $projectOp,
                            'id' => $dm->id,
                        ]) .'
                    </div>
                </div>
            </div>            
        ';
    }
?>
<div class="rop-view">
    <div class="clearfix"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'label' => 'Название',
                'format' => 'raw',
                'options' => ['width' => '90%'],
                'value' => function($data){
                    return $data->program->name . " <span class='badge badge-info right'>".$data->part."%</span>";
                }
            ],
            [
                'label' => 'Удалить',
                'format' => 'raw',
//                'options' => ['width' => '90%'],
                'value' => function($data){
                    return Html::a(Yii::t('app', '<span class="fa fa-trash"></span>'), ['op-del', 'id' => $data->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы хотите УДАЛИТЬ из проекта '.$data->program->name),
                            'method' => 'post',
                        ],
                    ]);
                }
            ],
        ],
    ]);?>
<hr>
    <?= GridView::widget([
        'dataProvider' => $dataProviders,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'summary' => false,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            [
                'label' => 'Выбрать',
                'format' => 'raw',
                'options' => ['width' => '5%'],
                'value' => function($data) use ($model){
//                    var_dump($model->getCountOp());die();
                    if ($model->getCountOp() == 2){
                        return Html::a(Yii::t('app', 'Выбрать'), ['op-add', 'op_id' => $data->id, 'project_id'=>$model->id], [
                            'class' => 'btn btn-success disabled',
                            'data' => [
                                'confirm' => Yii::t('app', 'Добавить в проект '.$data->name),
                                'method' => 'post',
                            ],
                        ]);
                    }else{
                        return Html::a(Yii::t('app', 'Выбрать'), ['op-add', 'op_id' => $data->id, 'project_id'=>$model->id], [
                            'class' => 'btn btn-success',
                            'data' => [
//                                'confirm' => Yii::t('app', 'Добавить в проект '.$data->name),
//                                'method' => 'post',
                                'toggle' => 'modal',
                                'target' => '#modal'.$data->id,
                            ],
                        ]);
                    }
                }
            ],
        ],
    ]);?>
</div>
