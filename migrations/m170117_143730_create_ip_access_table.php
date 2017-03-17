<?php

use yii\db\Migration;

class m170117_143730_create_ip_access_table extends Migration
{
    const TABLE_NAME = '{{ip_access}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'ip' => $this->string(40)->notNull()->comment('ip'),
            'createdAt' => $this->integer(10)->notNull()->defaultValue(0),
            'endAt' => $this->integer(10)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'indexIp',
            self::TABLE_NAME,
            'ip'
        );
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
