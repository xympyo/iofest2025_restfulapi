<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Assume category IDs are 1: Cognitive, 2: Sensory, 3: Motory, 4: Emotional
        $activities = [
            // --- Cognitive Activities (ID: 1) ---
            ['activity_category_id' => 1, 'title' => 'Pasangan Memori', 'description' => 'Temukan pasangan kartu yang cocok.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Puzzle Sederhana', 'description' => 'Selesaikan puzzle jigsaw kecil yang sesuai usia.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Apa Selanjutnya?', 'description' => 'Buat pola sederhana (misalnya, tepuk tangan, hentakkan kaki, tepuk tangan, hentakkan kaki) dan minta anak Anda menyelesaikannya.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Lomba Berhitung', 'description' => 'Hitung setinggi mungkin bersama dalam satu menit. Kemudian coba kalahkan rekor Anda!', 'duration_minutes' => 2],
            ['activity_category_id' => 1, 'title' => 'Temukan Warna', 'description' => 'Sebutkan sebuah warna dan minta anak Anda menemukan lima benda dengan warna tersebut di ruangan.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Pembuka Cerita', 'description' => 'Mulai cerita dengan satu kalimat dan biarkan anak Anda menambahkan kalimat berikutnya, bergantian.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Perburuan Bentuk', 'description' => 'Cari di sekitar ruangan dan temukan benda-benda yang cocok dengan bentuk tertentu (lingkaran, persegi, segitiga).', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Cocokkan Suara Hewan', 'description' => 'Buat suara hewan dan minta anak Anda menebak hewannya.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Permainan Rima', 'description' => 'Ucapkan kata sederhana dan bergantian memikirkan kata-kata yang berima dengannya.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Mana yang Berbeda?', 'description' => 'Letakkan 3-4 benda, dengan salah satunya jelas berbeda. Minta anak Anda mengidentifikasi yang berbeda.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Menyortir Itu Asyik', 'description' => 'Sortir tumpukan kecil benda-benda campur (misalnya, balok, mainan) berdasarkan warna, ukuran, atau jenisnya.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Apa yang Hilang?', 'description' => 'Letakkan beberapa benda di atas meja, minta anak Anda menutup mata, singkirkan satu benda, dan tanyakan apa yang hilang.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Permainan Berlawanan', 'description' => 'Ucapkan sebuah kata (misalnya, "panas") dan minta anak Anda mengucapkan kebalikannya ("dingin").', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Arahan Sederhana', 'description' => 'Berikan anak Anda arahan dua langkah (misalnya, "Sentuh hidungmu, lalu tepuk tanganmu").', 'duration_minutes' => 2],
            ['activity_category_id' => 1, 'title' => 'Pengenalan Angka', 'description' => 'Tunjuk angka (di buku, jam, dll.) dan minta anak Anda mengidentifikasinya.', 'duration_minutes' => 3],


            // --- Sensory Activities (ID: 2) ---
            ['activity_category_id' => 2, 'title' => 'Perburuan Tekstur', 'description' => 'Temukan benda-benda dengan tekstur berbeda di sekitar rumah dan jelaskan bagaimana rasanya saat disentuh.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Tebak Suara', 'description' => 'Tutup mata dan identifikasi suara-suara rumah tangga yang umum (misalnya, air mengalir, membuka tas).', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Menyortir Warna', 'description' => 'Sortir mainan atau pakaian berdasarkan warna, sebutkan setiap warna saat Anda melakukannya.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Sentuhan Tas Misteri', 'description' => 'Masukkan benda umum ke dalam tas dan minta anak Anda menebaknya dengan sentuhan.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Dengarkan Dunia', 'description' => 'Duduklah dengan tenang selama satu menit dan tunjukkan semua suara yang dapat Anda dengar baik di dalam maupun di luar.', 'duration_minutes' => 2],
            ['activity_category_id' => 2, 'title' => 'Permainan Tebak Aroma', 'description' => 'Tutup mata anak Anda (atau minta mereka menutup mata) dan biarkan mereka mencium benda-benda aman (misalnya, buah, rempah-rempah) dan menebak.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Bermain Es', 'description' => 'Biarkan anak Anda menjelajahi semangkuk es batu dengan tangan mereka, jelaskan bagaimana rasanya.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Pencampuran Warna', 'description' => 'Gunakan beberapa tetes pewarna makanan dalam air untuk menjelajahi bagaimana warna bercampur.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Bermain Air', 'description' => 'Sediakan semangkuk kecil air dengan cangkir, spons, atau mainan kecil untuk eksplorasi bebas.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Jelajahi Wadah Sensorik', 'description' => 'Jika Anda memiliki wadah sensorik (beras, kacang-kacangan, pasta), biarkan anak Anda menjelajahinya dengan sendok kecil atau mainan.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Rasakan Kainnya', 'description' => 'Jelajahi kain yang berbeda (misalnya, sutra, katun, wol) dan bicarakan bagaimana rasanya.', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Permainan Cahaya dan Bayangan', 'description' => 'Gunakan senter untuk membuat bayangan di dinding dan membuat bentuk atau hewan.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Melihat Awan', 'description' => 'Berbaring di luar atau melihat keluar jendela dan jelaskan bentuk-bentuk yang Anda lihat di awan.', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Pengocok Suara', 'description' => 'Masukkan benda-benda berbeda (beras, manik-manik, koin) ke dalam wadah kecil dan dengarkan suara-suara yang berbeda.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Asyiknya Lonceng Angin', 'description' => 'Buat lonceng angin sederhana menggunakan barang-barang rumah tangga biasa dan gantung untuk mendengarkan suaranya.', 'duration_minutes' => 5],


            // --- Motory Activities (ID: 3) ---
            ['activity_category_id' => 3, 'title' => 'Jumping Jacks', 'description' => 'Lakukan 10 jumping jack bersama-sama.', 'duration_minutes' => 2],
            ['activity_category_id' => 3, 'title' => 'Jalan Keseimbangan', 'description' => 'Berjalanlah dalam garis lurus (atau di atas garis yang digambar) tanpa terjatuh, seperti seorang peniti tali.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Lempar Bola', 'description' => 'Lempar bola lunak bolak-balik, atau ke dalam keranjang.', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Jalan Hewan', 'description' => 'Merangkak seperti beruang, berjalan terhuyung-huyung seperti bebek, melompat seperti kelinci melintasi ruangan.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Rintangan Bantal', 'description' => 'Susun bantal untuk membuat jalur sederhana untuk merangkak di atas, di bawah, dan di sekitarnya.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Jaga Balon di Udara', 'description' => 'Cobalah menjaga balon agar tidak jatuh ke tanah hanya menggunakan tangan, kaki, atau kepala.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Latihan Target', 'description' => 'Remas kertas dan coba lemparkan ke dalam ember kecil atau kotak dari jarak dekat.', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Pesta Dansa!', 'description' => 'Putar lagu favorit dan menari bebas bersama.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Ikuti Pemimpin', 'description' => 'Bergantian memimpin gerakan sederhana seperti berbaris, berjingkat, atau meregangkan badan.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Simon Berkata', 'description' => 'Mainkan permainan cepat Simon Says dengan tindakan seperti "Simon berkata sentuh jari kakimu."', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Lomba Merangkak', 'description' => 'Berlomba satu sama lain melintasi ruangan dengan merangkak menggunakan tangan dan lutut.', 'duration_minutes' => 2],
            ['activity_category_id' => 3, 'title' => 'Membangun Balok/Menara', 'description' => 'Bangun menara setinggi mungkin dengan balok atau bantal sebelum runtuh!', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Pose Yoga', 'description' => 'Coba beberapa pose yoga sederhana bertema hewan (misalnya, kucing-sapi, downward dog).', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Melukis Jari (Tanpa Berantakan)', 'description' => 'Masukkan cat ke dalam kantong Ziploc dan biarkan anak Anda "melukis jari" dengan meremas kantong.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Merobek Kertas', 'description' => 'Berikan anak Anda koran bekas atau surat sampah untuk dirobek menjadi potongan-potongan kecil (bagus untuk motorik halus).', 'duration_minutes' => 4],


            // --- Emotional Activities (ID: 4) ---
            ['activity_category_id' => 4, 'title' => 'Drama Perasaan', 'description' => 'Peragakan berbagai emosi (senang, sedih, marah) dan minta anak Anda menebaknya.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Apa yang Membuatku Merasa...', 'description' => 'Bicarakan apa yang membuat Anda merasa senang, sedih, atau gembira dan tanyakan hal yang sama kepada anak Anda.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Momen Syukur', 'description' => 'Bagikan satu hal yang Anda syukuri hari ini, lalu tanyakan kepada anak Anda.', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Lingkaran Pujian', 'description' => 'Berikan pujian kepada anak Anda, dan dorong mereka untuk membalasnya.', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Sudut Tenang', 'description' => 'Latih latihan pernapasan dalam sederhana atau temukan tempat yang tenang untuk bersantai sejenak.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Mengatakan "Aku Sayang Kamu"', 'description' => 'Bergantian memberi tahu satu sama lain satu hal yang Anda sukai dari orang lain.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Pertunjukan Boneka Empati', 'description' => 'Gunakan boneka jari atau mainan untuk memerankan skenario singkat di mana satu karakter sedih, dan yang lain membantu.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Afirmasi Positif', 'description' => 'Lihatlah ke cermin dan katakan hal-hal positif tentang diri Anda (misalnya, "Aku baik," "Aku kuat").', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Aturan Berbagi', 'description' => 'Diskusikan mengapa berbagi itu penting dan latih bergantian dengan mainan.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Hal-hal Favoritku', 'description' => 'Bicarakan tentang hal-hal favorit Anda (makanan, mainan, warna) dan tanyakan kepada anak Anda tentang hal favorit mereka.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Tangan Penolong', 'description' => 'Temukan satu cara kecil untuk membantu seseorang dalam keluarga atau di sekitar rumah (misalnya, menyimpan mainan).', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Catatan Terima Kasih (Lisan)', 'description' => 'Latih secara lisan mengucapkan terima kasih kepada seseorang (nyata atau khayalan) untuk sesuatu.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Menggambar Wajah Perasaan', 'description' => 'Gambar wajah sederhana yang menunjukkan emosi yang berbeda dan bicarakan bagaimana setiap emosi terasa.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Latihan Meminta Maaf', 'description' => 'Bermain peran cara meminta maaf ketika Anda melakukan kesalahan, menggunakan kata-kata yang sopan.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Curah Gagasan Perlengkapan Kenyamanan', 'description' => 'Bicarakan hal-hal yang membantu Anda merasa lebih baik saat Anda sedih atau marah (misalnya, pelukan, selimut).', 'duration_minutes' => 5],
        ];

        foreach ($activities as $activity) {
            DB::table('activity')->insert([
                'activity_category_id' => $activity['activity_category_id'],
                'title' => $activity['title'],
                'description' => $activity['description'],
                'duration_minutes' => $activity['duration_minutes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
