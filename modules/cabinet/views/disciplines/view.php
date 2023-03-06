<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplines */
/* @var $dataProvider app\models\Disciplines */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Дисциплины'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="disciplines-view">
    <?= \hail812\adminlte\widgets\FlashAlert::widget() ?>
    <div class="card card-default">
        <div class="card-header">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
<!--            <div class="alert alert-info alert-dismissible">-->
<!--                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
<!--                <h3><i class="icon fas fa-info"></i> Внимание!</h3>-->
<!--                <h5>Укажите обязательные дисциплины, для изучения дисциплины "--><?//=$model->name?><!--"</h5>-->
<!--            </div>-->
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'label' => 'Название',
                        'format' => 'raw',
                        'value' => function ($data){
                            $row = $data->getMatrix($_GET['id'], $data->id);
                            if (isset($row)){
                                $btn = Html::a(Yii::t('app', 'Удалить'), ['add-matrix', 'id' => $_GET['id'], 'hid' => $data->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
//                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]);
                            }else{
                                $btn = Html::a(Yii::t('app', 'Назначить'), ['add-matrix', 'id' => $_GET['id'], 'hid' => $data->id], [
                                    'class' => 'btn btn-info',
                                    'data' => [
//                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                            return $btn;
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'op.name',
            'name',
            'obout:ntext',
            'credits',
            'cycle_id',
            'component_id',
            'code',
            'date_create',
            'date_update',
            'active',
        ],
    ]) */?>

</div>
