<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learning_outcome".
 *
 * @property int $id
 * @property string $name
 * @property int $autor
 * @property string $date_create
 * @property string $date_update
 * @property int $active
 * @property int $op_id
 *
 * @property Op $op
 */
class LearningOutcome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learning_outcome';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'autor', 'op_id'], 'required'],
            [['autor', 'active', 'op_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['op_id'], 'exist', 'skipOnError' => true, 'targetClass' => Op::className(), 'targetAttribute' => ['op_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'autor' => Yii::t('app', 'Autor'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'active' => Yii::t('app', 'Active'),
            'op_id' => Yii::t('app', 'Op ID'),
        ];
    }

    /**
     * Gets query for [[Op]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOp()
    {
        return $this->hasOne(Op::className(), ['id' => 'op_id']);
    }
}
