<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $discipline app\models\Disciplines */
/* @var $dataProviders2 yii\data\ActiveDataProvider*/

$model = $discipline;


\yii\web\YiiAsset::register($this);
?>
<hr>
<div class="disciplines-view">

    <h3>Дисциплина: <?= $model->name; ?></h3>

    <div class="card card-default collapsed-card">
        <div class="card-header">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <h3 class="card-title">Описание</h3>
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'label' => 'Образовательная программа',
                        'value' => function ($data) {
                            return $data->op->name;
                        },
                    ],
                    'obout:ntext',
                    'credits',
                    [
                        'label' => 'Цикл',
                        'value' => function ($data) {
                            return $data->cycle->name;
                        },
                    ],
                    [
                        'label' => 'Компонент',
                        'value' => function ($data) {
                            return $data->component->name;
                        },
                    ],
                    'code',
                    'date_create',
                    'date_update',
//                    'active',
                ],
            ]) ?>
        </div>
        <!-- /.card-footer-->
    </div>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProviders2,
//        'showHeader'=> false,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Результаты обучения',
                'format' => 'raw',
                'options' => ['width' => '75%'],
                'value' => 'name',
            ],
            [
                'label' => 'Рейтинг 0-100',
                'format' => 'raw',
                'options' => ['width' => '20%'],
                'value' => function($data){
                    if (!isset($data->getVote1($data->id,$_GET['dId'])->result)){
                     $a =   '
                        <form action="vote-add?id='.$data->id.'&lr='.$data->id.'&dId='.$_GET['dId'].'" method="POST">
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" class="form-control" size="4" placeholder="1...100" name="vote[result]">
                                    <input type="hidden" name="vote[discipline]" value="'.$_GET['dId'].'">
                                    <input type="hidden" name="vote[lr]" value="'.$data->id.'">
                                    <input type="hidden" name="'.Yii::$app->request->csrfParam.'" value="'.Yii::$app->request->getCsrfToken().'" />
                                </div>
                                <div class="col-6">
                                    <input type="submit" class="btn btn-primary fa-male" value="Сохранить">
                                </div>
                            </div>
                        </form>
                        ';
                        return $a;
                    }else{
                        $a = '
                            <div class="row">
                                <div class="col-4">
                                    <a class="btn btn-info disabled">'.$data->getVote1($data->id,$_GET['dId'])->result.'</a>
                                </div>
                                <div class="col-4">
                                    '.Html::a(Yii::t('app', '<span class="fa fa-trash"></span>'), ['vote-delete', 'id' => $data->id, 'dId'=>$_GET['dId']], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Вы уверены? Вы сбрасываете оценку РО: '.$data->name),
                                            'method' => 'post',
                                        ],
                                    ]).'
                                </div>
                            </div>
                        ';
                        return $a;
                    }
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
