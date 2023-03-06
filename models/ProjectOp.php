<?php

namespace app\models;

use app\modules\cabinet\models\Programs;
use Yii;

/**
 * This is the model class for table "project_op".
 *
 * @property int $id
 * @property int $project_id
 * @property int $op_id
 * @property int $part
 */
class ProjectOp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_op';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'op_id'], 'required'],
            [['project_id', 'op_id', 'part'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'op_id' => Yii::t('app', 'Op ID'),
            'part' => Yii::t('app', 'Part'),
        ];
    }

    public function getProgram()
    {
        return $this->hasOne(Programs::className(), ['id' => 'op_id']);
    }
}
