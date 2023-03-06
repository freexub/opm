<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Competencies}}".
 *
 * @property int $id
 * @property int $op_id
 * @property string $name
 * @property int $status
 * @property int $autor
 */
class Competencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%competencies}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['op_id', 'name'], 'required'],
            [['op_id', 'status', 'autor'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'op_id' => Yii::t('app', 'op ID'),
            'name' => Yii::t('app', 'Компетенция'),
            'status' => Yii::t('app', 'Status'),
            'autor' => Yii::t('app', 'Autor'),
        ];
    }
}
