<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Op */
/* @var $newDis app\models\Disciplines */
/* @var $newResult app\models\LearningResult */
/* @var $competencies app\models\Disciplines */
/* @var $dataProviders yii\data\ActiveDataProvider */

?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => [
                    'result-add?op_id='.$_GET['id'],
                ],
            ]); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление результата обучения</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= $form->field($newResult, 'name')->textInput(['placeholder' => 'Укажите результат обучения', 'maxlength' => true]) ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <?= Html::submitButton('Добавить результат обучения', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<hr>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Добавить результат обучения
</button>

<div class="rop-view" style="margin-top:20px;">

    <div class="clearfix"></div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProviders2,
//        'showHeader'=> false,
        'summary' => false,
        'columns' => [
            'id',
            'name',
//            [
////                    'label' => 'Удалить',
//                'format' => 'raw',
//                'options' => ['width' => '65'],
//                'value' => function($data){
//                    if (!isset($data->vote->result))
//                        return 'Нет голоса';
//                    else
//                        return $data->vote->result;
//                }
//            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>


