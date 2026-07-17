<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'tentang_judul' => 'Brontokusuman',
            'tentang_isi' => "Desa Brontokusuman merupakan salah satu desa yang terletak di Kecamatan Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta. Desa ini dikenal dengan kekayaan budaya dan tradisi yang masih terjaga hingga saat ini.\n\nBerbagai kesenian tradisional, upacara adat, dan warisan budaya lainnya masih dilestarikan oleh masyarakat setempat menjadi bagian penting dari identitas desa.",
            'lokasi' => 'Kec. Mergangsan, Yogyakarta',
            'penduduk' => '± 3.000 Jiwa',
            'kecamatan' => 'Mergangsan',
            'kota' => 'Yogyakarta',
            'telepon' => '+62 274 XXX XXX',
            'email' => 'info@brontokusuman.id',
            'alamat' => 'Jl. Prawirotaman 2, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta, DI Yogyakarta 55153',
            'visi' => 'Melestarikan dan memajukan kebudayaan Desa Brontokusuman agar tetap lestari dan dikenal luas.',
            'misi' => "1. Melestarikan kesenian dan tradisi tradisional\n2. Mendokumentasikan warisan budaya desa\n3. Memberikan edukasi kebudayaan kepada generasi muda\n4. Memperkenalkan kebudayaan desa ke tingkat nasional dan internasional",
        ];

        foreach ($data as $key => $value) {
            ProfilDesa::set($key, $value);
        }
    }
}
