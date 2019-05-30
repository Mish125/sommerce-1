<?php

use yii\db\Migration;


/**
 * Class m190527_082503_load_from_dump
 */
class m190527_082503_load_from_dump extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = file_get_contents('test_db.sql');
        Yii::$app->db->createCommand($sql)->execute();

        $this->createIndex(
            'idx-orders-status_id',
            'orders',
            'service_id'
        );

        $this->addForeignKey(
            'fk-orders-status_id',
            'orders',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-orders-status_id','orders');
        $this->dropIndex('idx-orders-status_id', 'orders');
        $this->dropTable('services');
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_082503_load_from_dump cannot be reverted.\n";

        return false;
    }
    */
}
