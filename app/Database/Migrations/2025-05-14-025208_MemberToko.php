<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MemberToko extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint' => '11',
                'null'       => false,
                'auto_increment' => true,
            ],
            'member_id' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null'       => true,
            ],
            'auth_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('member_toko');
    }

    public function down()
    {
        $this->forge->dropTable('member_toko');
    }
}
