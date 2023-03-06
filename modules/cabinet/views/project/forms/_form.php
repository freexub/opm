<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LearningResult */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
        'action' => 'op-add'
]); ?>
    <div class="modal-header">
        <h4 class="modal-title">Добавление ОП</h4>
        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
        <?= $form->field($model, 'part')->textInput()->label('Укажите количество дисциплин в %') ?>
        <?= $form->field($model, 'project_id')->hiddenInput(['value'=>$_GET['id']])->label(false) ?>
        <?= $form->field($model, 'op_id')->hiddenInput(['value'=>$id])->label(false) ?>
    </div>
    <div class="modal-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success btn-outline']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>


