-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 05:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftarmember`
--

CREATE TABLE `daftarmember` (
  `idmember` int(11) NOT NULL,
  `kode_member` varchar(9) DEFAULT NULL,
  `nm_member` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftarmember`
--

INSERT INTO `daftarmember` (`idmember`, `kode_member`, `nm_member`, `email`, `password`, `tgl_daftar`, `tgl_lhr`, `no_telp`, `alamat`, `jk`, `foto`) VALUES
(1, 'MB2022001', 'Galang', 'galang@gmail.com', '1242525325', '2022-06-15 10:44:20', '2022-06-08', '08109810401', 'Jl.Ratna', 'L', '1.jpg'),
(2, 'MB2022002', 'AniNur', 'aninur@gmail.com', '123', '2022-06-29 10:51:15', '2022-06-30', '08301801800', 'Jl.Semolo', 'P', '2.jpg'),
(3, 'MB2022003', 'Aditya', 'adit@gmail.com', '123', '2022-07-04 15:31:33', '2000-06-28', '23520920290', 'Jl.Kertajaya', 'L', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hakakses_menu`
--

CREATE TABLE `hakakses_menu` (
  `id_hakakses` int(11) NOT NULL,
  `idmenu` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hakakses_menu`
--

INSERT INTO `hakakses_menu` (`id_hakakses`, `idmenu`, `iduser`) VALUES
(16, 10, 6),
(38, 10, 7),
(39, 11, 7),
(69, 9, 1),
(70, 10, 1),
(71, 11, 1),
(72, 12, 1),
(73, 13, 1),
(74, 14, 1),
(75, 18, 1),
(76, 20, 1),
(77, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Isekai'),
(2, 'Thriller'),
(5, 'Adventure'),
(6, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `mst_komik`
--

CREATE TABLE `mst_komik` (
  `kode_komik` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `desc_komik` text NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_komik`
--

INSERT INTO `mst_komik` (`kode_komik`, `judul`, `penerbit`, `tahun_terbit`, `id_kategori`, `harga`, `stock`, `desc_komik`, `cover`) VALUES
('MG-2022001', 'One Piece', 'Eiichiro Oda', 1997, 5, 150000, 8, '<p><em><strong>One Piece</strong></em> (bahasa Jepang: <span lang=\"ja\">ワンピース</span>:&nbsp;<em>Wan Pīsu</em>) adalah sebuah seri manga&nbsp;Jepang yang ditulis dan diilustrasikan oleh Eiichiro Oda. Manga ini telah dimuat di majalah Weekly Shonen Jump milik Shueisha sejak tanggal 22 Juli 1997, dan telah dibundel menjadi 91 volume.</p>', '7beecbf4-b20a-40f4-96f2-928ff9ed7e05.jpg'),
('MG-2022002', 'Naruto', 'Masashi Kishimoto', 1997, 5, 180000, 14, '<p><strong>Naruto</strong> (ナルト) adalah sebuah serial manga karya Masashi Kishimoto yang diadaptasi menjadi serial anime. Manga Naruto bercerita seputar kehidupan tokoh utamanya, Naruto Uzumaki, seorang ninja yang hiperaktif, periang, dan ambisius yang ingin mewujudkan keinginannya untuk mendapatkan gelar Hokage, pemimpin dan ninja terkuat di desanya. Serial ini didasarkan pada komik one-shot oleh Kishimoto yang diterbitkan dalam edisi Akamaru Jump&nbsp;pada Agustus 1997.</p>', 'NarutoCoverTankobon1.jpg'),
('MG-2022003', 'Bleach', 'M&C', 2007, 2, 150000, 10, '<p><em><strong>Bleach</strong></em> (bahasa Jepang:&nbsp;<span lang=\"ja\">ブリーチ</span> :&nbsp;<em>Burīchi</em>) adalah sebuah seri manga Shonen Jepang yang ditulis dan diilustrasikan oleh Tite Kubo. Alur ceritanya mengisahkan petualangan remaja keras kepala bernama Ichigo Kurasaki yang mewarisi takdir kedua orangtuanya, setelah dia mendapatkan kekuatan Shinigami.</p>', 'Bleach_cover_01.jpg'),
('MG-2022004', 'Fairy Tail', 'Kodansha', 2006, 5, 100000, 15, '<p><em><strong>Fairy Tail</strong></em> (bahasa Jepang:&nbsp;<span lang=\"ja\">フェアリーテイル</span>:&nbsp;<em>Fearī Teiru</em>) adalah sebuah seri manga Shonen Jepang yang ditulis dan diilustrasikan oleh Hiro Mashima. Manga ini dimuat berseri dalam majalah Weekly Shonen Magazine sejak bulan Agustus 2006 hingga Juli 2017, dan telah diterbitkan menjadi 63 volume oleh Kodansha. Ceritanya mengisahkan tentang Natsu Dragneel, anggota dari guild penyihir<sup id=\"cite_ref-wizards_def_4-0\" class=\"reference\"></sup> populer bernama Fairy Tail, yang bertualang di Earth-land dalam tujuannya untuk mencari seekor naga bernama Igneel.</p>', '220px-FairyTail-Volume_1_Cover.jpg'),
('MG-2022005', 'Death Note', 'Shueisha', 2003, 2, 150000, 9, '<p><em><strong>Death Note</strong></em> (bahasa jepang:&nbsp;<span lang=\"ja\">デスノート</span> :&nbsp;<em>Desu Nōto</em>) adalah sebuah serial manga shonen Jepang yang ditulis oleh Tsugumi Ohba dan diilustrasikan oleh Takeshi Obata. Bercerita tentang Light Yagami, seorang remaja jenius<sup id=\"cite_ref-2\" class=\"reference\"></sup> yang menemukan buku catatan misterius yang disebut \"Death Note\", yang dimiliki oleh Shinigami&nbsp;(dewa kematian) bernama Ryuk, dan memberikan penggunanya kemampuan supranatural untuk membunuh siapapun ketika menulis namanya di buku tersebut.</p>', '220px-Death_Note_Vol_1.jpg'),
('MG-2022006', 'Detective Conan', 'Shogakukan', 1994, 2, 100000, 19, '<p><em><strong>Detektif Conan</strong></em>&nbsp;(<span lang=\"ja\">名探偵コナン</span>&nbsp;<em>Meitantei Konan</em>), yang juga dikenal sebagai&nbsp;<em><strong>Case Closed</strong></em>&nbsp;dan&nbsp;<em><strong>Detective Conan</strong></em>, adalah seri manga detektif Jepang yang ditulis dan diilustrasikan oleh Gosho Aoyama. Serial ini diserialisasikan dalam majalah manga shonen Weekly SHonen Sunday yang diterbitkan oleh Shogakukan sejak Januari 1994.</p>', '220px-Detective_Conan_Vol_1.jpg'),
('MG-2022007', 'That Time I Got Reincarnated as a Slime', 'Micro Magazine', 2014, 1, 150000, 18, '<p><em><strong>That Time I Got Reincarnated as a Slime</strong></em> (bahasa jepang: <span lang=\"ja\">転生したらスライムだった件</span> :&nbsp;<em>Tensei Shitara Suraimu Datta Ken</em>), juga dikenal sebagai&nbsp;<strong>TenSura</strong> (bahasa jepang:&nbsp;<span lang=\"ja\">転スラ:</span>&nbsp;<em>Tensura</em>)<span style=\"font-size: 13.3333px;\"> </span>atau&nbsp;<strong>Slime Isekai</strong>,<span style=\"font-size: 13.3333px;\"> </span>yang diterbitkan di Indonesia dengan judul&nbsp;<em><strong>Regarding Reincarnated to Slime</strong></em> oleh Elex Media Komputindo, <sup id=\"cite_ref-Regarding_5-0\" class=\"reference\"></sup>adalah sebuah seri novel ringan&nbsp;Jepang bergenre fantasi yang ditulis oleh Fuse dan diilustrasikan oleh Mitz Vah.</p>', '220px-That_Time_I_Got_Reincarnated_as_a_Slime_light_novel_volume_1_cover.jpg'),
('MG-2022008', 'Hunter x Hunter', 'Shueisha', 1998, 6, 125000, 10, '<p><em><strong>Hunter &times; Hunter</strong></em> (bahasa Jepang :&nbsp;<span lang=\"ja\">ハンター&times;ハンター </span>:&nbsp;<em>Hantā Hantā</em>, disingkat:&nbsp;<strong>HxH</strong>) adalah sebuah seri manga Jepang yang ditulis dan diilustrasikan oleh Yoshihiro Tagashi. Manga ini mulai dimuat dalam majalah Weekly Shonen Jump sejak tanggal 16 Maret 1998, meskipun sering kali mengalami <em>hiatus</em>&nbsp;berkepanjangan sejak tahun 2006.</p>', '220px-Hunter_x_Hunter_cover_-_vol1.jpg'),
('MG-2022009', 'Black Clover', 'Shueisha', 2015, 6, 180000, 12, '<p><em><strong>Black Clover</strong></em> (bahasa jepang: <span lang=\"ja\">ブラッククローバー</span> :&nbsp;<em>Burakku Kurōbā</em>) adalah sebuah seri bergenre fantasi asal Jepang yang ditulis dan diilustrasikan oleh Yūki Tabata. Ceritanya mengisahkan tentang seorang anak laki-laki bernama Asta yang lahir tanpa kekuatan sihir, suatu fenomena yang tidak normal di dunia tempatnya tinggal. Bersama dengan teman-temannya dari Banteng hitam, dia bercita-cita untuk menjadi Kaisar sihir. Manga ini dimuat berseri dalam majalah Weekly Shonen Jump terbitan Shueisha sejak bulan Februari 2015, dan telah dibundel menjadi 32 volume&nbsp;per bulan April 2022.</p>', '220px-Black_Clover,_volume_1.jpg'),
('MG-2022010', 'Boruto: Naruto Next Generations', 'Shueisha', 2015, 5, 150000, 20, '<p><em><strong>Boruto: Naruto Next Generations </strong></em><sup id=\"cite_ref-2\" class=\"reference\"></sup>adalah sebuah seri manga asal Jepang yang ditulis oleh Ukyo Kodachi dan Mashasi Kishimoto dan diilustrasikan oleh Mikio Ikemoto.</p>', '220px-Boruto_manga_vol_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu`
--

CREATE TABLE `mst_menu` (
  `idmenu` int(11) NOT NULL,
  `kode_menu` varchar(8) NOT NULL,
  `kategori_menu` varchar(25) NOT NULL,
  `nmmenu` varchar(25) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_menu`
--

INSERT INTO `mst_menu` (`idmenu`, `kode_menu`, `kategori_menu`, `nmmenu`, `link`) VALUES
(9, 'M2022001', 'admin', 'Menu', 'mod_menu'),
(10, 'M2022002', 'komik', 'Komik', 'mod_komik'),
(11, 'M2022003', 'komik', 'Kategori Komik', 'mod_kategori'),
(12, 'M2022004', 'penjualan', 'Transaksi Member', 'mod_trnmember'),
(13, 'M2022005', 'penjualan', 'Penjualan', 'mod_penjualan'),
(14, 'M2022006', 'admin', 'Userlogin', 'mod_userlogin'),
(18, 'M2022007', 'admin', 'Hak Akses', 'mod_hakakses'),
(20, 'M2022008', 'admin', 'Request Lupa Password', 'mod_lupapass'),
(21, 'M2022009', 'admin', 'Daftar Member', 'mod_daftarmember');

-- --------------------------------------------------------

--
-- Table structure for table `mst_userlogin`
--

CREATE TABLE `mst_userlogin` (
  `iduser` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_userlogin`
--

INSERT INTO `mst_userlogin` (`iduser`, `username`, `nama_lengkap`, `password`, `is_active`) VALUES
(1, 'galang', 'Galang', '202cb962ac59075b964b07152d234b70', 1),
(6, 'rabbitz', 'Galang', '202cb962ac59075b964b07152d234b70', 1),
(7, 'foxyz', 'FoxyZ', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trn_jualdetail`
--

CREATE TABLE `trn_jualdetail` (
  `iddetail` int(11) NOT NULL,
  `nojual` varchar(6) DEFAULT NULL,
  `kode_komik` varchar(10) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trn_jualdetail`
--

INSERT INTO `trn_jualdetail` (`iddetail`, `nojual`, `kode_komik`, `harga`, `qty`, `subtotal`) VALUES
(38, 'INV001', 'MG-2022001', 150000, 2, 300000),
(39, 'INV001', 'MG-2022002', 180000, 1, 180000),
(40, 'INV002', 'MG-2022007', 150000, 2, 300000),
(41, 'INV003', 'MG-2022006', 100000, 1, 100000),
(42, 'INV003', 'MG-2022005', 150000, 1, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `trn_jualhead`
--

CREATE TABLE `trn_jualhead` (
  `nojual` varchar(6) NOT NULL,
  `idmember` int(11) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trn_jualhead`
--

INSERT INTO `trn_jualhead` (`nojual`, `idmember`, `tgl_transaksi`, `total`) VALUES
('INV001', 1, '2022-07-17', 480000),
('INV002', 3, '2022-07-17', 300000),
('INV003', 2, '2022-07-17', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `tst_historyrequest`
--

CREATE TABLE `tst_historyrequest` (
  `id_historyrequest` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_lama` varchar(50) NOT NULL,
  `password_baru` varchar(100) NOT NULL,
  `date_request` date NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tst_historyrequest`
--

INSERT INTO `tst_historyrequest` (`id_historyrequest`, `username`, `password_lama`, `password_baru`, `date_request`, `status`) VALUES
(1, 'rabbitz', '98ad5ba9c656478015962be940b28f08', '202cb962ac59075b964b07152d234b70', '2022-07-13', '1'),
(2, 'galang', '202cb962ac59075b964b07152d234b70', '98ad5ba9c656478015962be940b28f08', '2022-07-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `tst_request`
--

CREATE TABLE `tst_request` (
  `id_request` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_lama` varchar(50) NOT NULL,
  `password_baru` varchar(100) NOT NULL,
  `date_request` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftarmember`
--
ALTER TABLE `daftarmember`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  ADD PRIMARY KEY (`id_hakakses`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idmenu` (`idmenu`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mst_komik`
--
ALTER TABLE `mst_komik`
  ADD PRIMARY KEY (`kode_komik`),
  ADD KEY `fk_kategori` (`id_kategori`) USING BTREE;

--
-- Indexes for table `mst_menu`
--
ALTER TABLE `mst_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `mst_userlogin`
--
ALTER TABLE `mst_userlogin`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `trn_jualdetail`
--
ALTER TABLE `trn_jualdetail`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `fk_nojual` (`nojual`);

--
-- Indexes for table `trn_jualhead`
--
ALTER TABLE `trn_jualhead`
  ADD PRIMARY KEY (`nojual`);

--
-- Indexes for table `tst_historyrequest`
--
ALTER TABLE `tst_historyrequest`
  ADD PRIMARY KEY (`id_historyrequest`);

--
-- Indexes for table `tst_request`
--
ALTER TABLE `tst_request`
  ADD PRIMARY KEY (`id_request`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftarmember`
--
ALTER TABLE `daftarmember`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  MODIFY `id_hakakses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_menu`
--
ALTER TABLE `mst_menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mst_userlogin`
--
ALTER TABLE `mst_userlogin`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trn_jualdetail`
--
ALTER TABLE `trn_jualdetail`
  MODIFY `iddetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tst_historyrequest`
--
ALTER TABLE `tst_historyrequest`
  MODIFY `id_historyrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tst_request`
--
ALTER TABLE `tst_request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  ADD CONSTRAINT `fk_idmenu` FOREIGN KEY (`idmenu`) REFERENCES `mst_menu` (`idmenu`),
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser`) REFERENCES `mst_userlogin` (`iduser`);

--
-- Constraints for table `mst_komik`
--
ALTER TABLE `mst_komik`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `mst_kategori` (`id_kategori`);

--
-- Constraints for table `trn_jualdetail`
--
ALTER TABLE `trn_jualdetail`
  ADD CONSTRAINT `fk_nojual` FOREIGN KEY (`nojual`) REFERENCES `trn_jualhead` (`nojual`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
