<?php

namespace app\models;

use yii\db\ActiveRecord;

class StationTransfer extends ActiveRecord
{
    public function fields()
    {
        return parent::fields();
    }

    public static function tableName()
    {
        return '{{stations_transfers}}';
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            ['type', 'in', 'range' => ['mcc', 'mcd', 'metro', 'ground']],
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