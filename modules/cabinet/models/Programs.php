<?php

namespace app\modules\cabinet\models;

use Yii;
use app\models\Op;

/**
 * This is the model class for table "Programs".
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
class Programs extends Op
{

}
