<?php

namespace app\models;

use yii\base\Model;

class Language extends Model
{
    public static function tableName(): string
    {
        return 'languages';
    }
}