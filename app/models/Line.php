<?php

namespace app\models;

use yii\db\ActiveRecord;

class Line extends ActiveRecord
{
    public static function tableName()
    {
        return 'lines';
    }

    public function rules()
    {
        return [
            [['number', 'name', 'color'], 'required'],
            [['number', 'name'], 'unique'],
            [['number'], 'string','max' => 10],
            [['name'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 7],
            ['style', 'in', 'range' => ['fill', 'transparent']],
            [['circular'], 'integer', 'max' => 1],
            [['external_id'], 'string', 'max' => 128],
            [['sort'], 'integer', 'max' => 11],
        ];
    }

    public function extraFields()
    {
        return [
            'translations',
            'stations'
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(LineTranslation::class, ['line_id' => 'id']);
    }

    public function getStations()
    {
        return $this->hasMany(Station::class, ['line_id' => 'id']);
    }
}