<?php

namespace App\Controllers;

class Jadwal extends BaseController
{
    // Frontend - Halaman jadwal
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        
        
        // Jadwal upcoming
        $jadwal = $this->jadwalpelayanan->upcoming(20);

        $data = [
            'title'         => 'Jadwal Pelayanan | ' . $konfigurasi->nama,
            'deskripsi'     => 'Jadwal pelayanan dan kegiatan gereja ' . $konfigurasi->nama,
            'url'           => base_url('jadwal'),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            
            'jadwal'        => $jadwal,
            'hariini'       => $this->jadwalpelayanan->hariini(),
            'mingguini'     => $this->jadwalpelayanan->mingguini(),
        ];

        return view('frontend/desktop/content/jadwal_index', $data);
    }

    // Frontend - Jadwal by bulan (untuk calendar)
    public function bybulan()
    {
        if ($this->request->isAJAX()) {
            $tahun = $this->request->getVar('tahun') ?? date('Y');
            $bulan = $this->request->getVar('bulan') ?? date('m');

            $jadwal = $this->jadwalpelayanan->bybulan($tahun, $bulan);

            echo json_encode(['data' => $jadwal]);
        }
    }

    // Frontend - Get events for FullCalendar
    public function getevents()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $events = $this->jadwalpelayanan->forcalendar($start, $end);

        echo json_encode($events);
    }

    // Frontend - Detail jadwal (modal)
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $jadwal = $this->jadwalpelayanan->find($id_jadwal);

            if ($jadwal) {
                echo json_encode(['sukses' => $jadwal]);
            } else {
                echo json_encode(['error' => 'Jadwal tidak ditemukan']);
            }
        }
    }

    // Frontend - Jadwal by jenis
    public function jenis($jenis = null)
    {
        if (!$jenis) return redirect()->to('jadwal');

        $konfigurasi = $this->konfigurasi->vkonfig();
        
        
        $jadwal = $this->jadwalpelayanan->byjenis($jenis);

        $data = [
            'title'         => 'Jadwal ' . ucwords(str_replace('-', ' ', $jenis)) . ' | ' . $konfigurasi->nama,
            'deskripsi'     => 'Jadwal ' . ucwords(str_replace('-', ' ', $jenis)),
            'url'           => base_url('jadwal/jenis/' . $jenis),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            
            'jadwal'        => $jadwal,
            'jenis'         => $jenis,
        ];

        return view('frontend/desktop/content/jadwal_jenis', $data);
    }

    // Widget jadwal untuk homepage
    public function widget()
    {
        $jadwal = $this->jadwalpelayanan->upcoming(5);
        
        $data = [
            'jadwal' => $jadwal
        ];

        return view('frontend/widgets/jadwal_widget', $data);
    }
}
