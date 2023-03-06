<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LearningResult */

$this->title = Yii::t('app', 'Create Learning Result');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Learning Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
