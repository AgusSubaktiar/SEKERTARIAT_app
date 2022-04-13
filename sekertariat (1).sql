-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2022 pada 14.17
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekertariat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `disposisi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `disposisi`) VALUES
(1, 'Tindak Lanjut'),
(2, 'Saran'),
(3, 'Informasi dan Diperhatikan'),
(4, 'Simpan'),
(5, 'Sangat penting'),
(6, 'Penting'),
(7, 'Biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emailkeluar`
--

CREATE TABLE `emailkeluar` (
  `id` int(11) NOT NULL,
  `tgl_emailkeluar` date NOT NULL,
  `no_emailkeluar` varchar(250) NOT NULL,
  `kepada` varchar(256) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `kode_proyek` varchar(250) NOT NULL,
  `nama_proyek` varchar(250) NOT NULL,
  `tembusan` varchar(250) NOT NULL,
  `ordner` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `emailkeluar`
--

INSERT INTO `emailkeluar` (`id`, `tgl_emailkeluar`, `no_emailkeluar`, `kepada`, `perihal`, `kode_proyek`, `nama_proyek`, `tembusan`, `ordner`) VALUES
(3, '2022-03-23', '1122', 'HKP', 'Permohonan', '05', 'Awokawokawok', 'PLN', 'CV_Arka Arifiandi Leonanta_2.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emailmasuk`
--

CREATE TABLE `emailmasuk` (
  `id` int(11) NOT NULL,
  `tgl_emailmasuk` date NOT NULL,
  `no_emailmasuk` varchar(250) NOT NULL,
  `kepada` varchar(256) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `kode_proyek` varchar(250) NOT NULL,
  `nama_proyek` varchar(250) NOT NULL,
  `tembusan` varchar(250) NOT NULL,
  `ordner` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `emailmasuk`
--

INSERT INTO `emailmasuk` (`id`, `tgl_emailmasuk`, `no_emailmasuk`, `kepada`, `perihal`, `kode_proyek`, `nama_proyek`, `tembusan`, `ordner`) VALUES
(1, '2022-03-23', '111', 'HKP', 'IZIN', '01', 'wkwkwkk', 'PLN', 'CV_1.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `formulir`
--

CREATE TABLE `formulir` (
  `id` int(11) NOT NULL,
  `ordner` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `formulir`
--

INSERT INTO `formulir` (`id`, `ordner`, `keterangan`) VALUES
(1, 'Surat Lamaran.docx', 'Softcopy'),
(3, '2021_1741720199_Teknologi informasi_D4 Teknik Informatika_1.pdf', 'Softcopy file 1'),
(4, 'REKAP METODE DI JUDUL SKRIPSI JTI 2020_2.xlsx', 'Softcopy file 1'),
(5, 'Surat Lamaran.docx', 'Softcopy'),
(6, '1461900051.zip', 'File Skripsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `isi_bidang_tb`
--

CREATE TABLE `isi_bidang_tb` (
  `id_isi_bidang` int(20) NOT NULL,
  `nama_isi_bidang` varchar(50) NOT NULL,
  `id_bidang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `isi_bidang_tb`
--

INSERT INTO `isi_bidang_tb` (`id_isi_bidang`, `nama_isi_bidang`, `id_bidang`) VALUES
(12, 'Sekertariat', 33),
(15, 'Pengendalian', 35),
(16, 'Enginnering', 34),
(17, 'Pemasaran', 36),
(19, 'HCD', 37);

-- --------------------------------------------------------

--
-- Struktur dari tabel `memokeluar`
--

CREATE TABLE `memokeluar` (
  `id` int(11) NOT NULL,
  `tgl_memokeluar` date NOT NULL,
  `no_memokeluar` varchar(250) NOT NULL,
  `dari` varchar(256) NOT NULL,
  `kepada` varchar(250) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `ordner` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `memokeluar`
--

INSERT INTO `memokeluar` (`id`, `tgl_memokeluar`, `no_memokeluar`, `dari`, `kepada`, `perihal`, `ordner`) VALUES
(1, '2022-03-23', '21', 'PLN', 'HKP', 'IZIN', 'CV.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memomasuk`
--

CREATE TABLE `memomasuk` (
  `id` int(11) NOT NULL,
  `tgl_memomasuk` date NOT NULL,
  `no_memo` varchar(250) NOT NULL,
  `dari` varchar(256) NOT NULL,
  `kepada` varchar(250) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `ordner` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_bidang_tb`
--

CREATE TABLE `nama_bidang_tb` (
  `id_bidang` int(20) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_bidang_tb`
--

INSERT INTO `nama_bidang_tb` (`id_bidang`, `nama_bidang`) VALUES
(33, 'Sekertariat'),
(34, 'Enginnering'),
(35, 'Pengendalian'),
(36, 'Pemasaran'),
(37, 'HCD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran`
--

CREATE TABLE `penawaran` (
  `id` int(11) NOT NULL,
  `kepada` varchar(250) NOT NULL,
  `no_penawaran` varchar(250) NOT NULL,
  `tgl_penawaran` date NOT NULL,
  `uraian` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penawaran`
--

INSERT INTO `penawaran` (`id`, `kepada`, `no_penawaran`, `tgl_penawaran`, `uraian`) VALUES
(1, 'HKP', 'No 1', '2022-04-01', '1741720199_Agus Subaktiar_TI-4C.zip'),
(2, 'GIS Muara Tawar', 'No 2', '2022-03-15', '1741720199_Agus Subaktiar_TI-4C_1.zip'),
(3, 'GISTET 500 Kv Bekasi', 'No 11', '2022-04-02', '1741720199_Agus Subaktiar_TI-4C_1.zip');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perizinan`
--

CREATE TABLE `perizinan` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tgl_perizinan` date NOT NULL,
  `no_perizinan` varchar(256) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `masaberlaku` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perizinan`
--

INSERT INTO `perizinan` (`id`, `nama`, `tgl_perizinan`, `no_perizinan`, `perihal`, `masaberlaku`) VALUES
(1, 'Bovine Ephemeral Fever (BEF)', '2022-03-20', '3', 'Permohonan', '2022-03-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratkeluar`
--

CREATE TABLE `suratkeluar` (
  `id` int(11) NOT NULL,
  `tgl_suratkeluar` date NOT NULL,
  `no_suratkeluar` varchar(250) NOT NULL,
  `kepada` varchar(256) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `kode_proyek` varchar(250) NOT NULL,
  `nama_proyek` varchar(250) NOT NULL,
  `ordner` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratmasuk`
--

CREATE TABLE `suratmasuk` (
  `id` int(11) NOT NULL,
  `id_disposisi` int(11) NOT NULL,
  `tgl_suratmasuk` date NOT NULL,
  `no_suratmasuk` varchar(250) NOT NULL,
  `kepada` varchar(256) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `kode_proyek` varchar(250) NOT NULL,
  `nama_proyek` varchar(250) NOT NULL,
  `ordner` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suratmasuk`
--

INSERT INTO `suratmasuk` (`id`, `id_disposisi`, `tgl_suratmasuk`, `no_suratmasuk`, `kepada`, `perihal`, `kode_proyek`, `nama_proyek`, `ordner`) VALUES
(50, 7, '2022-04-08', '123', 'Agus', 'Mletre', '456', 'Ciu FM', 'file.pdf'),
(55, 6, '2022-04-09', '09/04/2022', 'Agus', 'Mletre', '0101', 'Membuat ciu', 'General Ledger (1)_5.pdf'),
(56, 6, '2022-04-09', '09/04/2022', 'Agus', 'Mletre', '0101', 'Membuat ciu', 'General Ledger (1)_6.pdf'),
(57, 3, '2022-04-01', '31/03/2022', 'Pak Agus', 'Surat perintah kerja', '02', 'Proyek Mletre', 'General Ledger (1)_7.pdf'),
(58, 4, '2022-04-09', '01/04/2022', 'Pak Agus', 'Menanam Sayur', '098', 'Memanen sayur', 'General Ledger (1)_8.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keputusan`
--

CREATE TABLE `surat_keputusan` (
  `id` int(11) NOT NULL,
  `no_sk` varchar(250) NOT NULL,
  `tgl_sk` date NOT NULL,
  `kepada` varchar(256) NOT NULL,
  `ordner` varchar(250) NOT NULL,
  `upload_sk` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_keputusan`
--

INSERT INTO `surat_keputusan` (`id`, `no_sk`, `tgl_sk`, `kepada`, `ordner`, `upload_sk`) VALUES
(1, '67/S.Kep/DU/III/2022', '2022-03-22', 'HKP', 'CV_1.pdf', 'Ord.221'),
(2, '68/S.Kep/DU/III/2022', '2022-03-22', 'HKP', 'CV_1.pdf', 'Ord.22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tender`
--

CREATE TABLE `tender` (
  `id_tender` int(11) NOT NULL,
  `nama_proyek` varchar(250) NOT NULL,
  `tgl_tender` date NOT NULL,
  `filetender` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tender`
--

INSERT INTO `tender` (`id_tender`, `nama_proyek`, `tgl_tender`, `filetender`) VALUES
(3, 'GIS 150 Kv Sukamara', '2022-03-30', 'Rev1_KSO Hasta_GIS 500 kV Bekasi_2.docx'),
(4, 'GIS 150 Kv Muara Tawar', '2022-03-30', '1741720199_Agus Subaktiar_TI-4C.zip');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terdisposisi`
--

CREATE TABLE `terdisposisi` (
  `id` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `terdisposisi`
--

INSERT INTO `terdisposisi` (`id`, `id_surat`, `id_bidang`) VALUES
(23, 58, 34),
(24, 58, 36),
(25, 58, 37);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_tb`
--

CREATE TABLE `user_tb` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_bidang` int(20) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_tb`
--

INSERT INTO `user_tb` (`id_user`, `username`, `password`, `id_bidang`, `role`) VALUES
(20, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1),
(22, 'Sekertariat', 'ee11cbb19052e40b07aac0ca060c23ee', 33, 0),
(23, 'Engginering', '3043b5175f1d0248befd9d44e22a7e01', 34, 0),
(24, 'pemasaran', '229eaac0894a3379d759a720e0e3410c', 36, 0),
(25, 'pengendalian', '8c3813aa2df29c6562c2f1589a01d830', 35, 0),
(26, 'hcd', '7b92b307cbeb8741e73b4c155593d49d', 37, 0),
(30, 'subag', '202cb962ac59075b964b07152d234b70', 33, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_file`
--

CREATE TABLE `verifikasi_file` (
  `id` int(10) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `data_bidang_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  `nama_bidang_id` int(10) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `verifikasi_file`
--

INSERT INTO `verifikasi_file` (`id`, `nama_file`, `tanggal_upload`, `data_bidang_id`, `status`, `nama_bidang_id`, `review`) VALUES
(35, 'Simulasi Retur_1.xlsx', '2022-04-01', 17, 1, 36, ''),
(36, 'Simulasi Retur_2.xlsx', '2022-04-05', 12, 1, 33, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `emailkeluar`
--
ALTER TABLE `emailkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `emailmasuk`
--
ALTER TABLE `emailmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `formulir`
--
ALTER TABLE `formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `isi_bidang_tb`
--
ALTER TABLE `isi_bidang_tb`
  ADD PRIMARY KEY (`id_isi_bidang`);

--
-- Indeks untuk tabel `memokeluar`
--
ALTER TABLE `memokeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `memomasuk`
--
ALTER TABLE `memomasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nama_bidang_tb`
--
ALTER TABLE `nama_bidang_tb`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `penawaran`
--
ALTER TABLE `penawaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat punya disposisi` (`id_disposisi`);

--
-- Indeks untuk tabel `surat_keputusan`
--
ALTER TABLE `surat_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`id_tender`);

--
-- Indeks untuk tabel `terdisposisi`
--
ALTER TABLE `terdisposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terdisposisi have surat masuk` (`id_surat`),
  ADD KEY `terdisposisi punya bidang` (`id_bidang`);

--
-- Indeks untuk tabel `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `verifikasi_file`
--
ALTER TABLE `verifikasi_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `emailkeluar`
--
ALTER TABLE `emailkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `emailmasuk`
--
ALTER TABLE `emailmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `formulir`
--
ALTER TABLE `formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `isi_bidang_tb`
--
ALTER TABLE `isi_bidang_tb`
  MODIFY `id_isi_bidang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `memokeluar`
--
ALTER TABLE `memokeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `memomasuk`
--
ALTER TABLE `memomasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nama_bidang_tb`
--
ALTER TABLE `nama_bidang_tb`
  MODIFY `id_bidang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suratmasuk`
--
ALTER TABLE `suratmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `surat_keputusan`
--
ALTER TABLE `surat_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tender`
--
ALTER TABLE `tender`
  MODIFY `id_tender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `terdisposisi`
--
ALTER TABLE `terdisposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_file`
--
ALTER TABLE `verifikasi_file`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD CONSTRAINT `surat punya disposisi` FOREIGN KEY (`id_disposisi`) REFERENCES `disposisi` (`id_disposisi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `terdisposisi`
--
ALTER TABLE `terdisposisi`
  ADD CONSTRAINT `terdisposisi have surat masuk` FOREIGN KEY (`id_surat`) REFERENCES `suratmasuk` (`id`),
  ADD CONSTRAINT `terdisposisi punya bidang` FOREIGN KEY (`id_bidang`) REFERENCES `nama_bidang_tb` (`id_bidang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
