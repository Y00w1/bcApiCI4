<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShoesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'quantity' => [
                'type' => 'INT',
            ],
            'rating_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '4,2',
            ],
            'rating_count' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('shoes');
    }

    public function down()
    {
        $this->forge->dropTable('shoes');
    }
}
