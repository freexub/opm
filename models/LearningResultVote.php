<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learning_result_vote".
 *
 * @property int $id
 * @property int $lr_id
 * @property int $dp_id
 * @property int $autor
 * @property int $result
 * @property string $date_create
 *
 * @property Disciplines $dp
 * @property LearningResult $lr
 */
class LearningResultVote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learning_result_vote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lr_id', 'dp_id', 'autor', 'result'], 'required'],
            [['lr_id', 'dp_id', 'autor', 'result'], 'integer'],
            [['date_create'], 'safe'],
            [['lr_id'], 'exist', 'skipOnError' => true, 'targetClass' => LearningResult::className(), 'targetAttribute' => ['lr_id' => 'id']],
            [['dp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplines::className(), 'targetAttribute' => ['dp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lr_id' => Yii::t('app', 'Lr ID'),
            'dp_id' => Yii::t('app', 'Dp ID'),
            'autor' => Yii::t('app', 'Autor'),
            'result' => Yii::t('app', 'Result'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    /**
     * Gets query for [[Dp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDp()
    {
        return $this->hasOne(Disciplines::className(), ['id' => 'dp_id']);
    }

    /**
     * Gets query for [[Lr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLr()
    {
        return $this->hasOne(LearningResult::className(), ['id' => 'lr_id']);
    }
}
