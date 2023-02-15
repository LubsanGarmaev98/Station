<?php

namespace app\models;

use yii\db\ActiveRecord;

class StationFeature extends ActiveRecord
{
    public function fields()
    {
        return parent::fields();
    }

    public static function tableName()
    {
        return '{{stations_features}}';
    }

    public function rules()
    {
        return [
            [['feature_id'], 'required'],
            [
                ['feature_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Service::class,
                'targetAttribute' => ['feature_id' => 'id'],
                'message' => 'Service by Id not exist'
            ],
            [
                ['station_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Station::class,
                'targetAttribute' => ['station_id' => 'id'],
                'message' => 'Station by Id not exist'
            ]
        ];
    }

    public function getStation()
    {
        return $this->hasOne(Station::class, ['id' => 'station_id']);
    }
}