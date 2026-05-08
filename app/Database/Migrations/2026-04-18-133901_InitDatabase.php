<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitDatabase extends Migration
{
    public function up()
    {
        // Tabel Users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin'], 'default' => 'admin'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // Tabel Anggota
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_anggota' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_anggota' => ['type' => 'ENUM', 'constraint' => ['siswa', 'guru']],
            'no_hp' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['aktif', 'nonaktif'], 'default' => 'aktif'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('anggota');

        // Tabel Kategori
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori');

        // Tabel Buku
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_buku' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 200],
            'pengarang' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'penerbit' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tahun_terbit' => ['type' => 'YEAR', 'null' => true],
            'kategori_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'stok' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'stok_tersedia' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'cover' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('buku');

        // Tabel Peminjaman
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_pinjam' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'anggota_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'buku_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tgl_pinjam' => ['type' => 'DATE'],
            'tgl_kembali' => ['type' => 'DATE'],
            'tgl_dikembalikan' => ['type' => 'DATE', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['dipinjam', 'dikembalikan', 'terlambat'], 'default' => 'dipinjam'],
            'petugas_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'catatan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('anggota_id', 'anggota', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('buku_id', 'buku', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('petugas_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman', true);
        $this->forge->dropTable('buku', true);
        $this->forge->dropTable('kategori', true);
        $this->forge->dropTable('anggota', true);
        $this->forge->dropTable('users', true);
    }
}
