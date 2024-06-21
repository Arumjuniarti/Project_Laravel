<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        // Tambahkan data baru ke tabel 'peserta'
        Peserta::create([
            'id_peserta' => '097642',
            'nama' => 'Aldy',
            'sekolah' => 'SMKN2 Sumbawa Besar',
            'jurusan' => 'Teknik Kendaraan Ringan',
            'no_hp' => '082339168752',
            'alamat' => 'Talwa',
        ]);
    }
}
