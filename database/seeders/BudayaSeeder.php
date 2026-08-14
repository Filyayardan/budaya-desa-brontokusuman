<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudayaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriIds = [];
        $kategori = [
            ['nama_kategori' => 'Tari Tradisional', 'deskripsi' => 'Tarian tradisional yang menjadi warisan budaya kampung', 'ikon' => 'fa-person-walking', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Musik Tradisional', 'deskripsi' => 'Alat musik dan karawitan tradisional', 'ikon' => 'fa-music', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Seni Rupa', 'deskripsi' => 'Karya seni rupa dan kerajinan tradisional', 'ikon' => 'fa-palette', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Tradisi & Upacara', 'deskripsi' => 'Upacara adat dan tradisi turun temurun', 'ikon' => 'fa-torii-gate', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kuliner Tradisional', 'deskripsi' => 'Makanan dan minuman khas kampung', 'ikon' => 'fa-bowl-food', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kesenian Lainnya', 'deskripsi' => 'Jenis kesenian lain yang berkembang di kampung', 'ikon' => 'fa-masks-theater', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($kategori as $k) {
            $kategoriIds[] = DB::table('kategori_budaya')->insertGetId($k);
        }

        $budaya = [
            ['kategori_id' => $kategoriIds[0], 'judul' => 'Tari Bedhaya', 'deskripsi' => 'Tari bedhaya merupakan tarian sakral yang dibawakan oleh sembilan penari wanita. Tarian ini menggambarkan keharmonisan dan keselarasan hidup.', 'deskripsi_lengkap' => 'Tari Bedhaya adalah salah satu tarian tertua dan paling sakral dalam tradisi Jawa. Tarian ini dibawakan oleh sembilan orang penari wanita dengan gerakan yang sangat halus dan penuh makna filosofis.\n\nSetiap gerakan dalam Tari Bedhaya memiliki simbol tersendiri, menggambarkan perjalanan spiritual dan keharmonisan alam semesta. Tarian ini biasanya dipentaskan dalam acara-acara kerajaan dan upacara adat penting lainnya.\n\nDi Kampung Brontokusuman, Tari Bedhaya masih dilestarikan dan dipentaskan pada saat-saat tertentu sebagai bagian dari pelestarian budaya Jawa.', 'lokasi' => 'Balai Kampung Brontokusuman', 'latitude' => -7.8169000, 'longitude' => 110.3695000, 'unggulan' => true, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[0], 'judul' => 'Tari Gambyong', 'deskripsi' => 'Tari Gambyong adalah tarian penyambutan yang menggambarkan keanggunan dan keramahan perempuan Jawa.', 'deskripsi_lengkap' => 'Tari Gambyong merupakan tarian tradisional Jawa yang sering digunakan sebagai tarian penyambutan tamu kehormatan. Tarian ini dibawakan oleh kelompok penari wanita dengan busana kebaya dan kain batik.\n\nGerakan Tari Gambyong sangat lembut dan anggun, mencerminkan sifat-sifat mulia perempuan Jawa seperti kelembutan, kesabaran, dan keramahan.\n\nTarian ini selalu menjadi pengisi acara dalam berbagai hajatan dan perayaan di kampung.', 'lokasi' => ' Pendopo Kampung', 'latitude' => -7.8175000, 'longitude' => 110.3701000, 'unggulan' => true, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[1], 'judul' => 'Gamelan Jawa', 'deskripsi' => 'Gamelan adalah seperangkat alat musik tradisional Jawa yang terdiri dari berbagai instrumen perunggu.', 'deskripsi_lengkap' => 'Gamelan Jawa adalah ensembel musik tradisional yang terdiri dari berbagai alat musik seperti saron, bonang, gong, kendang, dan slenthem. Alat-alat ini terbuat dari perunggu dan kayu pilihan.\n\nDi Kampung Brontokusuman, gamelan masih dilestarikan dan dimainkan dalam berbagai acara adat, wayang kulit, dan pertunjukan seni lainnya. Para sesepuh kampung secara turun-temurun mengajarkan cara memainkan gamelan kepada generasi muda.\n\nSuara gamelan yang khas dan merdu menjadi bagian tak terpisahkan dari kehidupan budaya masyarakat kampung.', 'lokasi' => 'Padhepokan Seni Kampung', 'latitude' => -7.8161000, 'longitude' => 110.3710000, 'unggulan' => true, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[2], 'judul' => 'Batik Tulis Brontokusuman', 'deskripsi' => 'Seni membatik dengan teknik tulis tangan yang menghasilkan karya unik bermotif khas kampung.', 'deskripsi_lengkap' => 'Batik Tulis Brontokusuman merupakan warisan seni membatik yang diwariskan secara turun-temurun. Motif-motif batik yang dihasilkan memiliki ciri khas tersendiri yang menggambarkan alam dan kehidupan masyarakat kampung.\n\nProses pembuatan batik tulis ini memerlukan ketelitian dan kesabaran tinggi. Dari mulai menggambar pola, mencanting, hingga pewarnaan, semuanya dilakukan secara manual oleh para pengrajin terampil.\n\nSetiap lembar batik tulis Brontokusuman merupakan karya seni yang memiliki nilai tinggi dan tidak ada duanya.', 'lokasi' => 'Workshop Batik Warga', 'latitude' => -7.8172000, 'longitude' => 110.3705500, 'unggulan' => false, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[3], 'judul' => 'Sedekah Bumi', 'deskripsi' => 'Upacara adat sedekah bumi sebagai ungkapan rasa syukur atas hasil bumi yang melimpah.', 'deskripsi_lengkap' => 'Sedekah Bumi adalah upacara adat tahunan yang dilakukan oleh masyarakat Kampung Brontokusuman sebagai ungkapan rasa syukur kepada Tuhan atas segala karunia dan hasil bumi yang melimpah.\n\nUpacara ini diawali dengan arak-arakan yang diikuti oleh seluruh warga kampung, dilanjutkan dengan doa bersama dan ritual tradisional di makam leluhur kampung.\n\nAcara ini menjadi momen penting untuk mempererat tali silaturahmi antar warga sekaligus melestarikan tradisi nenek moyang.', 'lokasi' => 'Alun-alun Kampung', 'latitude' => -7.8178000, 'longitude' => 110.3708000, 'unggulan' => true, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[4], 'judul' => 'Gudeg Brontokusuman', 'deskripsi' => 'Masakan tradisional khas kampung dengan cita rasa manis dan khas dari bahan nangka muda.', 'deskripsi_lengkap' => 'Gudeg Brontokusuman adalah salah satu kuliner khas yang sudah dikenal luas. Menggunakan resep turun-temurun, gudeg ini memiliki cita rasa yang khas dengan perpaduan rasa manis dan gurih yang sempurna.\n\nBahan utama berupa nangka muda dimasak dengan santan dan bumbu rempah pilihan selama berjam-jam hingga empuk dan meresap. Disajikan dengan nasi, ayam opor, telur, dan sambal krecek.\n\nResep asli ini dijaga turun-temurun oleh para tetua kampung dan menjadi salah satu daya tarik kuliner yang patut dicoba.', 'lokasi' => 'Warung Warga', 'latitude' => -7.8158000, 'longitude' => 110.3692500, 'unggulan' => false, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[5], 'judul' => 'Wayang Kulit', 'deskripsi' => 'Pertunjukan wayang kulit dengan cerita pewayangan yang sarat akan nilai dan filosofi hidup.', 'deskripsi_lengkap' => 'Wayang Kulit di Kampung Brontokusuman merupakan salah satu kesenian yang paling diminati. Pertunjukan wayang kulit biasanya digelar dalam acara-acara besar seperti slametan kampung, pernikahan, dan hari-hari besar tertentu.\n\nDalang yang memainkan wayang kulit tidak hanya menceritakan kisah-kisah pewayangan seperti Mahabharata dan Ramayana, tetapi juga menyelipkan nilai-nilai luhur dan nasihat tentang kehidupan.\n\nPertunjukan ini diiringi oleh gamelan Jawa lengkap yang menciptakan suasana magis dan khas.', 'lokasi' => 'Pendopo Kampung', 'latitude' => -7.8174500, 'longitude' => 110.3701500, 'unggulan' => true, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $kategoriIds[3], 'judul' => 'Grebeg Suro', 'deskripsi' => 'Tradisi Grebeg Suro yang diadakan setiap tahun pada bulan Suro dalam penanggalan Jawa.', 'deskripsi_lengkap' => 'Grebeg Suro adalah tradisi tahunan yang digelar pada bulan Suro (Muharram) dalam penanggalan Jawa. Tradisi ini merupakan bentuk syukur masyarakat atas segala nikmat yang diterima.\n\nDalam pelaksanaannya, diadakan kirab pusaka kampung, pembagian gunungan hasil bumi, dan berbagai kesenian tradisional lainnya. Seluruh warga kampung berpartisipasi aktif dalam pelaksanaan tradisi ini.\n\nGrebeg Suro menjadi momentum penting untuk memperkuat kebersamaan dan kekompakan masyarakat kampung.', 'lokasi' => 'Masjid Kampung', 'latitude' => -7.8162000, 'longitude' => 110.3690000, 'unggulan' => false, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($budaya as $b) {
            DB::table('budaya')->insert($b);
        }

        $acara = [
            ['nama_acara' => 'Festival Budaya Brontokusuman', 'deskripsi' => 'Festival tahunan yang menampilkan berbagai kesenian dan kebudayaan Kampung Brontokusuman. Acara ini menghadirkan pertunjukan tari, musik, pameran kerajinan, dan kuliner tradisional.', 'lokasi' => 'Alun-alun Kampung Brontokusuman', 'latitude' => -7.8178000, 'longitude' => 110.3708000, 'tanggal_mulai' => '2026-08-15', 'tanggal_selesai' => '2026-08-17', 'status' => 'upcoming', 'created_at' => now(), 'updated_at' => now()],
            ['nama_acara' => 'Pentas Gamelan dan Tari', 'deskripsi' => 'Pentas seni gamelan dan tari tradisional yang diselenggarakan secara rutin setiap bulan untuk melestarikan kesenian tradisional.', 'lokasi' => 'Pendopo Kampung Brontokusuman', 'latitude' => -7.8175000, 'longitude' => 110.3701000, 'tanggal_mulai' => '2026-08-01', 'tanggal_selesai' => null, 'status' => 'upcoming', 'created_at' => now(), 'updated_at' => now()],
            ['nama_acara' => 'Workshop Batik Tulis', 'deskripsi' => 'Pelatihan membatik tulis untuk generasi muda kampung guna melestarikan seni batik tulis khas Brontokusuman.', 'lokasi' => 'Balai Kampung', 'latitude' => -7.8169000, 'longitude' => 110.3695000, 'tanggal_mulai' => '2026-07-20', 'tanggal_selesai' => '2026-07-22', 'status' => 'upcoming', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($acara as $a) {
            DB::table('acara')->insert($a);
        }

        $berita = [
            ['judul' => 'Festival Budaya 2026 Akan Digelar Agustus Mendatang', 'ringkasan' => 'Festival budaya tahunan Kampung Brontokusuman akan kembali digelar pada bulan Agustus 2026 dengan konsep yang lebih meriah.', 'isi' => '<p>Festival Budaya Brontokusuman 2026 akan diselenggarakan pada tanggal 15-17 Agustus 2026 mendatang. Festival yang menjadi agenda tahunan kampung ini akan menghadirkan berbagai penampilan kesenian tradisional, pameran kerajinan, hingga festival kuliner khas kampung.</p><p>Tahun ini festival akan mengangkat tema "Melestarikan Warisan, Menjaga Identitas" yang bertujuan untuk mengajak generasi muda lebih mencintai dan melestarikan budaya lokal.</p><p>Seluruh warga kampung diharapkan dapat berpartisipasi aktif dalam festival tahun ini.</p>', 'penulis' => 'Kepala Kampung', 'featured' => true, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Workshop Batik Tulis untuk Generasi Muda', 'ringkasan' => 'Pemerintah kampung mengadakan workshop batik tulis gratis untuk pemuda-pemudi kampung guna melestarikan seni batik.', 'isi' => '<p>Dalam rangka melestarikan seni batik tulis khas Brontokusuman, pemerintah kampung mengadakan workshop batik tulis gratis yang ditujukan untuk generasi muda usia 15-25 tahun.</p><p>Workshop ini akan diadakan selama 3 hari di Balai Kampung dan dipandu oleh para pengrajin batik senior yang sudah puluhan tahun berkecimpung dalam dunia perbatikan.</p>', 'penulis' => 'Sekretaris Kampung', 'featured' => false, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Pelestarian Gamelan Jawa di Era Modern', 'ringkasan' => 'Upaya masyarakat kampung dalam melestarikan gamelan Jawa menghadapi tantangan zaman modern.', 'isi' => '<p>Era digital membawa tantangan tersendiri bagi pelestarian kesenian tradisional termasuk gamelan Jawa. Namun masyarakat Kampung Brontokusuman tetap berkomitmen untuk melestarian warisan budaya ini.</p><p>Berbagai langkah telah diambil termasuk mengadakan kelas gamelan rutin, membuat rekaman digital, hingga kolaborasi dengan musisi modern untuk memperkenalkan gamelan ke khalayak yang lebih luas.</p>', 'penulis' => 'Tim Budaya Kampung', 'featured' => false, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($berita as $b) {
            DB::table('berita')->insert($b);
        }

        $sejarah = [
            ['judul' => 'Asal Usul Nama Brontokusuman', 'isi' => 'Kampung Brontokusuman memiliki sejarah panjang yang bermula dari zaman kerajaan Mataram. Nama "Brontokusuman" diyakini berasal dari kata "Bronto" yang berarti kekuatan dan "Kusuman" yang berarti bunga atau keharuman. Kampung ini didirikan oleh para abdi dalem kerajaan yang memilih untuk menetap di daerah ini setelah masa kerajaan berpindah.', 'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Masa Penjajahan dan Perjuangan', 'isi' => 'Pada masa penjajahan Belanda, Kampung Brontokusuman menjadi salah satu kampung yang aktif dalam perjuangan kemerdekaan. Warga kampung turut serta dalam berbagai gerakan perlawanan. Tradisi gotong royong dan kekompakan masyarakat yang terbentuk sejak masa kerajaan menjadi bekal utama dalam perjuangan ini.', 'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Pelestarian Budaya Pasca Kemerdekaan', 'isi' => 'Setelah kemerdekaan, masyarakat Kampung Brontokusuman semakin giat dalam melestarikan berbagai tradisi dan kesenian yang diwariskan oleh nenek moyang. Didirikannya padhepokan seni dan sanggar budaya menjadi langkah konkret dalam upaya pelestarian ini. Berbagai kesenian seperti gamelan, tari tradisional, dan batik tulis terus dilestarikan hingga kini.', 'urutan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Brontokusuman di Era Modern', 'isi' => 'Di era modern saat ini, Kampung Brontokusuman terus beradaptasi tanpa meninggalkan akar budayanya. Teknologi dimanfaatkan untuk mempromosikan kebudayaan kampung ke kancah nasional dan internasional. Website kebudayaan ini adalah salah satu bentuk upaya digitalisasi untuk memperkenalkan kekayaan budaya Brontokusuman kepada dunia.', 'urutan' => 4, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($sejarah as $s) {
            DB::table('sejarah')->insert($s);
        }

        $pengurus = [
            ['nama' => 'Sukamto', 'jabatan' => 'Ketua Pengurus Budaya', 'telepon' => '+62 812 XXX XXX', 'email' => 'sukamto@brontokusuman.id', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sri Wahyuni', 'jabatan' => 'Sekretaris', 'telepon' => '+62 813 XXX XXX', 'email' => 'sriwahyuni@brontokusuman.id', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Budi Santoso', 'jabatan' => 'Koordinator Seni & Tradisi', 'telepon' => '+62 856 XXX XXX', 'email' => 'budisantoso@brontokusuman.id', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Dewi Lestari', 'jabatan' => 'Koordinator Pendidikan Budaya', 'telepon' => '+62 878 XXX XXX', 'email' => 'dewilestari@brontokusuman.id', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($pengurus as $p) {
            DB::table('pengurus')->insert($p);
        }
    }
}
