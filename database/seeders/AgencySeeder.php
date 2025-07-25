<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agency::create([
            'name' => 'Dinas Komunikasi dan Informatika'
        ]);
        Agency::create([
            'name' => 'Dinas Kesehatan'
        ]);
        Agency::create([
            'name' => 'Dinas Pekerjaan Umum dan Tata Ruang'
        ]);
        Agency::create([
            'name' => 'Dinas Kawasan Ekonomi Khusus Sei Mangkei'
        ]);
        Agency::create([
            'name' => 'Dinas Perumahan Dan Kawasan Permukiman Serta'
        ]);
        Agency::create([
            'name' => 'Dinas Pertanian'
        ]);
        Agency::create([
            'name' => 'Dinas Ketahanan Pangan dan Perikanan'
        ]);
        Agency::create([
            'name' => 'Dinas Pendidikan'
        ]);
        Agency::create([
            'name' => 'Dinas Perpustakaan dan Arsip'
        ]);
        Agency::create([
            'name' => 'Dinas Ketenagakerjaan'
        ]);
        Agency::create([
            'name' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'
        ]);
        Agency::create([
            'name' => 'Dinas Pemberdayaan Perempuan Dan Perlindungan Anak'
        ]);
        Agency::create([
            'name' => 'Dinas Kebudayaan, Pariwisata dan Ekonomi Kreatif'
        ]);
        Agency::create([
            'name' => 'Dinas Pemuda dan Olahraga'
        ]);
        Agency::create([
            'name' => 'Dinas Perhubungan'
        ]);
        Agency::create([
            'name' => 'Dinas Sosial'
        ]);
        Agency::create([
            'name' => 'Dinas Perindustrian dan Perdagangan'
        ]);
        Agency::create([
            'name' => 'Dinas Koperasi, Usaha Kecil dan Menengah'
        ]);
        Agency::create([
            'name' => 'Dinas Pengendalian Penduduk dan Keluarga Berencana'
        ]);
        Agency::create([
            'name' => 'Dinas Kependudukan dan Pencatatan Sipil'
        ]);
        Agency::create([
            'name' => 'Dinas Pemberdayaan Masyarakat dan Nagori'
        ]);
        Agency::create([
            'name' => 'Dinas Lingkungan Hidup'
        ]);
        Agency::create([
            'name' => 'Badan Perencanaan Pembangunan, Riset dan Inovasi'
        ]);
        Agency::create([
            'name' => 'Inspektur Daerah'
        ]);
        Agency::create([
            'name' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia'
        ]);
        Agency::create([
            'name' => 'Badan Kesatuan Bangsa Dan Politik'
        ]);
        Agency::create([
            'name' => 'Badan Pengelolaan Keuangan dan Pendapatan Daerah'
        ]);
        Agency::create([
            'name' => 'Badan Penanggulangan Bencana Daerah'
        ]);
        Agency::create([
            'name' => 'RSUD Tuan Rondahaim'
        ]);
        Agency::create([
            'name' => 'RSUD Perdagangan'
        ]);
        Agency::create([
            'name' => 'RSUD Parapat'
        ]);
    }
}
