<?php

namespace app\models;

use yii\db\ActiveRecord;

class Station extends ActiveRecord
{
    public static function tableName()
    {
        return '{{stations}}';
    }

    public function rules()
    {
        return [
            [['line_id', 'name'], 'required'],
            [['line_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['external_id'], 'string', 'max' => 128],
            [['number'], 'string', 'max' => 128],
            [['crossPlatform'], 'integer'],
            [['crossPlatformColor'], 'string', 'max' => 7],
            [['scheme'], 'string', 'max' => 500],
            [['sort'], 'integer'],
            [['active'], 'integer'],
            [['cross_line_id'], 'integer'],
            [
                ['line_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Line::class,
                'targetAttribute' => ['line_id' => 'id'],
                'message' => 'Line by Id not exist'
            ],
            [
                ['cross_line_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Line::class,
                'targetAttribute' => ['cross_line_id' => 'id'],
                'message' => 'Line by Id not exist'
            ],
            ['cross_type', 'in', 'range' => ['simple', 'circular']],
        ];
    }

    public function extraFields(): array
    {
        return [
            'translations',
            'transfers',
            'audios',
            'features'
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(StationTranslation::class, ['station_id' => 'id']);
    }

    public function getTransfers()
    {
        return $this->hasMany(StationTransfer::class, ['station_id' => 'id']);
    }

    public function getAudios()
    {
        return $this->hasMany(StationAudio::class, ['station_id' => 'id']);
    }

    public function getFeatures()
    {
        return $this->hasMany(StationFeature::class, ['station_id' => 'id']);
    }
}