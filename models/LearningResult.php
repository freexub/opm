<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learning_result".
 *
 * @property int $id
 * @property int $op_id ID ОП
 * @property string $name Результат обучения
 * @property int $status Статус
 * @property int|null $autor Автор
 *
 * @property Op $op
 */
class LearningResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learning_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['op_id', 'status', 'autor'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
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
            'op_id' => Yii::t('app', 'Op ID'),
            'name' => Yii::t('app', 'Название'),
            'status' => Yii::t('app', 'Status'),
            'autor' => Yii::t('app', 'Autor'),
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

    public function getVote1($id,$dp_id)
    {
        $model = LearningResultVote::find()
            ->where([
                'lr_id' => $id,
                'dp_id' => $dp_id,
                'autor' => Yii::$app->user->id
            ])
            ->one();
        return $model;
//        return $this->hasOne(LearningResultVote::className(), ['id' => 'lr_id']);
    }
}
