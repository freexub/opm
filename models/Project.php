<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int|null $autor
 * @property int|null $hash
 * @property string $date_create
 * @property int $active
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['autor', 'active'], 'integer'],
            [['date_create'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['hash'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'autor' => Yii::t('app', 'Автор'),
            'hash' => Yii::t('app', 'Хэш'),
            'date_create' => Yii::t('app', 'Дата создания'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getCountOp(){
        $query = ProjectOp::find()
            ->where([
                'project_id' => $this->id,
            ])
            ->count();
        return $query;
    }
}
