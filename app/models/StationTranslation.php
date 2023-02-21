<?php

namespace app\models;

use yii\db\ActiveRecord;

class StationTranslation extends ActiveRecord
{

    public static function tableName()
    {
        return '{{stations_translation}}';
    }

    public function rules()
    {
        return [
            [['language_id', 'value'], 'required'],
            [['value'], 'string', 'max' => 255],
            [['language_id'], 'integer'],
            [
                ['language_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Language::class,
                'targetAttribute' => ['language_id' => 'id'],
                'message' => 'Language by Id not exist'
            ],
            [['station_id'], 'integer'],
            [['station_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Station::class,
                'targetAttribute' => ['station_id' => 'id']]
        ];
    }

    public function getStation()
    {
        return $this->hasOne(Station::class, ['id' => 'station_id']);
    }
}