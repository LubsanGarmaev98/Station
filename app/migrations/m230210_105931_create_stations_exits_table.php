<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations_exits}}`.
 */
class m230210_105931_create_stations_exits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations_exits}}', [
            'id' => $this->primaryKey(11),
            'station_id' => $this->integer(11)->notNull(),
            'direction' => "ENUM('forward', 'backward')" . "NOT null",
            'doors' => "ENUM('left', 'right')" . "NOT null",
        ]);

        $this->createIndex(
            'station_id',
            'stations_exits',
            'station_id'
        );

        $this->addForeignKey(
            'fk-stations_exits-stations',
            'stations_exits',
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
            'fk-stations_exits-stations',
            'stations_exits'
        );

        $this->dropIndex(
            'station_id',
            'stations_exits'
        );

        $this->dropTable('{{%stations_exits}}');
    }
}
