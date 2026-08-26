-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2026 at 12:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `slug`, `kategori`, `konten`, `gambar`, `is_published`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Biografi B.J. Habibie', 'biografi-bj-habibie-ItyuDv', 'Artikel Literasi', '<div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_bq\" data-hveid=\"CAIIAQgnEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\"><span data-subtree=\"aimfl\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Bacharuddin Jusuf Habibie, atau yang akrab disapa Rudy, lahir di Parepare, Sulawesi Selatan, pada 25 Juni 1936 sebagai anak keempat dari delapan bersaudara. Dibesarkan dalam keluarga berpendidikan oleh pasangan Alwi Abdul Jalil Habibie dan R.A. Tuti Marini Puspowardojo, Rudy kecil tumbuh menjadi anak yang sangat disiplin, gemar membaca, dan memiliki rasa ingin tahu yang luar biasa. Namun, sebuah titik balik yang berat harus ia hadapi ketika menginjak usia 14 tahun. Sang ayah meninggal dunia secara mendadak akibat serangan jantung saat sedang sujud dalam salat. Demi melanjutkan pendidikan anak-anaknya, sang ibu dengan gigih menjual rumah mereka di Parepare dan memboyong seluruh keluarga pindah ke Bandung.</span><!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_cs\" data-hveid=\"CAIIAQgsEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Di Bandung, kecerdasan Rudy dalam ilmu eksakta dan fisika mulai menarik perhatian, terutama saat ia menempuh pendidikan di SMA Kristen Dago. Ketertarikannya pada bidang teknik membawanya masuk ke Fakultas Teknik Institut Teknologi Bandung (ITB) pada tahun 1954. Namun, masa kuliahnya di ITB hanya bertahan selama enam bulan karena sang ibu bertekad membiayai Rudy untuk melanjutkan studi ke Jerman Barat tanpa mengandalkan beasiswa negara. Di RWTH Aachen, Rudy berjuang keras menahan rindu dan keterbatasan biaya. Dedikasi itu berbuah manis saat ia berhasil meraih gelar <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_d5\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Diplom-Ingenieur<!--TgQPHd|||[]--></em> dengan predikat <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_d7\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Cum Laude<!--TgQPHd|||[]--></em>, lalu melanjutkan hingga meraih gelar Doktor-Ingenieur di bidang teknik penerbangan dengan predikat tertinggi, <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_d8\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Summa Cum Laude<!--TgQPHd|||[]--></em>, pada tahun 1965.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_dj\" data-hveid=\"CAIIAQguEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Kecerdasan langka yang dimilikinya membuat industri penerbangan Jerman terpikat. Rudy kemudian berkarier di perusahaan dirgantara terkemuka, Messerschmitt-Bölkow-Blohm (MBB) di Hamburg, hingga berhasil menduduki posisi prestisius sebagai <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_dq\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Vice President<!--TgQPHd|||[]--></em> sekaligus Direktur Teknologi. Di sinilah ia menorehkan tinta emas dalam sejarah sains dunia lewat penemuan <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_dt\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Crack Propagation Theory<!--TgQPHd|||[]--></em> atau Teori Faktor Habibie. Rumus matematika buatannya mampu menghitung keretakan mikro pada badan pesawat secara akurat, sebuah penemuan revolusioner yang membuat penerbangan dunia menjadi jauh lebih aman dan memberinya julukan \"Mr. Crack\" dari komunitas internasional.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_e7\" data-hveid=\"CAIIAQg0EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Meski telah memiliki karier mapan dan kehidupan nyaman di Eropa, panggilan jiwa untuk mengabdi pada tanah air tidak pernah padam. Pada tahun 1974, Presiden Soeharto memanggilnya pulang untuk membangun industri dalam negeri. Tanpa ragu, Habibie melepaskan segala kemewahan di Jerman. Ia kemudian dipercaya menjabat sebagai Menteri Negara Riset dan Teknologi selama dua dekade. Di bawah kepemimpinannya, Indonesia mendirikan berbagai industri strategis, termasuk Industri Pesawat Terbang Nusantara (IPTN). Puncak mahakaryanya terjadi pada tahun 1995 ketika pesawat komersial N250 Gatotkaca berhasil terbang di langit Indonesia, membuktikan kepada dunia bahwa putra-putri bangsa mampu merancang teknologi tinggi secara mandiri.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_eg\" data-hveid=\"CAIIAQg7EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Puncak perjalanan politik Habibie datang secara tak terduga di tengah badai krisis moneter dan gejolak reformasi. Setelah sempat diangkat menjadi Wakil Presiden pada Maret 1998, ia langsung dilantik menjadi Presiden Ketiga Republik Indonesia hanya dua bulan setelahnya, tepat ketika Presiden Soeharto mengundurkan diri. Meskipun masa kepemimpinannya tergolong sangat singkat, yaitu hanya satu tahun empat bulan, Habibie berhasil melakukan reformasi krusial. Ia sukses menyelamatkan ekonomi Indonesia dari keterpurukan dengan menekan nilai tukar Rupiah dari belasan ribu hingga ke bawah Rp7.000 per Dolar AS. Ia juga membuka keran demokrasi yang selama ini tersumbat dengan menjamin kebebasan pers, membebaskan tahanan politik, dan menginisiasi undang-undang otonomi daerah. Langkah kepemimpinannya yang legawa juga terlihat saat laporan pertanggungjawabannya ditolak oleh MPR pasca-lepasnya Timor Timur melalui referendum, di mana ia memilih mundur dari bursa pencalonan presiden berikutnya demi menjaga stabilitas bangsa.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ep\" data-hveid=\"CAIIAQhAEAA\" data-processed=\"true\" aria-owns=\"action-menu-parent-container\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Di balik dinding karier dan politiknya yang luar biasa, hidup Habibie diwarnai oleh kisah cinta legendaris bersama istrinya, Hasri Ainun Besari. Menikah pada tahun 1962 dan dikaruniai dua putra, Ilham dan Thareq, Ainun adalah jangkar dan kekuatan terbesar dalam hidup Habibie. Kehilangan Ainun yang wafat akibat kanker pada tahun 2010 menjadi pukulan batin yang teramat berat, yang kemudian ia tuangkan dalam sebuah buku memoar yang menyentuh hati jutaan masyarakat Indonesia. Sembilan tahun setelah kepergian belahan jiwanya, tepatnya pada 11 September 2019, Sang Bapak Teknologi Indonesia mengembuskan napas terakhirnya di Jakarta pada usia 83 tahun. Jasadnya dimakamkan dengan penghormatan militer tertinggi di Taman Makam Pahlawan Kalibata, berdampingan dengan makam Ibu Ainun, menyatukan kembali cinta sejati mereka untuk selamanya.</div>', 'berita/35dw0wv4cc3lkU0JSXrsFuGC0nkZkrIVF7Zs6xir.jpg', 1, '2026-08-25 09:33:35', '2026-08-25 09:33:35', 1),
(2, 'R.A. Kartini', 'ra-kartini-onKabD', 'Artikel Literasi', '<div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_rk\" data-hveid=\"CAIIAQiZARAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Raden Adjeng Kartini lahir di Jepara, Jawa Tengah, pada tanggal 21 April 1879. Ia lahir di tengah keluarga bangsawan Jawa yang kental dengan adat istiadat, sebagai putri dari Raden Mas Adipati Ario Sosroningrat, seorang bupati Jepara, dan M.A. Ngasirah. Beruntung bagi Kartini, status sosial ayahnya membuat ia diizinkan bersekolah di <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_rs\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Europese Lagere School<!--TgQPHd|||[]--></em> (ELS) hingga usia 12 tahun. Di sekolah Belanda inilah Kartini belajar bahasa Belanda dengan sangat baik, sebuah keterampilan penting yang nantinya membuka jendela pemikirannya terhadap dunia luar yang jauh lebih luas dan modern. [<a href=\"https://papuapegunungan.kpu.go.id/blog/read/1885_siapa-saja-10-pahlawan-nasional-indonesia-yang-terkenal\">1</a>, <a href=\"https://www.facebook.com/bankanjukladang/videos/biografi-ra-kartinilahir-pada-21-april-1879-raden-ajeng-kartini-sendiri-dikenal-/508394190870071/\">2</a>, <a href=\"https://bpmpriau.kemendikdasmen.go.id/2017/04/20/r-a-kartini-tokoh-emansipasi-wanita/\">3</a>, <a href=\"https://news.detik.com/berita/d-5538364/hari-kartini-2021-biografi-ra-kartini-hingga-penetapan-pahlawan\">4</a>, <a href=\"https://www.academia.edu/29185974/Soekarno_Bapak_Bangsa_Indonesia\">5</a>]<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_th\" data-hveid=\"CAIIAQibARAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Namun, kebebasan itu seketika terenggut ketika Kartini menginjak usia remaja. Sesuai tradisi pingitan yang berlaku bagi gadis bangsawan kala itu, ia harus tinggal di dalam rumah dan tidak boleh lagi keluar ke dunia luar sampai ada pria yang datang meminangnya. Di dalam ruang pingitan yang sempit dan sunyi itulah, semangat Kartini justru menyala. Ia menghabiskan waktunya dengan membaca buku, surat kabar, dan majalah Eropa yang dikirimkan oleh teman-temannya. Kartini mulai melihat ketimpangan yang mendalam antara kehidupan perempuan Eropa yang bebas maju dengan perempuan pribumi yang terkekang, buta huruf, dan tidak memiliki suara dalam menentukan masa depannya sendiri. [<a href=\"https://id.scribd.com/presentation/509421234/kartini\">1</a>, <a href=\"https://www.ruangguru.com/blog/contoh-teks-cerita-sejarah\">2</a>, <a href=\"https://www.gramedia.com/literasi/biografi-ra-kartini/\">3</a>]<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_vd\" data-hveid=\"CAIIAQidARAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Untuk menyalurkan kegelisahan hatinya, Kartini mulai aktif menulis surat kepada sahabat-sahabat penanya di Belanda, salah satunya adalah Rosa Abendanon. Dalam surat-surat berbahasa Belanda yang ditulisnya dengan sangat indah dan kritis, Kartini mencurahkan impiannya tentang emansipasi. Ia menggugat adat istiadat yang membelenggu perempuan, menolak praktik poligami yang dipaksakan, dan memperjuangkan hak mutlak bagi kaum wanita untuk mengenakan bangku pendidikan. Bagi Kartini, pendidikan bukan sekadar cara agar perempuan menjadi cerdas, melainkan fondasi utama agar mereka bisa menjadi ibu yang mampu mendidik generasi penerus bangsa dengan lebih baik. [<a href=\"https://bpmpriau.kemendikdasmen.go.id/2017/04/20/r-a-kartini-tokoh-emansipasi-wanita/\">1</a>, <a href=\"https://www.gramedia.com/literasi/contoh-cerpen-tentang-sejarah-pahlawan-indonesia/\">2</a>, <a href=\"https://kab-jayawijaya.kpu.go.id/blog/read/8020_r-a-kartini-perempuan-hebat-pembawa-perubahan\">3</a>]<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_x7\" data-hveid=\"CAIIAQigARAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Masa pingitan Kartini berakhir ketika ia dinikahkan dengan Bupati Rembang, K.R.M. Adipati Ario Singgih Djojo Adhiningrat, pada November 1903. Beruntung, sang suami memahami visi besar istrinya dan memberikan dukungan penuh. Dengan izin suaminya, Kartini berhasil mewujudkan salah satu mimpi terbesarnya, yaitu mendirikan sekolah khusus wanita di kompleks kantor kabupaten Rembang. Di sekolah tersebut, ia mengajar anak-anak perempuan membaca, menulis, menjahit, dan keterampilan lainnya agar mereka mandiri. Sayangnya, perjuangan fisik Kartini harus terhenti sangat cepat. Beberapa hari setelah melahirkan putra pertamanya, Kartini wafat pada tanggal 17 September 1904 dalam usia yang masih sangat muda, 25 tahun. [<a href=\"https://bpmpriau.kemendikdasmen.go.id/2017/04/20/r-a-kartini-tokoh-emansipasi-wanita/\">1</a>, <a href=\"https://deepublishstore.com/blog/sejarah/pahlawan-nasional-dari-jawa-tengah/\">2</a>, <a href=\"https://www.facebook.com/bankanjukladang/videos/biografi-ra-kartinilahir-pada-21-april-1879-raden-ajeng-kartini-sendiri-dikenal-/508394190870071/\">3</a>, <a href=\"https://agromediagroup.com/kegemaran-membaca-buku-para-tokoh-indonesia/\">4</a>, <a href=\"https://budaya.jogjaprov.go.id/berita/detail/1088-raden-ajeng-kartini-1979-1904-tokoh-pelopor-kebangkitan-kaum-wanita-indonesia\">5</a>]<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_zm\" data-hveid=\"CAIIAQiiARAA\" data-processed=\"true\" aria-owns=\"action-menu-parent-container\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Meski raganya telah tiada, pemikiran Kartini tidak pernah mati. Beberapa tahun setelah kematiannya, J.H. Abendanon mengumpulkan surat-surat yang pernah dikirimkan Kartini ke Eropa dan menerbitkannya menjadi sebuah buku berjudul <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_106\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Door Duisternis tot Licht<!--TgQPHd|||[]--></em>, yang kemudian diterjemahkan ke dalam bahasa Indonesia sebagai <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_10m\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Habis Gelap Terbitlah Terang\"<!--TgQPHd|||[]--></em>. Buku ini mengguncang pemikiran masyarakat kolonial dan menjadi pemantik semangat pergerakan nasional. Atas jasa-jasanya yang revolusioner, pemerintah Indonesia menetapkan R.A. Kartini sebagai Pahlawan Nasional, dan hari kelahirannya, 21 April, diperingati setiap tahun oleh bangsa Indonesia sebagai Hari Kartini untuk merayakan perjuangan emansipasi perempuan.</div>', 'berita/WS2zYwoEGay9MkvCK4RHsLVYW5cJOS7NN2kwQDJU.jpg', 1, '2026-08-25 09:34:39', '2026-08-25 09:34:39', 1),
(3, 'Alan Turing', 'alan-turing-8SIsmS', 'Artikel Literasi', '<div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ee\" data-hveid=\"CAIIAQg4EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Alan Mathison Turing lahir di London, Inggris, pada tanggal 23 Juni 1912. Sejak usia dini, ia sudah menunjukkan tanda-tanda kejeniusan yang tidak biasa, terutama dalam bidang matematika dan sains, yang sering kali membuat guru-gurunya di sekolah kewalahan. Pemikiran kritisnya berkembang pesat saat ia melanjutkan studi di King\'s College, Universitas Cambridge, lalu meraih gelar doktor dari Universitas Princeton di Amerika Serikat. Pada tahun 1936, di usianya yang baru 24 tahun, Turing menerbitkan sebuah makalah ilmiah yang sangat revolusioner. Ia memperkenalkan konsep \"Mesin Turing Universal\"—sebuah cetak biru teoretis tentang mesin yang bisa menjalankan tugas apa pun berdasarkan instruksi program (algoritma). Konsep inilah yang melahirkan prinsip kerja komputer modern sebelum fisik komputer itu sendiri berhasil diciptakan.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_et\" data-hveid=\"CAIIAQhCEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Ketika Perang Dunia II pecah pada tahun 1939, Turing direkrut oleh pemerintah Inggris untuk bergabung dengan pusat pemecah kode rahasia di Bletchley Park. Tugasnya sangat krusial dan tampak mustahil: memecahkan kode dari mesin \"Enigma\", sebuah alat komunikasi militer milik Nazi Jerman yang sangat canggih dan selalu mengubah pola kodenya setiap 24 jam. Menyadari bahwa otak manusia tidak akan pernah cukup cepat untuk menandingi kecepatan mesin, Turing merancang sebuah mesin pemecah sandi raksasa yang diberi nama <span class=\"rQesXe MPyX\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"tP2kf#s32ZS\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ey\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 700; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-weight: 700; margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Bombe\"<!--TgQPHd|||[]--></span>. Mesin ini berhasil membongkar komunikasi militer Jerman dalam skala besar, memberikan keunggulan taktik bagi pasukan Sekutu, dan diperkirakan berhasil memperpendek masa perang hingga dua tahun serta menyelamatkan lebih dari 14 juta nyawa.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_fh\" data-hveid=\"CAIIAQhKEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Setelah perang berakhir, kontribusi Turing bagi dunia teknologi terus berlanjut. Pada tahun 1950, ia menulis makalah visioner yang mempertanyakan apakah suatu hari nanti mesin bisa berpikir seperti manusia. Untuk mengujinya, ia menciptakan sebuah eksperimen yang dikenal sebagai <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_fm\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Turing Test\"<!--TgQPHd|||[]--></em> (Uji Turing). Uji ini menetapkan bahwa jika sebuah komputer bisa bercakap-cakap dengan manusia tanpa manusia itu sadar bahwa ia sedang berbicara dengan mesin, maka komputer tersebut dapat dikatakan memiliki kecerdasan. Hingga hari ini, <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ft\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Turing Test<!--TgQPHd|||[]--></em> tetap menjadi standar dasar mutlak dan tolok ukur utama dalam pengembangan Kecerdasan Buatan atau <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_fz\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Artificial Intelligence<!--TgQPHd|||[]--></em> (AI).<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gg\" data-hveid=\"CAIIAQhcEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Sayangnya, akhir hidup sang ilmuwan genius ini dipenuhi dengan tragedi kelam. Pada tahun 1952, di tengah puncak karier akademisnya, Turing diadili oleh pemerintah Inggris hanya karena orientasi seksualnya yang homoseksual, yang pada masa itu dianggap sebagai tindakan kriminal di Inggris. Ia dipaksa menjalani hukuman kebiri kimiawi yang merusak kondisi fisik dan mentalnya secara drastis. Dua tahun setelah pengebirian tersebut, tepatnya pada 7 Juni 1954, Alan Turing ditemukan tewas di tempat tidurnya akibat keracunan sianida pada usia 41 tahun, yang dinyatakan oleh pihak berwenang sebagai tindakan bunuh diri.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gu\" data-hveid=\"CAIIAQhhEAA\" data-processed=\"true\" aria-owns=\"action-menu-parent-container\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Dunia baru menyadari sepenuhnya besarnya jasa Alan Turing puluhan tahun setelah kepergiannya. Namanya diabadikan dalam <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gw\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Turing Award\"<!--TgQPHd|||[]--></em>, sebuah penghargaan tertinggi di dunia ilmu komputer yang setara dengan Hadiah Nobel. Pada tahun 2013, Ratu Elizabeth II secara resmi memberikan pengampunan kerajaan atas ketidakadilan yang menimpa Turing di masa lalu. Kini, Alan Turing dikenang bukan hanya sebagai pahlawan perang yang terlupakan, melainkan sebagai sosok visioner agung yang membuka gerbang zaman digital bagi peradaban manusia modern.</div>', 'berita/4FjjSx6b70WFNRT4ABGlzTaMeNHEioCjgTZmurLC.jpg', 1, '2026-08-25 09:35:28', '2026-08-25 09:35:28', 1),
(4, 'Steve Jobs', 'steve-jobs-26xs79', 'Artikel Literasi', '<div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ea\" data-hveid=\"CAIIAQg2EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Steve Jobs lahir di San Francisco, California, pada 24 Februari 1955 dari pasangan Abdulfattah Jandali dan Joanne Schieble. Karena tidak mendapat restu keluarga, ia diadopsi sejak bayi oleh pasangan Paul dan Clara Jobs yang membesarkannya di Mountain View, California—kawasan yang kelak dikenal sebagai Silicon Valley. Sejak kecil, Paul Jobs menularkan kecintaan pada keahlian mekanik dan desain yang presisi kepada Steve. Menginjak masa kuliah, Jobs memilih drop out dari Reed College setelah hanya satu semester karena tidak ingin menghabiskan uang tabungan orang tuanya. Meski keluar, ia tetap mengikuti kelas kaligrafi secara ilegal di kampus tersebut. Kelas seni tulisan inilah yang kelak menginspirasi Jobs untuk menciptakan komputer pertama dengan estetika tipografi dan variasi fon yang indah.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_eo\" data-hveid=\"CAIIAQg9EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Titik balik hidupnya dimulai pada tahun 1976 ketika ia bersama sahabat geniusnya, Steve Wozniak, mendirikan Apple Computer di garasi rumah orang tua Jobs. Di saat Wozniak fokus pada keajiban sirkuit elektronik, Jobs bertindak sebagai visioner yang memahami apa yang diinginkan pasar. Bersama-sama, mereka meluncurkan Apple II yang sukses besar dan Macintosh pada tahun 1984, komputer pertama dengan antarmuka grafis (GUGI) yang ramah pengguna. Namun, sifat Jobs yang perfeksionis, temperamental, dan keras kepala memicu perebutan kekuasaan dengan jajaran direksi. Ironisnya, pada tahun 1985, di usia 30 tahun, Jobs dipecat dari perusahaan yang ia dirikan sendiri.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_f5\" data-hveid=\"CAIIAQhGEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Kehilangan Apple tidak membuat Jobs patah arang. Periode ini justru menjadi masa paling kreatif dalam hidupnya. Ia mendirikan NeXT, sebuah perusahaan komputer canggih, dan membeli divisi komputer grafis dari George Lucas yang kemudian ia ubah namanya menjadi Pixar Animation Studios. Di bawah asuhan Jobs, Pixar menjelma menjadi raksasa animasi dunia dan merilis <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_f8\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Toy Story<!--TgQPHd|||[]--></em> pada tahun 1995, film animasi komputer penuh pertama di dunia. Sementara itu, Apple yang ditinggalkannya justru berada di ambang kebangkrutan. Pada tahun 1997, Apple akhirnya membeli NeXT, sebuah langkah yang membawa Jobs kembali ke rumah lamanya sebagai CEO sementara.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_fu\" data-hveid=\"CAIIAQhOEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Kembalinya Jobs menandai era kebangkitan terbesar dalam sejarah korporasi modern. Dengan moto legendaris <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_g0\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Think Different\"<!--TgQPHd|||[]--></em>, ia memangkas puluhan produk gagal Apple dan fokus pada inovasi yang menggabungkan teknologi murni dengan keindahan seni. Dunia terpukau saat Apple meluncurkan iMac yang berwarna-warni, diikuti oleh iPod pada tahun 2001 yang mengubah cara manusia mendengarkan musik, serta toko musik digital iTunes. Puncaknya terjadi pada tahun 2007, saat Jobs berdiri di atas panggung mengenakan pakaian khasnya—baju <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_g3\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">turtleneck<!--TgQPHd|||[]--></em> hitam dan celana jins—lalu memperkenalkan iPhone. Perangkat layar sentuh revolusioner ini mengubah ponsel menjadi komputer saku dan mendefinisikan ulang industri seluler global untuk selamanya.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gh\" data-hveid=\"CAIIAQhdEAA\" data-processed=\"true\" aria-owns=\"action-menu-parent-container\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Namun, di tengah puncak kejayaannya, Jobs harus berhadapan dengan musuh yang tak kasat mata. Pada tahun 2003, ia didiagnosis menderita kanker pankreas yang langka. Selama bertahun-tahun, ia berjuang melawan penyakit tersebut sambil tetap memimpin Apple dengan sisa-sisa energinya, termasuk saat meluncurkan iPad pada tahun 2010. Setelah menyerahkan tongkat estafet kepemimpinan kepada Tim Cook, Steve Jobs mengembuskan napas terakhirnya di Palo Alto, California, pada 5 Oktober 2011 dalam usia 56 tahun. Dunia berduka kehilangan seorang pemikir jenius yang selalu percaya bahwa orang-orang yang cukup gila untuk berpikir mereka bisa mengubah dunia adalah orang-orang yang benar-benar melakukannya.</div>', 'berita/qGpMyaX0LFOojixSSh07zHVGLsxZwr04bsuLO880.jpg', 1, '2026-08-25 09:36:19', '2026-08-25 09:36:19', 1),
(5, 'Bill Gates', 'bill-gates-aUCcQv', 'Artikel Literasi', '<div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_eh\" data-hveid=\"CAIIAQg5EAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Bill Gates lahir di Seattle, Washington, pada 28 Oktober 1955 dari keluarga kelas menengah ke atas, di mana ayahnya adalah seorang pengacara terkemuka dan ibunya menjabat sebagai eksekutif di lembaga keuangan. Ketertarikan Gates pada dunia komputer tumbuh sejak usia 13 tahun saat bersekolah di Lakeside School, sebuah sekolah swasta yang memiliki akses ke komputer terminal saat teknologi tersebut masih sangat langka. Di sana, ia menghabiskan waktu berjam-jam untuk memprogram permainan tic-tac-toe dan bertemu dengan Paul Allen, sahabat karib yang memiliki minat serupa. Kecerdasan matematika Gates yang luar biasa membawanya masuk ke Universitas Harvard pada tahun 1973. Namun, melihat perkembangan teknologi microcomputer yang melesat cepat, Gates membuat keputusan berani untuk <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ek\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">drop out<!--TgQPHd|||[]--></em> dari Harvard pada tahun 1975 demi mendirikan sebuah perusahaan perangkat lunak bersama Paul Allen yang mereka beri nama Microsoft.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_ew\" data-hveid=\"CAIIAQhDEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Visi awal Microsoft sangat ambisius untuk ukuran zamannya: <em class=\"eujQNb\" jsaction=\"\" jscontroller=\"yHWXO#Mkm8ud\" data-sfc-root=\"ep\" jsuid=\"IVKixb_f2\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">\"Sebuah komputer di setiap meja dan di setiap rumah.\"<!--TgQPHd|||[]--></em> Titik balik terbesar Microsoft terjadi pada tahun 1980, ketika raksasa komputer IBM mengajak Microsoft bekerja sama untuk menyediakan sistem operasi bagi komputer pribadi terbaru mereka. Dengan kecerdikan bisnisnya, Gates membeli sebuah sistem operasi dari pengembang lain, menyempurnakannya menjadi MS-DOS, lalu melisensikannya kepada IBM tanpa menjual hak ciptanya. Langkah genius ini membuat Microsoft bisa melisensikan MS-DOS ke berbagai perusahaan komputer lain yang meniru IBM. Puncaknya terjadi pada tahun 1985 ketika Microsoft meluncurkan <span class=\"rQesXe MPyX\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"tP2kf#s32ZS\" data-sfc-root=\"ep\" jsuid=\"IVKixb_f9\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 700; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-weight: 700; margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Windows<!--TgQPHd|||[]--></span>, sebuah sistem operasi berbasis antarmuka grafis yang ramah pengguna. Windows meledak di pasaran dan menguasai lebih dari 90% pangsa pasar komputer global, mengantarkan Bill Gates menjadi miliarder termuda di dunia pada usia 31 tahun.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_fp\" data-hveid=\"CAIIAQhNEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Keberhasilan Gates membangun Microsoft tidak lepas dari karakternya yang sangat kompetitif, agresif, dan visioner. Ia dikenal sebagai pemimpin yang perfeksionis dan kerap menguji ide para karyawannya dengan kritik yang tajam. Di bawah kendalinya, Microsoft tidak hanya mendominasi sistem operasi lewat Windows, tetapi juga menguasai perangkat lunak produktivitas kantoran melalui Microsoft Office. Dominasi yang teramat kuat ini bahkan sempat membuat Microsoft terjerat kasus hukum antimonopoli besar oleh pemerintah Amerika Serikat pada akhir era 1990-an. Kendati menghadapi berbagai tekanan bisnis dan persaingan ketat, termasuk rivalitas legendarisnya dengan Steve Jobs dari Apple, Gates berhasil mempertahankan posisi Microsoft sebagai penguasa utama jagat teknologi.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gc\" data-hveid=\"CAIIAQhXEAA\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Memasuki abad ke-21, babak kehidupan Gates mengalami transformasi yang menyentuh hati dunia. Setelah mengundurkan diri dari jabatan CEO Microsoft pada tahun 2000, ia bersama istrinya saat itu mendirikan <span class=\"rQesXe MPyX\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"tP2kf#s32ZS\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gf\" data-processed=\"true\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 700; margin: 0px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-weight: 700; margin: 0px; border-bottom: 0px rgb(10, 10, 10);\">Bill &amp; Melinda Gates Foundation<!--TgQPHd|||[]--></span>. Organisasi filantropi swasta terbesar di dunia ini berfokus pada penyelesaian masalah global, seperti memberantas kemiskinan ekstrem, mendanai riset penyakit mematikan seperti malaria dan polio, serta meningkatkan kualitas pendidikan di berbagai negara berkembang. Gates perlahan melepas seluruh keterlibatan strukturalnya di Microsoft untuk fokus menjadi aktivis kemanusiaan penuh waktu. Meskipun pernikahan mereka berakhir dengan perceraian pada tahun 2021, komitmen Gates terhadap yayasan tersebut tidak pernah surut.<!--TgQPHd|||[]--></div><div class=\"n6owBd awi2gc\" data-sfc-cp=\"\" jsaction=\"\" jscontroller=\"TDBkbc#Ml18Xb\" data-sfc-root=\"ep\" jsuid=\"IVKixb_gx\" data-hveid=\"CAIIAQhiEAA\" data-processed=\"true\" aria-owns=\"action-menu-parent-container\" data-copy-service-computed-style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(10, 10, 10);\" style=\"font-family: &quot;Google Sans&quot;, Arial, sans-serif; margin: 12px 0px 16px; border-bottom: 0px rgb(10, 10, 10);\">Kisah hidup Bill Gates mengajarkan bahwa kejeniusan teknologi yang dipadukan dengan ketajaman strategi bisnis mampu mengubah cara peradaban manusia bekerja dan berkomunikasi. Melalui kekayaan dan pengaruh global yang dimilikinya, ia membuktikan bahwa pencapaian tertinggi seorang manusia bukanlah seberapa banyak materi yang berhasil dikumpulkan, melainkan seberapa besar dampak positif yang mampu ia berikan untuk menyelamatkan dan meningkatkan kualitas hidup jutaan manusia di muka bumi.</div>', 'berita/lkKjiB8L2bJsfW4mDqGtZzSHy84rau0jUCDhVpjs.jpg', 1, '2026-08-25 09:37:03', '2026-08-25 09:37:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kode_buku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor Induk Buku / Barcode Internal',
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL friendly untuk detail buku',
  `isbn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0' COMMENT 'Jumlah total fisik buku',
  `rak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Lokasi rak, misal: Rak A1',
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file gambar sampul buku',
  `file_ebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file PDF untuk dibaca online',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kategori_id`, `kode_buku`, `judul`, `slug`, `isbn`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `rak`, `cover`, `file_ebook`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BK-001', 'Koding dan Kecerdasan Artifisial untuk SMP/MTs Kelas VII', 'koding-dan-kecerdasan-artifisial-untuk-smpmts-kelas-vii-30fnk', '978-634-00-2043-4', 'Indra Budi Aji, dkk.', 'Pusat Perbukuan', '2025', 0, NULL, 'buku/cover/yP2ITHwbQiN56Nba4XAKhd1i6o4PLqcAB6Cvgi3B.png', 'buku/ebook/HCqspllKahYF98qAVfwWFw4hiWrEfoxotfvTCAdx.pdf', NULL, '2026-08-25 08:05:03', '2026-08-25 09:31:53', NULL),
(2, 1, 'BK-002', 'Panduan Guru Koding dan Kecerdasan Artifisial untuk SMP/MTs Kelas VII', 'panduan-guru-koding-dan-kecerdasan-artifisial-untuk-smpmts-kelas-vii-novew', '9786340020434', 'Des Erita Fenti, dkk.', 'Pusat Perbukuan', '2025', 1, NULL, 'buku/cover/WruosUwPbxXa8UGxyMCBSyu96fCF09coFhajtRT9.png', 'buku/ebook/6lMknqGZFtU8rOuI5pZ5WeYeF6yo7WYKneuiALnc.pdf', NULL, '2026-08-25 08:09:17', '2026-08-25 09:31:30', NULL),
(3, 2, 'BK-003', 'Matematika untuk SMP/MTs Kelas VII', 'matematika-untuk-smpmts-kelas-vii-5sfdj', '978-602-244-883-9', 'Dicky Susanto, dkk.', 'Pusat Perbukuan', '2022', 1, NULL, 'buku/cover/BRI7ZSgEe6UaTqFzUdZ4qiVV8DN5mUTROUkvh7J3.png', 'buku/ebook/k5re4qGPcxsfVSY0LKofItjAxTsEq2M5Bi6yQTyM.pdf', NULL, '2026-08-25 08:14:05', '2026-08-25 08:14:05', NULL),
(4, 2, 'BK-004', 'Matematika untuk SMP/MTs Kelas VIII', 'matematika-untuk-smpmts-kelas-viii-rm9uw', '978-602-427-919-6', 'Mohammad Tohir', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '2022', 1, NULL, 'buku/cover/i4Aw3FQwcalJLMVY537qlvGiIJkgANheIBKJ9g1g.png', 'buku/ebook/wYiYBOhXLFcXZsf9b9QaOHU8uAHHddU78NVb7sem.pdf', NULL, '2026-08-25 08:17:09', '2026-08-25 08:17:09', NULL),
(5, 2, 'BK-005', 'Matematika untuk SMP/MTs Kelas IX', 'matematika-untuk-smpmts-kelas-ix-rvm5e', '978-602-427-918-9', 'Yosep Dwi Kristanto, dkk.', 'Pusat Perbukuan', '2022', 0, NULL, 'buku/cover/hiZwfkk8bvncuzTPuytivBnIZWELdo7I6EfrgUO5.png', 'buku/ebook/dcllZopow5tWYD8iCw5lMXAHxwcj9tgJuTLETfp1.pdf', NULL, '2026-08-25 08:49:09', '2026-08-25 08:49:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Isi kelas jika siswa, atau asal instansi jika tamu luar',
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci COMMENT 'Pesan, kesan, atau keterangan tambahan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id`, `nama`, `kelas_instansi`, `tujuan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Rivan Sophana Fazri', 'Umum', 'Lainnya', NULL, '2026-08-25 09:38:22', '2026-08-25 09:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `slug`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Koding dan Kecerdasan Artifisial', 'koding-dan-kecerdasan-artifisial', NULL, '2026-08-25 07:58:41', '2026-08-25 07:58:41'),
(2, 'Matematika', 'matematika', NULL, '2026-08-25 07:58:49', '2026-08-25 07:58:49'),
(3, 'IPA', 'ipa', NULL, '2026-08-25 07:59:03', '2026-08-25 07:59:03'),
(4, 'IPS', 'ips', NULL, '2026-08-25 07:59:08', '2026-08-25 07:59:08'),
(5, 'PAI', 'pai', NULL, '2026-08-25 07:59:13', '2026-08-25 07:59:13'),
(6, 'Bahasa Indonesia', 'bahasa-indonesia', NULL, '2026-08-25 07:59:36', '2026-08-25 07:59:36'),
(7, 'Bahasa Inggris', 'bahasa-inggris', NULL, '2026-08-25 07:59:44', '2026-08-25 07:59:44'),
(8, 'Informatika', 'informatika', NULL, '2026-08-25 07:59:52', '2026-08-25 07:59:52'),
(9, 'Pendidikan Pancasila', 'pendidikan-pancasila', NULL, '2026-08-25 08:00:10', '2026-08-25 08:00:10'),
(10, 'Prakarya', 'prakarya', NULL, '2026-08-25 08:00:18', '2026-08-25 08:00:18'),
(11, 'PJOK', 'pjok', NULL, '2026-08-25 08:00:32', '2026-08-25 08:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_16_054641_create_kategoris_table', 1),
(5, '2026_08_16_060422_create_raks_table', 1),
(6, '2026_08_16_061536_create_bukus_table', 1),
(7, '2026_08_16_064248_create_peminjamen_table', 1),
(8, '2026_08_16_064858_add_denda_to_peminjamans_table', 1),
(9, '2026_08_16_103658_create_beritas_table', 1),
(10, '2026_08_16_210233_create_buku_tamus_table', 1),
(11, '2026_08_16_214602_create_survei_kebutuhans_table', 1),
(12, '2026_08_16_223507_create_survei_kepuasans_table', 1),
(13, '2026_08_17_154513_create_profil_perpustakaans_table', 1),
(14, '2026_08_17_154515_create_pengurus_perpustakaans_table', 1),
(15, '2026_08_18_100841_add_user_id_to_berita_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tenggat_waktu` date NOT NULL COMMENT 'Batas maksimal pengembalian',
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `kode_transaksi`, `user_id`, `buku_id`, `tanggal_pinjam`, `tenggat_waktu`, `tanggal_dikembalikan`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(1, 'TRX-20260825162900', 2, 1, '2026-08-20', '2026-08-20', '2026-08-25', 'Dikembalikan', 2500, '2026-08-25 09:29:00', '2026-08-25 09:31:40'),
(2, 'TRX-20260825162922', 2, 2, '2026-08-25', '2026-09-01', '2026-08-25', 'Dikembalikan', 0, '2026-08-25 09:29:22', '2026-08-25 09:31:30'),
(3, 'TRX-20260825163153', 2, 1, '2026-08-25', '2026-09-01', NULL, 'Dipinjam', 0, '2026-08-25 09:31:53', '2026-08-25 09:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus_perpustakaans`
--

CREATE TABLE `pengurus_perpustakaans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengurus_perpustakaans`
--

INSERT INTO `pengurus_perpustakaans` (`id`, `nama`, `jabatan`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Rivan Sophana Fazri', 'Kepala Sekolah', NULL, 1, '2026-08-25 08:52:44', '2026-08-25 08:52:44'),
(2, 'Rivan Sophana Fazri', 'Kepala Perpustakaan', NULL, 2, '2026-08-25 08:53:02', '2026-08-25 08:53:02'),
(3, 'Rivan Sophana Fazri', 'Staff Perpustakaan', NULL, 3, '2026-08-25 08:53:25', '2026-08-25 08:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `profil_perpustakaans`
--

CREATE TABLE `profil_perpustakaans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_perpustakaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SIPERPUS SMPN 2 Kadugede',
  `deskripsi_hero` text COLLATE utf8mb4_unicode_ci,
  `sejarah` text COLLATE utf8mb4_unicode_ci,
  `visi_misi` text COLLATE utf8mb4_unicode_ci,
  `bagan_struktur_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_tertib` text COLLATE utf8mb4_unicode_ci,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_kerja_buka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_kerja_tutup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_perpustakaans`
--

INSERT INTO `profil_perpustakaans` (`id`, `nama_perpustakaan`, `deskripsi_hero`, `sejarah`, `visi_misi`, `bagan_struktur_image`, `tata_tertib`, `alamat`, `email`, `telepon`, `jam_kerja_buka`, `jam_kerja_tutup`, `created_at`, `updated_at`) VALUES
(1, 'SIPERPUS SMPN 2 Kadugede', 'Infrastruktur digital untuk mengoptimalkan manajemen sirkulasi akademik dan memfasilitasi penelusuran referensi literatur komprehensif.', '<p>SMP Negeri 2 Kadugede adalah lembaga pendidikan formal tingkat Sekolah Menengah Pertama yang berstatus negeri dan berlokasi di Jalan Raya Bayuning No. 18, Desa Bayuning, Kecamatan Kadugede, Kabupaten Kuningan, Provinsi Jawa Barat. Sekolah ini resmi berdiri pada pertengahan dekade 1980-an berdasarkan SK Pendirian Nomor 059/O/1985 serta SK Izin Operasional tertanggal 22 November 1985. Kehadiran sekolah ini sejak awal ditujukan untuk memperluas akses layanan program wajib belajar pendidikan dasar sembilan tahun bagi masyarakat di wilayah Kecamatan Kadugede dan sekitarnya. Seiring perjalanannya, institusi yang kini telah mengantongi Akreditasi A tersebut terus berkomitmen untuk memberikan mutu pendidikan yang relevan bagi generasi muda di Kabupaten Kuningan.</p><div><br></div>', '<p>Visi Sekolah</p><p>Mewujudkan lembaga pendidikan yang unggul dalam melahirkan generasi yang bertaqwa, berkarakter mulia, berprestasi tinggi, serta cakap teknologi untuk menghadapi kompetensi global global dengan berlandaskan kebersihan lingkungan.</p><p>Misi Sekolah</p><p>Menanamkan Nilai Keagamaan: Menyelenggarakan pembiasaan aktivitas keagamaan guna mempertebal keimanan warga sekolah dan membentuk budi pekerti yang luhur.</p><p>Mengembangkan Ekosistem IT: Mengoptimalkan penggunaan teknologi informasi dalam sistem pembelajaran dan tata kelola administrasi sekolah untuk daya saing siswa.</p><p>Meningkatkan Mutu Akademik: Melaksanakan proses pembelajaran yang aktif, kreatif, dan inovatif agar setiap peserta didik mampu meraih prestasi akademik maupun nonakademik.&nbsp;</p><p>Membina Kepedulian Lingkungan: Membiasakan pola hidup bersih dan sehat di lingkungan sekolah guna membangun kenyamanan belajar (aspek Bersih).</p><p>Memperkuat Karakter Pancasila: Mengintegrasikan nilai-nilai kedisiplinan, kemandirian, dan etika sosial (kesantunan) melalui kurikulum dan kegiatan ekstrakurikuler.</p><div><br></div>', NULL, '<p>TATA TERTIB DAN LAYANAN PERPUSTAKAAN \"CAHAYA ILMU\"</p><p>SMP NEGERI 2 KADUGEDE</p><p>I. TATA TERTIB PERPUSTAKAAN</p><p>A. Hak Anggota</p><p>Setiap siswa, guru, dan staf tata usaha SMPN 2 Kadugede secara otomatis menjadi anggota perpustakaan.</p><p>Anggota berhak meminjam buku teks, buku fiksi, dan non-fiksi sesuai batas waktu yang ditentukan.</p><p>Anggota berhak memanfaatkan fasilitas perpustakaan (area baca, komputer/internet, dan koleksi digital).</p><p>B. Kewajiban Pengunjung</p><p>Mengisi Buku Tamu: Setiap pengunjung wajib mengisi buku kunjungan digital atau manual di meja serbaguna sebelum masuk.</p><p>Menjaga Ketenangan: Pengunjung dilarang berbuat gaduh, mengobrol dengan suara keras, atau melakukan aktivitas yang mengganggu orang lain.</p><p>Menjaga Kebersihan: Dilarang membawa makanan, camilan, dan minuman berwarna ke dalam ruang perpustakaan.</p><p>Menitipkan Barang: Tas, jaket, dan topi wajib diletakkan secara rapi di dalam loker yang telah disediakan (kecuali barang berharga seperti dompet/HP).</p><p>Menjaga Fasilitas: Dilarang mencoret-coret, melipat halaman, menyobek, atau merusak buku serta fasilitas perpustakaan lainnya.</p><p>C. Sanksi dan Pelanggaran</p><p>Keterlambatan: Keterlambatan pengembalian buku pinjaman dikenakan denda dummy sebesar Rp 500,- per buku per hari.</p><p>Kerusakan: Buku yang rusak (sobek/kotor) akibat kelalaian peminjam wajib diperbaiki atau diganti dengan judul yang sama.</p><p>Kehilangan: Buku yang hilang wajib diganti dengan buku yang sama (judul dan pengarang sama) atau menggantinya dengan uang seharga buku tersebut.</p><p>Ketertiban: Pengunjung yang membuat keributan setelah diberi peringatan 3 kali akan diminta meninggalkan ruang perpustakaan.</p><p>II. ALUR LAYANAN PERPUSTAKAAN</p><p>A. Jam Layanan</p><p>Senin – Kamis: Pukul 07.00 – 14.00 WIB</p><p>Jumat: Pukul 07.00 – 11.30 WIB</p><p>Catatan: Perpustakaan tutup pada hari Sabtu, Minggu, dan hari libur nasional.</p><p>B. Prosedur Peminjaman Buku (Sirkulasi)</p><p>Siswa memilih buku yang diinginkan di rak koleksi.</p><p>Siswa membawa buku dan Kartu Anggota Perpustakaan ke meja petugas (Pustakawan).</p><p>Petugas memindai kode batang (barcode) buku atau mencatatnya ke dalam sistem administrasi perpustakaan.</p><p>Maksimal peminjaman adalah 3 buku dalam satu waktu.</p><p>Durasi peminjaman maksimal selama 7 hari kalender dan dapat diperpanjang 1 kali (jika buku tidak dipesan oleh siswa lain).</p><p>C. Prosedur Pengembalian Buku</p><p>Siswa menyerahkan buku yang dipinjam kepada petugas di meja sirkulasi.</p><p>Petugas memeriksa kondisi fisik buku dan tanggal batas pengembalian.</p><p>Jika tepat waktu dan kondisi baik, data peminjaman langsung dihapus dari kartu digital siswa.</p><p>Jika terlambat, siswa menyelesaikan administrasi denda terlebih dahulu kepada petugas sebelum diperbolehkan meminjam buku kembali.</p><p>D. Layanan Pojok Digital / Internet</p><p>Fasilitas komputer dan internet 30 Mbps hanya boleh digunakan untuk keperluan tugas sekolah, literasi, atau mencari bahan referensi pelajaran.</p><p>Setiap siswa dibatasi menggunakan fasilitas komputer maksimal 45 menit per sesi (jika ada antrean).</p><p>Dilarang membuka situs media sosial personal, bermain game online, atau mengakses situs yang tidak mendidik.</p><div><br></div>', 'Jalan Raya Bayuning No. 18, Desa Bayuning, Kecamatan Kadugede, Kabupaten Kuningan, Provinsi Jawa Barat.', 'smpn2kadugede@sch.id', '083123456789', '07:00 WIB', '14:00 WIB', '2026-08-25 08:50:44', '2026-08-25 08:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `raks`
--

CREATE TABLE `raks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_rak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raks`
--

INSERT INTO `raks` (`id`, `nama_rak`, `lokasi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Rak 01', 'Sayap Kanan', NULL, '2026-08-25 08:00:55', '2026-08-25 08:00:55'),
(2, 'Rak 02', 'Sayap Kiri', NULL, '2026-08-25 08:01:05', '2026-08-25 08:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NrVu7GgwSkNfcvGfbjduTcztvSiTv9SZByIopLrX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJnc2w1emFJbk4xNURQTTFvQmF5Q0F4ZllOSmZHd3pWdTlIT1llMlBlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYW5nZ290YSIsInJvdXRlIjoiYWRtaW4uYW5nZ290YS5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1787698893),
('tDt5ZoDWHsqrknlJcxsJ09gfKsyd1N0Fyk7jGrZF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJwU0RnMjFVR2tjRWw4U1IyVlltdkVlS1hXaElhT3ZVMXhtbTNaRnRLIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL29wYWM/amVuaXM9RWJvb2sma2F0ZWdvcmk9JnNvcnQ9dGVyYmFydSIsInJvdXRlIjoib3BhYy5pbmRleCJ9fQ==', 1787698999),
('xe107ICOFFn34Xq9BkJawte9lZJ5n4iZzBQWC2vu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJZRVVFQWhBN092Y2ZHRnNGWUh4OTdRRFJGQWRvczdsMm1UYmw4YmVlIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=', 1787672527);

-- --------------------------------------------------------

--
-- Table structure for table `survei_kebutuhans`
--

CREATE TABLE `survei_kebutuhans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survei_kebutuhans`
--

INSERT INTO `survei_kebutuhans` (`id`, `nama`, `peran`, `judul_buku`, `pengarang`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 'Rivan Sophana Fazri', 'Umum', 'Atomic Habits', 'James Clear', 'Bahan bacaan pengembangan diri', '2026-08-25 09:38:59', '2026-08-25 09:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `survei_kepuasans`
--

CREATE TABLE `survei_kepuasans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepuasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survei_kepuasans`
--

INSERT INTO `survei_kepuasans` (`id`, `nama`, `peran`, `kepuasan`, `saran`, `created_at`, `updated_at`) VALUES
(1, 'Rivan Sophana Fazri', 'Umum', 'Sangat Puas', 'Sangat bagus', '2026-08-25 09:39:23', '2026-08-25 09:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bisa diisi NIS/NIP atau username custom',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota' COMMENT 'Level akses sistem',
  `nis_nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'NIS untuk Siswa, NIP/NIK untuk Guru/Staf',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_anggota` enum('siswa','guru','staf','umum') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Klasifikasi jenis anggota',
  `kelas` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Misal: VII-A, VIII-B',
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif','lulus','pindah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif' COMMENT 'Status keanggotaan saat ini',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `nis_nip`, `name`, `jenis_kelamin`, `tipe_anggota`, `kelas`, `no_telepon`, `alamat`, `foto`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'adminperpus', 'admin@smpn2kadugede.sch.id', NULL, '$2y$12$Njfs.GnbGdD52h1qjeDjle6MgTCesAnGfFKiHV2vi31ndwndKAz.a', 'admin', '198001012005011001', 'Rivan Sophana Fazri', 'L', 'staf', NULL, '081234567890', 'Jl. Raya Kadugede No. 123, Kuningan', 'foto_profil/RBRGSokyPTFH5DCVkLpOufL7a9ziZeUYBwbysk58.jpg', 'aktif', NULL, '2026-08-25 07:57:11', '2026-08-25 09:17:00', NULL),
(2, '2324001', 'siswa@smpn2kadugede.sch.id', NULL, '$2y$12$Ee1knyH/LokgkRe/Yo3aoOjvVMjVv3iILtSPefIxKeqXgNYibWtvO', 'anggota', '2324001', 'Budi Santoso', 'L', 'siswa', 'VII-A', '089876543210', 'Desa Kadugede RT 01 RW 02', NULL, 'aktif', NULL, '2026-08-25 07:57:12', '2026-08-25 07:57:12', NULL),
(3, 'gurubasa', 'guru@smpn2kadugede.sch.id', NULL, '$2y$12$8gg1eG6dWDMQkXLmBhHLZOxxndyuNYdU3Qz2LQ.Ib95DHHeteZp1m', 'anggota', '198502022010022002', 'Ibu Siti Aminah, S.Pd.', 'P', 'guru', NULL, '085612349876', 'Perumahan Guru Kadugede', NULL, 'aktif', NULL, '2026-08-25 07:57:12', '2026-08-25 07:57:12', NULL),
(4, 'username1', 'username1@perpus.com', NULL, '$2y$12$CQUw7w/NPDlY9er7I8a09.mM29Mm9L26fdK5DSy1LV42BXRXV/gsy', 'anggota', NULL, 'Username 1', 'L', 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:50:54', '2026-08-25 22:50:54', NULL),
(5, 'username2', 'username2@perpus.com', NULL, '$2y$12$b2wgolSLh.ObiQjtXRtKCuG6vGK6BPX6PCLk.1VTGwL9AQ9HLUy5m', 'anggota', NULL, 'Username 2', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:51:53', '2026-08-25 22:51:53', NULL),
(6, 'username3', 'username3@perpus.com', NULL, '$2y$12$y4Ui5nbGPz8uKkwU/Yu6uO1/WUibY9neRjK6.K/.C8BFrefVYROu.', 'anggota', NULL, 'Username 3', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:54:26', '2026-08-25 22:54:39', NULL),
(7, 'username4', 'username4@perpus.com', NULL, '$2y$12$hOLwp7hO9dRY9mTm.38ch.pEXpc5qSSk1GhO5NO5lTF6JwZCGrKMa', 'anggota', NULL, 'Username 4', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:55:13', '2026-08-25 22:55:13', NULL),
(8, 'username5', 'username5@perpus.com', NULL, '$2y$12$sJ2s.uoXVjt6GvUEGJ8A5eCXV1i75jkgxUXCOjPaVvjVTqmfUDlDC', 'anggota', NULL, 'Username 5', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:55:50', '2026-08-25 22:55:50', NULL),
(9, 'username6', 'username6@perpus.com', NULL, '$2y$12$DpD4hlqO/9DgAS6Qw/pyQeBZtzxrNWRW4ZEd8NDieSVlTKRtP8RkC', 'anggota', NULL, 'username6', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:56:19', '2026-08-25 22:56:19', NULL),
(10, 'username7', 'username7@perpus.com', NULL, '$2y$12$NwPjDynIONcQSXk2K8Jx..u1it1Beb0GKFUL5Y3fWDTvmVBgnM6aW', 'anggota', NULL, 'Username 7', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:56:53', '2026-08-25 22:56:53', NULL),
(11, 'username8', 'username8@perpus.com', NULL, '$2y$12$S4Y/1ViNMiHS1QbTY.2e1OuOx8YfgOoRU6DHHrF4v8188YF.BTQV6', 'anggota', NULL, 'Username 8', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:57:25', '2026-08-25 22:57:25', NULL),
(12, 'username9', 'username9@perpus.com', NULL, '$2y$12$CEi3ccAZcdVADT6KW1cV4Oe6sDKYSfHGidsU/m1fODd4.bRRr/Wq6', 'anggota', NULL, 'Username 9', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:57:59', '2026-08-25 22:57:59', NULL),
(13, 'username10', 'username10@perpus.com', NULL, '$2y$12$1EpQ/kI/d2errnzOE5kibecrFfNx1.QJVqGrlReMbhxjqlfCKCkP2', 'anggota', NULL, 'Username 10', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:58:34', '2026-08-25 22:58:34', NULL),
(14, 'username11', 'username11@perpus.com', NULL, '$2y$12$hNBbtSofevE2vIHgVEZsneSoVi7.LqBc7PTwi/Ie6sKvZ5pXigtL.', 'anggota', NULL, 'Username 11', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:59:08', '2026-08-25 22:59:08', NULL),
(15, 'username12', 'username12@perpus.com', NULL, '$2y$12$CTAkD27Z4xyu9Kc2d7HeLOQhZVLIrsOAKYPVWUJdNTY05e1DjqnqW', 'anggota', NULL, 'Username 12', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 22:59:40', '2026-08-25 22:59:40', NULL),
(16, 'username13', 'username13@perpus.com', NULL, '$2y$12$FNeGR1Ni8ddF0Cvhe/8BCekopniDstXlVe7yR1kgRglt7IfVuMaH2', 'anggota', NULL, 'Username 13', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 23:00:12', '2026-08-25 23:00:12', NULL),
(17, 'username14', 'username14@perpus.com', NULL, '$2y$12$NvJz/8uXw1JhQvRQtpsa2ODFXkqycGL6vThKlaFOyjSMI5UcFgajW', 'anggota', NULL, 'Username 14', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 23:00:46', '2026-08-25 23:00:46', NULL),
(18, 'username15', 'username15@perpus.com', NULL, '$2y$12$SbyQbSoIMnBMTdnU4iOdtu5FGcTFn2YMsGeckDFpRnjG15zhq/AVu', 'anggota', NULL, 'Username 15', NULL, 'siswa', NULL, NULL, NULL, NULL, 'aktif', NULL, '2026-08-25 23:01:16', '2026-08-25 23:01:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`),
  ADD KEY `berita_user_id_foreign` (`user_id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buku_kode_buku_unique` (`kode_buku`),
  ADD UNIQUE KEY `buku_slug_unique` (`slug`),
  ADD UNIQUE KEY `buku_isbn_unique` (`isbn`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_nama_kategori_unique` (`nama_kategori`),
  ADD UNIQUE KEY `kategoris_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjamans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `peminjamans_user_id_foreign` (`user_id`),
  ADD KEY `peminjamans_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `pengurus_perpustakaans`
--
ALTER TABLE `pengurus_perpustakaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_perpustakaans`
--
ALTER TABLE `profil_perpustakaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raks`
--
ALTER TABLE `raks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `raks_nama_rak_unique` (`nama_rak`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `survei_kebutuhans`
--
ALTER TABLE `survei_kebutuhans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survei_kepuasans`
--
ALTER TABLE `survei_kepuasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nis_nip_unique` (`nis_nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengurus_perpustakaans`
--
ALTER TABLE `pengurus_perpustakaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil_perpustakaans`
--
ALTER TABLE `profil_perpustakaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raks`
--
ALTER TABLE `raks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survei_kebutuhans`
--
ALTER TABLE `survei_kebutuhans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survei_kepuasans`
--
ALTER TABLE `survei_kepuasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
