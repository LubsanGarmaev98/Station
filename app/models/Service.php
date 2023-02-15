<?php

namespace app\models;

use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    public function fields()
    {
        return parent::fields();
    }

    public static function tableName()
    {
        return '{{services}}';
    }
}