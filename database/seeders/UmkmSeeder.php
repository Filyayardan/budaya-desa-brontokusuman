<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $umkm = [
            [
                'nama_usaha' => 'Gudeg Bu Rum',
                'pemilik' => 'Rumiyati',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Gudeg khas Yogyakarta dengan resep turun-temurun, disajikan dengan ayam, telur, dan krecek.',
                'alamat' => 'Jl. Brontokusuman No. 15',
                'kontak' => '+62 812 3456 7890',
                'latitude' => -7.8158200,
                'longitude' => 110.3692000,
            ],
            [
                'nama_usaha' => 'Batik Tulis Dewi Ayu',
                'pemilik' => 'Dewi Lestari',
                'kategori' => 'Batik & Kerajinan',
                'deskripsi' => 'Batik tulis bermotif khas Brontokusuman yang dibuat secara manual oleh pengrajin kampung.',
                'alamat' => 'Jl. Brontokusuman Gang II No. 8',
                'kontak' => '+62 878 1234 5678',
                'latitude' => -7.8171500,
                'longitude' => 110.3704500,
            ],
            [
                'nama_usaha' => 'Warung Nasi Kucing Bronto',
                'pemilik' => 'Slamet Riyadi',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Nasi kucing lengkap dengan sego kucing, sambal goreng tempe, dan lauk pendamping khas Jawa.',
                'alamat' => 'Jl. Karanganyar No. 21',
                'kontak' => '+62 856 9876 5432',
                'latitude' => -7.8163500,
                'longitude' => 110.3712500,
            ],
            [
                'nama_usaha' => 'Sanggar Kerajinan Rotan',
                'pemilik' => 'Joko Susilo',
                'kategori' => 'Kerajinan',
                'deskripsi' => 'Kerajinan anyaman rotan dan bambu seperti keranjang, tas, dan dekorasi rumah.',
                'alamat' => 'Jl. Purbayan No. 4',
                'kontak' => '+62 813 5678 9012',
                'latitude' => -7.8179500,
                'longitude' => 110.3697500,
            ],
            [
                'nama_usaha' => 'Kopi Senja Brontokusuman',
                'pemilik' => 'Agus Pratama',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Kedai kopi rumahan dengan suasana kampung yang nyaman, menyajikan kopi khas Jawa.',
                'alamat' => 'Jl. Brontokusuman No. 30',
                'kontak' => '+62 822 4567 8901',
                'latitude' => -7.8166500,
                'longitude' => 110.3706500,
            ],
            [
                'nama_usaha' => 'Jamu Mbok Jam',
                'pemilik' => 'Siti Aminah',
                'kategori' => 'Kuliner & Herbal',
                'deskripsi' => 'Jamu tradisional gendong seperti kunyit asam, beras kencur, dan sinom yang menyegarkan.',
                'alamat' => 'Jl. Brontokusuman Gang I No. 2',
                'kontak' => '+62 811 2233 4455',
                'latitude' => -7.8152500,
                'longitude' => 110.3703500,
            ],
        ];

        foreach ($umkm as $u) {
            DB::table('umkm')->insert($u + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
