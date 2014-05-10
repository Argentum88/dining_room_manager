<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class UserItemMigration_100 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'user_item',
            array(
            'columns' => array(
                new Column(
                    'user_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'item_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'user_id'
                    )
                ),
                new Column(
                    'quantity',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 3,
                        'after' => 'item_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('user_id', 'item_id')),
                new Index('item_id', array('item_id'))
            ),
            'references' => array(
                new Reference('item_id', array(
                    'referencedSchema' => 'dining_room_manager',
                    'referencedTable' => 'item',
                    'columns' => array('item_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('user_id', array(
                    'referencedSchema' => 'dining_room_manager',
                    'referencedTable' => 'user',
                    'columns' => array('user_id'),
                    'referencedColumns' => array('id')
                ))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
