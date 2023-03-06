<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\cabinet\models\ProgramsSearch */
/* @var $dataProviders yii\data\ActiveDataProvider */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
    'summary' => false,
    'columns' => [
//        'id',
        'name',
//            ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>
