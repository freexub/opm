<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LearningOutcome */

$this->title = Yii::t('app', 'Create Learning Outcome');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Learning Outcomes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-outcome-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
