<?php

namespace Database\Seeders;

use App\Models\ProfilKampung;
use Illuminate\Database\Seeder;

class ProfilKampungSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'tentang_judul' => 'Brontokusuman',
            'tentang_isi' => "Kampung Brontokusuman merupakan salah satu kampung yang terletak di Kecamatan Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta. Kampung ini dikenal dengan kekayaan budaya dan tradisi yang masih terjaga hingga saat ini.\n\nBerbagai kesenian tradisional, upacara adat, dan warisan budaya lainnya masih dilestarikan oleh masyarakat setempat menjadi bagian penting dari identitas kampung.",
            'lokasi' => 'Kec. Mergangsan, Yogyakarta',
            'penduduk' => '± 3.000 Jiwa',
            'kecamatan' => 'Mergangsan',
            'kota' => 'Yogyakarta',
            'telepon' => '+62 274 XXX XXX',
            'email' => 'info@brontokusuman.id',
            'alamat' => 'Jl. Prawirotaman 2, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta, DI Yogyakarta 55153',
            'visi' => 'Melestarikan dan memajukan kebudayaan Kampung Brontokusuman agar tetap lestari dan dikenal luas.',
            'misi' => "1. Melestarikan kesenian dan tradisi tradisional\n2. Mendokumentasikan warisan budaya kampung\n3. Memberikan edukasi kebudayaan kepada generasi muda\n4. Memperkenalkan kebudayaan Kampung ke tingkat nasional dan internasional",
        ];

        foreach ($data as $key => $value) {
            ProfilKampung::set($key, $value);
        }
    }
}
