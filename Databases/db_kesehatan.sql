-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2021 pada 03.18
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kesehatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `NID` varchar(20) NOT NULL,
  `Nama_Dokter` varchar(100) NOT NULL,
  `Jenis_Kelamin` varchar(10) NOT NULL,
  `Alamat` text NOT NULL,
  `Telpon` varchar(12) NOT NULL,
  `Pw` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`NID`, `Nama_Dokter`, `Jenis_Kelamin`, `Alamat`, `Telpon`, `Pw`) VALUES
('00125', 'Dr. Andi', 'Laki-Laki', 'Mataram', '083445124321', '1'),
('123', 'Dr. Kevin Alfero', 'Laki-Laki', 'Jln. Gora II Lingsar, Kec. Lingsar, Kab. LOBAR, Nusa Tengara Barat', '083129846391', ''),
('456', 'Dr. Siti Rosdiana', 'Perempuan', 'Jln Ismail Marzuki, MATARAM', '081287397665', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_materi`
--

CREATE TABLE `tbl_materi` (
  `Id_Matkul` int(11) NOT NULL,
  `NIM` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_materi`
--

INSERT INTO `tbl_materi` (`Id_Matkul`, `NIM`) VALUES
(1, '1810520077');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `Id_obat` int(11) NOT NULL,
  `Nama_obat` varchar(100) NOT NULL,
  `Jumlah_obat` varchar(5) NOT NULL,
  `Ruangan` varchar(50) NOT NULL,
  `NID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`Id_obat`, `Nama_obat`, `Jumlah_obat`, `Ruangan`, `NID`) VALUES
(1, 'Promag', '145', 'GILI AIR', '00125'),
(21, 'Hydrocodone-Acetaminopen', '100', '', '123'),
(22, 'Zocor (Simvastatin)', '150', '', '00125'),
(23, 'Synthroid (levothyroxine sodium)', '200', '', '456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `No` varchar(20) NOT NULL,
  `Nama_Pasien` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telpon` varchar(12) NOT NULL,
  `Ruangan` varchar(100) NOT NULL,
  `Jenis_Kelamin` varchar(10) NOT NULL,
  `Pw` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`No`, `Nama_Pasien`, `Alamat`, `No_Telpon`, `Ruangan`, `Jenis_Kelamin`, `Pw`) VALUES
('1810520077', 'Ms. Ainun Fitri', 'Labuan Bajo', '08311523112', 'Gili Trawangan', 'Perempuan', '1'),
('2', 'Ms. Dinda Latifa', 'Keru, Kec. Narmada', '08312764784', 'Gili Meno', 'Perempuan', ''),
('3', 'Mrs. Faiz Saputra', 'Lendang Nangke, Kec. Jonggat', '08162537296', 'Gili Sudak', 'Laki-laki', ''),
('4', 'Ms. Rina Indrawati', 'Sukadana, Lotim', '087256342637', 'Gili Sudak', 'Perempuan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelajaran`
--

CREATE TABLE `tbl_pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `Id_Matkul` int(11) NOT NULL,
  `NIM` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`NID`);

--
-- Indeks untuk tabel `tbl_materi`
--
ALTER TABLE `tbl_materi`
  ADD KEY `mate_matku` (`Id_Matkul`),
  ADD KEY `mate_mhs` (`NIM`);

--
-- Indeks untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`Id_obat`),
  ADD KEY `mat_dos` (`NID`);

--
-- Indeks untuk tabel `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`),
  ADD KEY `pel_matkul` (`Id_Matkul`),
  ADD KEY `pel_mhs` (`NIM`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_materi`
--
ALTER TABLE `tbl_materi`
  ADD CONSTRAINT `mate_matku` FOREIGN KEY (`Id_Matkul`) REFERENCES `tbl_obat` (`Id_obat`),
  ADD CONSTRAINT `mate_mhs` FOREIGN KEY (`NIM`) REFERENCES `tbl_pasien` (`NO`);

--
-- Ketidakleluasaan untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD CONSTRAINT `mat_dos` FOREIGN KEY (`NID`) REFERENCES `tbl_dokter` (`NID`);

--
-- Ketidakleluasaan untuk tabel `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  ADD CONSTRAINT `pel_matkul` FOREIGN KEY (`Id_Matkul`) REFERENCES `tbl_obat` (`Id_obat`),
  ADD CONSTRAINT `pel_mhs` FOREIGN KEY (`NIM`) REFERENCES `tbl_pasien` (`NO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
