<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJumlahToPeminjaman extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peminjaman', [
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'after'      => 'buku_id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('peminjaman', 'jumlah');
    }
}
