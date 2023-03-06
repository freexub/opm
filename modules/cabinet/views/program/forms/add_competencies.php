<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Competencies */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-dialog"  role="document">
    <div class="modal-content loader-lg" style="border: 0">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

            <div class="row">
                <div class="col-md-12" style="margin-left: 20px">
                    <h3>Добавление компетенции</h3>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                    <div class="col-md-11" style="margin-left: 20px">
                        <?= $form->field($model, 'name')->textInput() ?>
                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>



        </div>
    </div>
</div>