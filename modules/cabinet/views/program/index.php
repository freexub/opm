<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Образовательные программы на оценку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rop-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            [
//                'value' => 'name',
//            ],
//            [
////                'label' => 'Открыть',
//                'format' => 'raw',
//                'options' => ['width' => '65'],
//                'value' => function($data){
////                    $turn = $data->ropTurn;
////                    if (($turn->turn > 0) && ($turn->active == 1))
////                        return '<span class="btn btn-warning btn-lg disabled glyphicon glyphicon-time" title="В очереди"></span>';
////                    else{
////                        return Html::a('<span class="btn btn-lg btn-success glyphicon glyphicon-eye-open"></span>',
////                                [
////                                    'view',
////                                    'id' => $data->id,
////                                ]
////                            );
////                    }
//                }
//            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
