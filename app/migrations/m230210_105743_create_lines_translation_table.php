<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lines_translation}}`.
 */
class m230210_105743_create_lines_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lines_translation}}', [
            'id' => $this->primaryKey(11),
            'line_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'value' => $this->string(255)->notNull(),
        ], 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35');

        $this->createIndex(
            'language_id',
            'lines_translation',
            'language_id'
        );

        $this->addForeignKey(
            'fk-language_id-languages',
            'lines_translation',
            'language_id',
            'languages',
            'id',
            'CASCADE',
            'NO ACTION'
        );

        $this->createIndex(
            'line_id',
            'lines_translation',
            'line_id'
        );

        $this->addForeignKey(
            'fk-line_id-lines',
            'lines_translation',
            'line_id',
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
            'fk-language_id-languages',
            'lines_translation'
        );

        $this->dropIndex(
            'language_id',
            'lines_translation'
        );

        $this->dropForeignKey(
            'fk-line_id-lines',
            'lines_translation'
        );

        $this->dropIndex(
            'line_id',
            'lines_translation'
        );

        $this->dropTable('{{%lines_translation}}');
    }
}
