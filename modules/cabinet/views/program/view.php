<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap4\Tabs;
use yii\bootstrap4\modal;

/* @var $this yii\web\View */
/* @var $contentTab yii\web\View */
/* @var $model app\models\Op */
/* @var $competencies app\models\Competencies */
/* @var $dataProviders yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Образовательные программы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rop-view">

    <?= Tabs::widget([
        'navType' => 'nav-pills ',
        'options' => ['class' => 'course-manager'],
        'encodeLabels' => false,
        'items' => $items,
    ]) ?>

    <div class="clearfix"></div>

    <?= $this->render($contentTab, [
        'model' => $model,
        'dataProviders' => $dataProviders,
        'dataProviders2' => $dataProviders2,
//        'competencies' => $competencies,
        'rop_id' => $op_id,
        'newDis' => $newDis,
        'newResult' => $newResult,
        'discipline' => $discipline,
    ]) ?>

</div>
