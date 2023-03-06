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
                    'discipline-add?op_id='.$_GET['id'],
                ],
            ]); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление дисциплины</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= $form->field($newDis, 'name')->textInput(['placeholder' => 'Укажите название', 'maxlength' => true]) ?>

                    <?= $form->field($newDis, 'obout')->textarea(['placeholder' => 'Заполните описание дисциплины', 'rows' => 6]) ?>

                    <?= $form->field($newDis, 'credits')->textInput(['placeholder' => 'Укажите кол-во кредитов', 'type' => 'number']) ?>

                    <?= $form->field($newDis, 'cycle_id')->dropDownList(ArrayHelper::map(\app\models\Cycle::find()->all(),'id','name'),['prompt' => 'Выберите цикл ...']) ?>

                    <?= $form->field($newDis, 'component_id')->dropDownList(ArrayHelper::map(\app\models\Component::find()->all(),'id','fullName'),['prompt' => 'Выберите компонент ...']) ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <?= Html::submitButton('Добавить дисциплину', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<hr>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Добавить дисциплину
</button>

<div class="rop-view" style="margin-top:20px;">

    <div class="clearfix"></div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProviders,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'summary' => false,
        'columns' => [
            'id',
            [
                'label' => 'Название',
                'format' => 'raw',
                'options' => ['width' => '90%'],
                'value' => function($data){
                    return '<a href="view?id='.$_GET['id'].'&tab='.$_GET['tab'].'&dId='.$data->id.'">'.$data->name.'</a>';
                }
            ],
            [
                'label' => 'Название',
                'format' => 'raw',
                'options' => ['width' => '5%'],
                'value' => function($data){
                    return $data->countVote;
                }
            ],
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


