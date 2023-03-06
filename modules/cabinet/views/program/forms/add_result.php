<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Competencies */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="competencies-form">
    <div class="row">

        <div class="col-md-12" style="margin-left: 20px">
            <h3>Добавление результатов обучения</h3>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-11" style="margin-left: 20px">
            <?php
            $form = ActiveForm::begin([
                    'action'=>[
                            'learning-result-add',
                            'rop_id' => $rop_id,
                            'id' => $id
                    ]
            ]); ?>
                    <?= $form->field($model, 'name')->textInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-11" style="margin-left: 20px">
            <?php
//            echo GridView::widget([
//                'dataProvider' => $dataProvider,
//                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
//                    'name',
//                    'status',
//                    [
//                        'label' => 'Удалить',
//                        #'visible' => Yii::$app->user->can('admin'),
//                        'format' => 'raw',
//                        'options' => ['width' => '50'],
//                        'value' => function($data) use ($rop_id){
//                            $class = '';
//                            if ($data->status == 0){
//                                $class ='btn btn-danger btn-sm glyphicon glyphicon-remove-sign';
//                            }
//                            if ($data->status == 1){
//                                $class ='btn btn-info btn-sm glyphicon glyphicon-ok-circle';
//                            }
//                            return Html::a('<span class="'.$class.'"></span>',
//                                [
//                                    'learning-result-status',
//                                    'id' => $data->id,
//                                    'rop_id' => $rop_id
//                                ],
//                                [
//                                    'data-toggle'=>'modal',
//                                    'data-target'=>'#modal'.($data->id),
//                                ]
//                            );
//                        }
//                    ],
//
//    //            ['class' => 'yii\grid\ActionColumn'],
//                ],
//            ]);
?>
        </div>

    </div>
</div>
