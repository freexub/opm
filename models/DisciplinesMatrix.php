<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disciplines_matrix".
 *
 * @property int $id
 * @property int $discipline_id
 * @property int|null $head_id
 * @property int $sort
 */
class DisciplinesMatrix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disciplines_matrix';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discipline_id', 'head_id'], 'required'],
            [['discipline_id', 'head_id', 'sort'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'discipline_id' => Yii::t('app', 'Discipline ID'),
            'head_id' => Yii::t('app', 'Head ID'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }
}
