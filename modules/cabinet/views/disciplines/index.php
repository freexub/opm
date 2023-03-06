<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cabinet\models\DisciplinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Disciplines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplines-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Disciplines'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'obout:ntext',
            [
                'label'=> 'ОП',
                'value' => 'op.name',
            ],
//            'credits',
            //'cycle_id',
            //'component_id',
            //'code',
            //'date_create',
            //'date_update',
            //'active',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Disciplines $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
