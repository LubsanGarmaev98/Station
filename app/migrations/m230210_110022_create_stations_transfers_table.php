<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations_transfers}}`.
 */
class m230210_110022_create_stations_transfers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations_transfers}}', [
            'id' => $this->primaryKey(11),
            //TODO unique key
            'station_id' => $this->integer(11)->notNull(),
            'station_to_id' => $this->integer(11)->defaultValue(null),
            'type' => "ENUM('mcc', 'mcd', 'metro', 'ground')" . "NOT null",
            'name' => $this->string(255)->defaultValue(null),
            'code' => $this->string(50)->defaultValue(null),
            'icon' => $this->string(500)->defaultValue(null),
        ]);

        $this->createIndex(
            'station_id_2',
            'stations_transfers',
            'station_id, station_to_id',
            true
        );

        $this->createIndex(
            'station_id',
            'stations_transfers',
            'station_id'
        );

        $this->addForeignKey(
            'fk-stations_transfers-stations',
            'stations_transfers',
            'station_id',
            'stations',
            'id',
            'CASCADE',
            'NO ACTION'
        );

        $this->createIndex(
            'station_to_id',
            'stations_transfers',
            'station_to_id'
        );

        $this->addForeignKey(
            'fk-stations_to_transfers-stations',
            'stations_transfers',
            'station_to_id',
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
            'fk-stations_transfers-stations',
            'stations_transfers'
        );

        $this->dropIndex(
            'station_id_2',
            'stations_transfers'
        );

        $this->dropIndex(
            'station_id',
            'stations_transfers'
        );

        $this->dropForeignKey(
            'fk-stations_to_transfers-stations',
            'stations_transfers'
        );

        $this->dropIndex(
            'station_to_id',
            'stations_transfers'
        );

        $this->dropTable('{{%stations_transfers}}');
    }
}
