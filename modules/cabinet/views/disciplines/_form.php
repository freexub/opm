<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disciplines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'op_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obout')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'credits')->textInput() ?>

    <?= $form->field($model, 'cycle_id')->textInput() ?>

    <?= $form->field($model, 'component_id')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
