<?php

namespace app\models;

use yii\db\ActiveRecord;

class StationAudio extends ActiveRecord
{
    public static function tableName()
    {
        return '{{stations_audio}}';
    }

    public function rules()
    {
        return [
            [['direction', 'action'], 'required'],
            ['direction', 'in', 'range' => ['forward', 'backward']],
            ['action', 'in', 'range' => ['arrive', 'departure', 'toend']],
            [['sound'], 'string', 'max' => 500],
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