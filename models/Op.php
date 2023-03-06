<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "op".
 *
 * @property int $id
 * @property string $name
 * @property string $objective
 * @property int $autor
 * @property int $active
 * @property string $date_create
 * @property string $date_update
 *
 * @property User $autor0
 */
class Op extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'op';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'objective'], 'required'],
            [['objective'], 'string'],
            [['autor', 'active'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['autor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['autor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ОП'),
            'objective' => Yii::t('app', 'Objective'),
            'autor' => Yii::t('app', 'Autor'),
            'active' => Yii::t('app', 'Active'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
        ];
    }

//    public function beforeSave($insert)
//    {
//        if(parent::beforeSave($insert)){
//            if ($insert) {
//                $this->autor = Yii::$app->user->id;
//                Yii::$app->session->setFlash('success', 'ОП создана');
//            }else{
//                Yii::$app->session->setFlash('success', 'ОП обновлена');
//            }
//            return true;
//        }else{
//            return false;
//        }
////        parent::beforeSave($insert);
//    }

    /**
     * Gets query for [[Autor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor0()
    {
        return $this->hasOne(User::className(), ['id' => 'autor']);
    }

    public function getDiscipline()
    {
        return $this->hasMany(Disciplines::className(), ['op_id' => 'id']);
    }

    public function getDisciplines()
    {
        $disciplines = Disciplines::find()->select('id')->where(['op_id' => $this->id])->all();
        return $disciplines;
    }
}
