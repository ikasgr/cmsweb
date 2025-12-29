<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pendaftaran extends BaseController
{
    public function index()
    {
        helper('dge');
        $konfigurasi = $this->konfigurasi->vkonfig();

        $data = [
            'title' => 'Menu Pendaftaran | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'sitekey' => $konfigurasi->g_sitekey,
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
        ];

        return view('frontend/pendaftaran/index', $data);
    }
}
