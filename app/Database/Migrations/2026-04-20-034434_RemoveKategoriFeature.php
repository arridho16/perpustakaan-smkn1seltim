<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveKategoriFeature extends Migration
{
    public function up()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('buku', 'buku_kategori_id_foreign');
        
        // Drop column from buku
        $this->forge->dropColumn('buku', 'kategori_id');
        
        // Drop table kategori
        $this->forge->dropTable('kategori');
    }

    public function down()
    {
        // No easy way to rollback without data loss, leave empty or reconstruct
    }
}
