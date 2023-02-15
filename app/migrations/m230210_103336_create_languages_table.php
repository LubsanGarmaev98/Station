<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%languages}}`.
 */
class m230210_103336_create_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(11),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'name' => $this->string(128)->notNull(),
            'code' => $this->string(50)->notNull(),
            'sort' => $this->integer(11)->notNull()
        ], 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }
}
