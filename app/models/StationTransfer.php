<?php

namespace app\models;

use yii\db\ActiveRecord;

class StationTransfer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{stations_transfers}}';
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['station_to_id'], 'integer', 'max' => 11],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 500],
            ['type', 'in', 'range' => ['mcc', 'mcd', 'metro', 'ground']],
            [['station_id'], 'integer', 'max' => 11],
            [['station_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Station::class,
                'targetAttribute' => ['station_id' => 'id'],
                'message' => 'Station by Id not exist'
            ],
            [['station_to_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Station::class,
                'targetAttribute' => ['station_to_id' => 'id'],
                'message' => 'Station by Id not exist'
            ]
        ];
    }

    public function getStation()
    {
        return $this->hasOne(Station::class, ['id' => 'station_id']);
    }
}