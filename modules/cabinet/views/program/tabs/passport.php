<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Rop */
/* @var $competencies app\models\Competencies */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="passport-view" style="margin-top:20px;">

    <p>
        <?php // echo Html::a('', ['update', 'id' => $model->id], ['class' => 'btn btn-info glyphicon glyphicon-pencil', 'title'=>'Редактировать']) ?>
        <?php /* echo Html::a('', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger glyphicon glyphicon-trash',
            'title'=>'Удалить',
            'data' => [
                'confirm' => 'Вы хотите УДАЛИТЬ образовательную программу?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'  => 'Название ОП',
                'value'  => function ($data) {
                    return $data->name;
                },
            ],
            [
                'label'  => 'Описание',
                'value'  => function ($data) {
                    return $data->objective;
                },
            ],
            [
                'label'  => 'Дата добавления',
                'value'  => function ($data) {
                    return $data->date_create;
                },
            ],
            [
                'label'  => 'Дата последнего редактирования',
                'value'  => function ($data) {
                    return $data->date_update;
                },
            ],
            [
                'label'  => 'Автор ОП',
                'value'  => function ($data) {
                    return $data->autor0->username;
                },
            ],
        ],
    ]) ?>


</div>
