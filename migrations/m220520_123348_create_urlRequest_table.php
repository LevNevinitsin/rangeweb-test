<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%urlRequest}}`.
 */
class m220520_123348_create_urlRequest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%urlRequest}}', [
            'id' => $this->primaryKey(),
            'sourceUrl' => $this->string(2083)->notNull(),
            'shortUrl' => $this->string()->notNull()->unique(),
            'usesCount' => $this->integer()->notNull()->defaultValue(0),
            'dateCreated' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%urlRequest}}');
    }
}
