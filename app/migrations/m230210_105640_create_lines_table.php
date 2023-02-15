<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lines}}`.
 */
class m230210_105640_create_lines_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lines}}', [
            'id' => $this->primaryKey(11),
            'number' => $this->string(10)->notNull()->unique(),
            'name' => $this->string(255)->notNull()->unique(),
            'color' => $this->string(7)->notNull(),
            'style' => "ENUM('fill', 'transparent')" . "DEFAULT null",
            'circular' => $this->tinyInteger(1)->defaultValue(0),
            'external_id' => $this->string(128)->defaultValue(null),
            'sort' => $this->integer(11)->defaultValue(null),
        ], 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38');

        $this->createIndex(
            'idx_number',
            'lines',
            'number, name',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx_number',
            'lines'
        );
        $this->dropTable('{{%lines}}');
    }
}
