<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Protected routes (gunakan AuthFilter)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    // Buku
    $routes->get('buku', 'Buku::index');
    $routes->get('buku/tambah', 'Buku::tambah');
    $routes->post('buku/simpan', 'Buku::simpan');
    $routes->get('buku/edit/(:num)', 'Buku::edit/$1');
    $routes->post('buku/update/(:num)', 'Buku::update/$1');
    $routes->get('buku/hapus/(:num)', 'Buku::hapus/$1');

    // Anggota
    $routes->get('anggota', 'Anggota::index');
    $routes->get('anggota/tambah', 'Anggota::tambah');
    $routes->post('anggota/simpan', 'Anggota::simpan');
    $routes->get('anggota/edit/(:num)', 'Anggota::edit/$1');
    $routes->post('anggota/update/(:num)', 'Anggota::update/$1');
    $routes->get('anggota/hapus/(:num)', 'Anggota::hapus/$1');

    // Profile
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    // Peminjaman
    $routes->get('peminjaman', 'Peminjaman::index');
    $routes->get('peminjaman/tambah', 'Peminjaman::tambah');
    $routes->post('peminjaman/simpan', 'Peminjaman::simpan');

    // Pengembalian
    $routes->get('pengembalian', 'Pengembalian::index');
    $routes->post('pengembalian/proses/(:num)', 'Pengembalian::proses/$1');
    $routes->get('pengembalian/laporan', 'Pengembalian::laporan');
});
