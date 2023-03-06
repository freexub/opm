<?php

use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProviders yii\data\ActiveDataProvider */
/* @var $modalForm \app\models\Project */
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => [
                    'create',
                ],
            ]); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новый проект</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?= $form->field($modalForm, 'name')->textInput(['placeholder' => 'Укажите название', 'maxlength' => true]) ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <?= Html::submitButton('Создать проект', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
    Создать проект
</button>
<hr>
<?= GridView::widget([
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
                return $data->name;
            }
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>

