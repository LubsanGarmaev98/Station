<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations_translation}}`.
 */
class m230210_110040_create_stations_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations_translation}}', [
            'id' => $this->primaryKey(11),
            'station_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'value' => $this->string(255)->notNull(),
        ]);

        $this->createIndex(
            'station_id',
            'stations_translation',
            'station_id'
        );

        $this->addForeignKey(
            'fk-stations_translation-stations',
            'stations_translation',
            'station_id',
            'stations',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-stations_translation-stations',
            'stations_translation'
        );

        $this->dropIndex(
            'station_id',
            'stations_translation'
        );

        $this->dropTable('{{%stations_translation}}');
    }
}
