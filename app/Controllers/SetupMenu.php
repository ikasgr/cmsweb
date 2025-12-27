<?php

namespace App\Controllers;

class SetupMenu extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Groups to create
        $groups = [
            [
                'modul' => 'Manajemen Gereja',
                'gm' => 'Manajemen Gereja',
                'icon' => 'mdi mdi-church',
                'urut' => 20,
                'children' => [
                    ['modul' => 'Manajemen Jemaat', 'url' => 'manajemen-jemaat/list', 'icon' => 'mdi mdi-account-group', 'urut' => 1],
                    ['modul' => 'Keuangan Gereja', 'url' => 'keuangan-gereja/list', 'icon' => 'mdi mdi-cash-multiple', 'urut' => 2],
                    ['modul' => 'Inventaris Gereja', 'url' => 'inventaris-gereja/list', 'icon' => 'mdi mdi-package-variant', 'urut' => 3],
                    ['modul' => 'Majelis Gereja', 'url' => 'majelis-gereja/list', 'icon' => 'mdi mdi-account-tie', 'urut' => 4],
                ]
            ],
            [
                'modul' => 'Jadwal & Pelayanan',
                'gm' => 'Jadwal Pelayanan',
                'icon' => 'mdi mdi-calendar-clock',
                'urut' => 21,
                'children' => [
                    ['modul' => 'Jadwal Ibadah', 'url' => 'jadwal-ibadah/list', 'icon' => 'fas fa-angle-right', 'urut' => 1],
                    ['modul' => 'Jadwal Pelayanan', 'url' => 'jadwal-pelayanan/list', 'icon' => 'fas fa-angle-right', 'urut' => 2],
                ]
            ],
            [
                'modul' => 'Pendaftaran',
                'gm' => 'Pendaftaran',
                'icon' => 'mdi mdi-file-document-edit',
                'urut' => 22,
                'children' => [
                    ['modul' => 'Baptis', 'url' => 'pendaftaran-baptis/list', 'icon' => 'fas fa-angle-right', 'urut' => 1],
                    ['modul' => 'Pernikahan', 'url' => 'pendaftaran-nikah/list', 'icon' => 'fas fa-angle-right', 'urut' => 2],
                    ['modul' => 'Sidi', 'url' => 'pendaftaran-sidi/list', 'icon' => 'fas fa-angle-right', 'urut' => 3],
                ]
            ]
        ];

        echo "<h1>Setup Menu Start...</h1>";

        foreach ($groups as $group) {
            // 1. Insert Parent ('utm')
            $existing = $db->table('cms__modul')
                ->where('modul', $group['modul'])
                ->where('tipemn', 'utm')
                ->get()->getRow();

            if (!$existing) {
                $db->table('cms__modul')->insert([
                    'modul' => $group['modul'],
                    'urlmenu' => '-',
                    'gm' => $group['gm'],
                    'urut' => $group['urut'],
                    'ikonmn' => $group['icon'],
                    'tipemn' => 'utm',
                    'level' => '3',
                    'aktif' => 1,
                    'hidden' => 0
                ]);
                $parentId = $db->insertID();
                echo "Inserted Parent: " . $group['modul'] . "<br>";

                // Add Access for Admin (Group 1)
                $db->table('cms__grupakses')->insert([
                    'id_grup' => 1,
                    'id_modul' => $parentId,
                    'aksesmenu' => 1,
                    'akses' => 1,
                    'tambah' => 1,
                    'ubah' => 1,
                    'hapus' => 1
                ]);
            } else {
                $parentId = $existing->id_modul;
                echo "Parent exists: " . $group['modul'] . "<br>";
            }

            // 2. Insert Children ('sm')
            foreach ($group['children'] as $child) {
                $existingChild = $db->table('cms__modul')
                    ->where('urlmenu', $child['url'])
                    ->where('tipemn', 'sm')
                    ->get()->getRow();

                if (!$existingChild) {
                    $db->table('cms__modul')->insert([
                        'modul' => $child['modul'],
                        'urlmenu' => $child['url'],
                        'gm' => $group['gm'],
                        'urut' => $child['urut'],
                        'ikonmn' => $child['icon'],
                        'tipemn' => 'sm',
                        'level' => '3',
                        'aktif' => 1,
                        'hidden' => 0
                    ]);
                    $childId = $db->insertID();
                    echo "- Inserted Child: " . $child['modul'] . "<br>";

                    // Add Access for Admin (Group 1)
                    $db->table('cms__grupakses')->insert([
                        'id_grup' => 1,
                        'id_modul' => $childId,
                        'aksesmenu' => 0,
                        'akses' => 1,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1
                    ]);
                } else {
                    echo "- Child exists: " . $child['modul'] . "<br>";
                }
            }
        }

        echo "<br><b>Done! You can delete this controller now.</b>";
    }
}
