<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations}}`.
 */
class m230210_105837_create_stations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations}}', [
            'id' => $this->primaryKey(11),
            'external_id' => $this->string(128)->defaultValue(null),
            'number' => $this->string(128)->defaultValue(null),
            'line_id' => $this->integer(11)->notNull(),
            'name' => $this->string(128)->notNull(),
            'cross_line_id' => $this->integer(11)->defaultValue(null),
            'cross_type' => "ENUM('simple', 'circular')" . "DEFAULT null",
            'crossPlatform' => $this->tinyInteger(1)->defaultValue(null),
            'crossPlatformColor' => $this->string(7)->defaultValue(null),
            'scheme' => $this->string(500)->notNull()->defaultValue(null),
            'sort' => $this->integer(11)->defaultValue(null),
            'active' => $this->integer(11)->notNull()->defaultValue(1),
        ], 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=345 ');

        $this->createIndex(
            'line_id',
            'stations',
            'line_id, cross_line_id'
        );

        $this->addForeignKey(
            'fk-stations-lines',
            'stations',
            'line_id',
            'lines',
            'id',
            'CASCADE',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-stations-_cross_lines',
            'stations',
             'cross_line_id',
            'lines',
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
            'fk-stations-lines',
            'stations'
        );

        $this->dropForeignKey(
            'fk-stations-_cross_lines',
            'stations'
        );

        $this->dropIndex(
            'line_id',
            'stations'
        );

        $this->dropTable('{{%stations}}');
    }
}
