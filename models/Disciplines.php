<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disciplines".
 *
 * @property int $id
 * @property int $op_id
 * @property string $name
 * @property string $obout
 * @property int $credits
 * @property int $cycle_id
 * @property int $component_id
 * @property string $date_create
 * @property string $date_update
 * @property int $active
 *
 * @property Component $component
 * @property Cycle $cycle
 * @property Op $op
 */
class Disciplines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disciplines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['op_id', 'name', 'obout', 'credits', 'cycle_id', 'component_id'], 'required'],
            [['op_id', 'credits', 'cycle_id', 'component_id', 'active'], 'integer'],
            [['obout'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['cycle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cycle::className(), 'targetAttribute' => ['cycle_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['component_id' => 'id']],
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
            'op_id' => Yii::t('app', 'ОП'),
            'name' => Yii::t('app', 'Название'),
            'obout' => Yii::t('app', 'Описание'),
            'credits' => Yii::t('app', 'Кредиты'),
            'cycle_id' => Yii::t('app', 'Цикл'),
            'component_id' => Yii::t('app', 'Компонент'),
            'date_create' => Yii::t('app', 'Дата создания'),
            'date_update' => Yii::t('app', 'Дата редактирования'),
            'active' => Yii::t('app', 'Статус'),
        ];
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }

    /**
     * Gets query for [[Cycle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCycle()
    {
        return $this->hasOne(Cycle::className(), ['id' => 'cycle_id']);
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

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCountVote()
    {
        $query = LearningResultVote::find()->where(['dp_id'=>$this->id])->sum('result');
        return $query;
    }

    public function getMatrix($id,$hid)
    {
        $query = DisciplinesMatrix::find()->where(['discipline_id'=>$id, 'head_id'=>$hid])->one();
//        var_dump($query);die();
        return $query;
    }
}
