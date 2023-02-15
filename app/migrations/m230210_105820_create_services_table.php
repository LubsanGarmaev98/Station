<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m230210_105820_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(11),
            'code' => $this->string(50)->notNull(),
            'name' => $this->string(500)->notNull(),
            'icon' => $this->string(500)->defaultValue(null),
        ], 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20');

        $this->createIndex(
            'code',
            'services',
            'code'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'code',
            'services'
        );

        $this->dropTable('{{%services}}');
    }
}
