<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations_features}}`.
 */
class m230210_105955_create_stations_features_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations_features}}', [
            'id' => $this->primaryKey(11),
            'station_id' => $this->integer(11)->defaultValue(null),
            'feature_id' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex(
            'feature_id',
            'stations_features',
            'feature_id'
        );

        $this->addForeignKey(
            'fk-stations_features-feature',
            'stations_features',
            'feature_id',
            'services',
            'id',
            'CASCADE',
            'NO ACTION'
        );

        $this->createIndex(
            'station_id',
            'stations_features',
            'station_id'
        );

        $this->addForeignKey(
            'fk-stations_features-stations',
            'stations_features',
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
            'fk-stations_features-feature',
            'stations_features'
        );

        $this->dropIndex(
            'feature_id',
            'stations_features'
        );

        $this->dropForeignKey(
            'fk-stations_features-stations',
            'stations_features'
        );

        $this->dropIndex(
            'station_id',
            'stations_features'
        );

        $this->dropTable('{{%stations_features}}');
    }
}
