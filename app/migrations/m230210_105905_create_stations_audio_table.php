<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations_audio}}`.
 */
class m230210_105905_create_stations_audio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations_audio}}', [
            'id' => $this->primaryKey(11),
            'station_id' => $this->integer(11)->notNull(),
            'direction' => "ENUM('forward', 'backward')" . " NOT null",
            'action' => "ENUM('arrive', 'departure', 'toend')" . " NOT null",
            'sound' => $this->string(500)->defaultValue(null),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createIndex(
            'station_id',
            'stations_audio',
            'station_id'
        );

        $this->addForeignKey(
            'fk-stations_audio-stations',
            'stations_audio',
            'station_id',
            'stations',
            'id',
            'CASCADE',
            'NO ACTION'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-stations_audio-stations',
            'stations_audio'
        );

        $this->dropIndex(
            'station_id',
            'stations_audio'
        );

        $this->dropTable('{{%stations_audio}}');
    }
}
