-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Jan 2019 pada 10.13
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5850705_siakad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `telp`) VALUES
(1, 'AP\'AL SUHENGKI', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 858213347);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(4) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `telp`, `email`, `pendidikan_terakhir`, `foto`, `password`) VALUES
('1108038501', 'Siska Dewi Lestari, S.Si., M.Cs', 'Perempuan', '1986-01-09', 'jalan mangkusari', '085821334750', 'siskadewi@gmail.com', 'S2', '5c16035cb4942.png', '$2y$10$F0xpTsc5ysh7lrhVnEkxm.ELmRKK5hBg.VmUQK23O86C.X1HHZzvq'),
('1123097302', 'Herry Hermawan, S.Kom., M.Cs', 'Laki-Laki', '1995-01-01', 'jalan sengaji hilir', '085821334750', 'herryhermawan@gmail.com', 'S2', '5c16017dd89df.png', '$2y$10$zVKCaMayBnZ6A2c16wu8ZeakFh.rfgmWiEURH.8ohGkrqSJxNEcaq'),
('991162207', 'Riana, S.Kom', 'Perempuan', '1990-04-02', 'jalan Mangkusari', '085821334750', 'riana@gmail.com', 'S1', 'avatar.png', '$2y$10$GaTgpVX/oiJsQXwVe0fX2ur3TO3l4sNMGI6HCBP57avsNUeC2mflS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_krs` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `hari` varchar(6) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_krs`, `id_mk`, `nip`, `id_semester`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, '1123097302', 20181, 'Senin', '08:00:00', '00:00:00'),
(2, 2, '1123097302', 20181, 'SENIN', '10:00:00', '11:30:00'),
(4, 5, '1108038501', 20181, 'SELASA', '08:00:00', '10:00:00'),
(5, 19, '1108038501', 20181, 'RABU', '08:30:00', '10:30:00'),
(6, 20, '1123097302', 20181, 'RABU', '09:00:00', '11:00:00'),
(7, 14, '1108038501', 20182, 'KAMIS', '10:00:00', '11:30:00'),
(8, 17, '991162207', 20181, 'KAMIS', '08:00:00', '10:00:00'),
(9, 21, '991162207', 20181, 'SELASA', '08:00:00', '09:30:00'),
(10, 16, '1123097302', 20181, 'SABTU', '10:00:00', '11:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kode_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(40) NOT NULL,
  `bidang_studi` varchar(15) NOT NULL,
  `nip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `kode_jurusan`, `nama_jurusan`, `bidang_studi`, `nip`) VALUES
(1, 'MI', 'MANAJEMEN INFORMATIKA', 'NON REKAYASA', '1123097302'),
(2, 'TP', 'TEKNIK PERTAMBANGAN', 'REKAYASA', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `khs`
--

CREATE TABLE `khs` (
  `id_khs` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `id_krs` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `nilai_tgs` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `nilai_huruf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `khs`
--

INSERT INTO `khs` (`id_khs`, `nim`, `id_krs`, `id_paket`, `id_semester`, `nilai_tgs`, `nilai_uts`, `nilai_uas`, `nilai_akhir`, `nilai_huruf`) VALUES
(64, '175610008', 6, 2, 20181, 90, 91, 92, 93, 'A'),
(70, '175610008', 4, 2, 20181, 90, 91, 92, 93, 'A'),
(71, '175610008', 5, 2, 20181, 80, 81, 82, 83, 'A'),
(77, '175610012', 7, 2, 20181, 70, 71, 72, 73, 'B'),
(80, '1400005290', 4, 2, 20181, 70, 71, 72, 73, 'B'),
(81, '1400005290', 5, 2, 20181, 70, 71, 72, 73, 'B'),
(82, '1400005290', 7, 2, 20181, 0, 0, 0, 0, ''),
(83, '1400005290', 6, 2, 20181, 0, 0, 0, 0, ''),
(84, '1400005290', 10, 2, 20181, 0, 0, 0, 0, ''),
(85, '1400005290', 8, 2, 20181, 0, 0, 0, 0, ''),
(86, '1400005290', 9, 2, 20181, 0, 0, 0, 0, ''),
(87, '175610012', 4, 2, 20181, 80, 81, 82, 83, 'B'),
(88, '175610012', 5, 2, 20181, 50, 51, 52, 53, 'C'),
(89, '175610012', 6, 2, 20181, 0, 0, 0, 0, ''),
(90, '175610012', 10, 2, 20181, 0, 0, 0, 0, ''),
(91, '175610012', 8, 2, 20181, 0, 0, 0, 0, ''),
(92, '175610012', 9, 2, 20181, 0, 0, 0, 0, ''),
(93, '175610008', 7, 2, 20181, 0, 0, 0, 0, ''),
(94, '175610008', 10, 2, 20181, 0, 0, 0, 0, ''),
(95, '175610008', 8, 2, 20181, 0, 0, 0, 0, ''),
(96, '175610008', 9, 2, 20181, 0, 0, 0, 0, ''),
(97, '183110020', 4, 2, 20181, 60, 61, 62, 63, 'C'),
(98, '183110020', 5, 2, 20181, 51, 52, 53, 54, 'C'),
(99, '183110020', 7, 2, 20181, 0, 0, 0, 0, ''),
(100, '183110020', 6, 2, 20181, 0, 0, 0, 0, ''),
(101, '183110020', 10, 2, 20181, 0, 0, 0, 0, ''),
(102, '183110020', 8, 2, 20181, 0, 0, 0, 0, ''),
(103, '183110020', 9, 2, 20181, 0, 0, 0, 0, ''),
(104, '5740113007', 4, 2, 20181, 61, 62, 63, 64, 'C'),
(105, '5740113007', 5, 2, 20181, 52, 53, 54, 55, 'C'),
(106, '5740113007', 7, 2, 20181, 0, 0, 0, 0, ''),
(107, '5740113007', 6, 2, 20181, 0, 0, 0, 0, ''),
(108, '5740113007', 10, 2, 20181, 0, 0, 0, 0, ''),
(109, '5740113007', 8, 2, 20181, 0, 0, 0, 0, ''),
(110, '5740113007', 9, 2, 20181, 0, 0, 0, 0, ''),
(111, '5740113011', 4, 2, 20181, 62, 63, 64, 65, 'C'),
(112, '5740113011', 5, 2, 20181, 53, 54, 55, 56, 'C'),
(113, '5740113011', 7, 2, 20181, 0, 0, 0, 0, ''),
(114, '5740113011', 6, 2, 20181, 0, 0, 0, 0, ''),
(115, '5740113011', 10, 2, 20181, 0, 0, 0, 0, ''),
(116, '5740113011', 8, 2, 20181, 0, 0, 0, 0, ''),
(117, '5740113011', 9, 2, 20181, 0, 0, 0, 0, ''),
(118, '5740113013', 4, 2, 20181, 63, 64, 65, 66, 'C'),
(119, '5740113013', 5, 2, 20181, 54, 55, 56, 57, 'C'),
(120, '5740113013', 7, 2, 20181, 0, 0, 0, 0, ''),
(121, '5740113013', 6, 2, 20181, 0, 0, 0, 0, ''),
(122, '5740113013', 10, 2, 20181, 0, 0, 0, 0, ''),
(123, '5740113013', 8, 2, 20181, 0, 0, 0, 0, ''),
(124, '5740113013', 9, 2, 20181, 0, 0, 0, 0, ''),
(125, '5740113016', 4, 2, 20181, 64, 65, 66, 67, 'C'),
(126, '5740113016', 5, 2, 20181, 55, 56, 57, 58, 'C'),
(127, '5740113016', 7, 2, 20181, 0, 0, 0, 0, ''),
(128, '5740113016', 6, 2, 20181, 0, 0, 0, 0, ''),
(129, '5740113016', 10, 2, 20181, 0, 0, 0, 0, ''),
(130, '5740113016', 8, 2, 20181, 0, 0, 0, 0, ''),
(131, '5740113016', 9, 2, 20181, 0, 0, 0, 0, ''),
(132, '5740113017', 4, 2, 20181, 65, 66, 67, 68, 'C'),
(133, '5740113017', 5, 2, 20181, 56, 57, 58, 59, 'C'),
(134, '5740113017', 7, 2, 20181, 0, 0, 0, 0, ''),
(135, '5740113017', 6, 2, 20181, 0, 0, 0, 0, ''),
(136, '5740113017', 10, 2, 20181, 0, 0, 0, 0, ''),
(137, '5740113017', 8, 2, 20181, 0, 0, 0, 0, ''),
(138, '5740113017', 9, 2, 20181, 0, 0, 0, 0, ''),
(139, '5740113019', 4, 2, 20181, 66, 67, 68, 69, 'C'),
(140, '5740113019', 5, 2, 20181, 57, 58, 59, 60, 'C'),
(141, '5740113019', 7, 2, 20181, 0, 0, 0, 0, ''),
(142, '5740113019', 6, 2, 20181, 0, 0, 0, 0, ''),
(143, '5740113019', 10, 2, 20181, 0, 0, 0, 0, ''),
(144, '5740113019', 8, 2, 20181, 0, 0, 0, 0, ''),
(145, '5740113019', 9, 2, 20181, 0, 0, 0, 0, ''),
(146, '5740113028', 4, 2, 20181, 67, 68, 69, 70, 'C'),
(147, '5740113028', 5, 2, 20181, 58, 59, 60, 61, 'C'),
(148, '5740113028', 7, 2, 20181, 0, 0, 0, 0, ''),
(149, '5740113028', 6, 2, 20181, 0, 0, 0, 0, ''),
(150, '5740113028', 10, 2, 20181, 0, 0, 0, 0, ''),
(151, '5740113028', 8, 2, 20181, 0, 0, 0, 0, ''),
(152, '5740113028', 9, 2, 20181, 0, 0, 0, 0, ''),
(153, '5740113029', 4, 0, 20181, 80, 81, 82, 83, 'B'),
(154, '5740113029', 5, 0, 20181, 59, 60, 61, 62, 'C'),
(155, '5740113029', 7, 0, 20181, 0, 0, 0, 0, ''),
(156, '5740113029', 6, 0, 20181, 0, 0, 0, 0, ''),
(157, '5740113029', 10, 0, 20181, 0, 0, 0, 0, ''),
(158, '5740113029', 8, 0, 20181, 0, 0, 0, 0, ''),
(159, '5740113029', 9, 0, 20181, 0, 0, 0, 0, ''),
(160, '5740113037', 4, 2, 20181, 81, 82, 83, 84, 'B'),
(161, '5740113037', 5, 2, 20181, 60, 61, 62, 63, 'C'),
(162, '5740113037', 7, 2, 20181, 0, 0, 0, 0, ''),
(163, '5740113037', 6, 2, 20181, 0, 0, 0, 0, ''),
(164, '5740113037', 10, 2, 20181, 0, 0, 0, 0, ''),
(165, '5740113037', 8, 2, 20181, 0, 0, 0, 0, ''),
(166, '5740113037', 9, 2, 20181, 0, 0, 0, 0, ''),
(167, '5740113039', 4, 2, 20181, 82, 83, 84, 85, 'B'),
(168, '5740113039', 5, 2, 20181, 61, 62, 63, 64, 'C'),
(169, '5740113039', 7, 2, 20181, 0, 0, 0, 0, ''),
(170, '5740113039', 6, 2, 20181, 0, 0, 0, 0, ''),
(171, '5740113039', 10, 2, 20181, 0, 0, 0, 0, ''),
(172, '5740113039', 8, 2, 20181, 0, 0, 0, 0, ''),
(173, '5740113039', 9, 2, 20181, 0, 0, 0, 0, ''),
(174, '5740113047', 4, 2, 20181, 83, 84, 85, 86, 'A'),
(175, '5740113047', 5, 2, 20181, 62, 63, 64, 65, 'C'),
(176, '5740113047', 7, 2, 20181, 0, 0, 0, 0, ''),
(177, '5740113047', 6, 2, 20181, 0, 0, 0, 0, ''),
(178, '5740113047', 10, 2, 20181, 0, 0, 0, 0, ''),
(179, '5740113047', 8, 2, 20181, 0, 0, 0, 0, ''),
(180, '5740113047', 9, 2, 20181, 0, 0, 0, 0, ''),
(181, '5740113050', 4, 2, 20181, 84, 85, 86, 87, 'A'),
(182, '5740113050', 5, 2, 20181, 63, 64, 65, 66, 'C'),
(183, '5740113050', 7, 2, 20181, 0, 0, 0, 0, ''),
(184, '5740113050', 6, 2, 20181, 0, 0, 0, 0, ''),
(185, '5740113050', 10, 2, 20181, 0, 0, 0, 0, ''),
(186, '5740113050', 8, 2, 20181, 0, 0, 0, 0, ''),
(187, '5740113050', 9, 2, 20181, 0, 0, 0, 0, ''),
(188, '5740115002', 4, 2, 20181, 85, 86, 87, 88, 'A'),
(189, '5740115002', 5, 2, 20181, 64, 65, 66, 67, 'C'),
(190, '5740115002', 7, 2, 20181, 0, 0, 0, 0, ''),
(191, '5740115002', 6, 2, 20181, 0, 0, 0, 0, ''),
(192, '5740115002', 10, 2, 20181, 0, 0, 0, 0, ''),
(193, '5740115002', 8, 2, 20181, 0, 0, 0, 0, ''),
(194, '5740115002', 9, 2, 20181, 0, 0, 0, 0, ''),
(195, '5740115007', 4, 2, 20181, 86, 87, 88, 89, 'A'),
(196, '5740115007', 5, 2, 20181, 65, 66, 67, 68, 'C'),
(197, '5740115007', 7, 2, 20181, 0, 0, 0, 0, ''),
(198, '5740115007', 6, 2, 20181, 0, 0, 0, 0, ''),
(199, '5740115007', 10, 2, 20181, 0, 0, 0, 0, ''),
(200, '5740115007', 8, 2, 20181, 0, 0, 0, 0, ''),
(201, '5740115007', 9, 2, 20181, 0, 0, 0, 0, ''),
(202, '5740115026', 4, 2, 20181, 87, 88, 89, 90, 'A'),
(203, '5740115026', 5, 2, 20181, 66, 67, 68, 69, 'C'),
(204, '5740115026', 7, 2, 20181, 0, 0, 0, 0, ''),
(205, '5740115026', 6, 2, 20181, 0, 0, 0, 0, ''),
(206, '5740115026', 10, 2, 20181, 0, 0, 0, 0, ''),
(207, '5740115026', 8, 2, 20181, 0, 0, 0, 0, ''),
(208, '5740115026', 9, 2, 20181, 0, 0, 0, 0, ''),
(209, '5740115031', 4, 2, 20181, 88, 89, 90, 91, 'A'),
(210, '5740115031', 5, 2, 20181, 67, 68, 69, 70, 'C'),
(211, '5740115031', 7, 2, 20181, 0, 0, 0, 0, ''),
(212, '5740115031', 6, 2, 20181, 0, 0, 0, 0, ''),
(213, '5740115031', 10, 2, 20181, 0, 0, 0, 0, ''),
(214, '5740115031', 8, 2, 20181, 0, 0, 0, 0, ''),
(215, '5740115031', 9, 2, 20181, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `telp`, `email`, `agama`, `foto`, `password`, `nip`, `id_jurusan`) VALUES
('1400005290', 'WISNU INDRA MAULANA', 'Laki-Laki', 'SETREN, WONOGIRI', '1994-07-04', 'Jln Sengaji Hilir Gg Rahmat', '085821334750', 'wisnu@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$KxdbNZEVslxT1liKnlq0hOYmk5PUUxo3ZDBjd9WQSizqJRKtdtz2e', '991162207', 1),
('175610008', 'WAHYU SAHRANI', 'Laki-Laki', 'Muara Teweh', '1995-01-01', 'JALAN SENGAJI HILIR GANG RAHMAT, RT 07 NO 54', '085821334750', 'wahyusahrani@gmail.com', 'Islam', '5bc6951ea2846.jpg', '$2y$10$8A49lWUDorVkz/JO9EcLLOeG8H5cbTKYzV9DX2yfbhA.d0ELkUi7i', '', 1),
('175610012', 'DEDY KUNCORO', 'Laki-Laki', 'Pontianak', '1997-02-03', 'Pontianak', '085821334750', 'dedy@gmail.com', 'Islam', 'avatar.png', '$2y$10$vWqDDr8FFPV0Cjv9a.u4We8RFL1gzm5FNTDnMQQ6Wg14gLJqVajGS', '175610008', 1),
('183110020', 'NOVITA CENIZ', 'Perempuan', 'KEBUMEN', '2000-07-04', 'Kebumen', '081289930789', 'cenis_mania-mantap@gmail.com', 'ISLAM', '5c1cffdf5cd8d.jpg', '$2y$10$cVCivf0jcXRAzpn5R.Bsv.TM9wgO1ux5Ao8nz.D5R8ml0dIbYEe9W', '1108038501', 1),
('5740112017', 'ZAINUDIN AL CHALID', 'Laki-Laki', 'MUARA TEWEH', '1995-01-31', 'JALAN MANGGIS', '085821334775', 'zainudin@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$hM9NxN0l8KJAIRY3rt6SDO.dmMoVj7oBehWBXU6uOqGEbQxjdzxDS', '1123097302', 1),
('5740113007', 'ANSARI SESILIA', 'Perempuan', 'MUARA TEWEH', '1996-12-26', 'JALAN MANA YAH ....', '085821334750', 'sarisesilia@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$4aB7I0wtBcTfMAxGZiCd9enfiXnFu07lUtB5nBLdYaqqm.UEQ0bL2', '1123097302', 1),
('5740113011', 'ARISKA MARTINALOVA', 'Perempuan', 'MUARA TEWEH', '1995-12-26', 'JALAN JINGAH', '085821334750', 'ariska@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$WRh8/4KbsqwTP8/1.RfXCer/OIXXBTk/CYjdnpZJM159vsICfUojq', '991162207', 1),
('5740113013', 'DWI SETIANA', 'Perempuan', 'MUARA TEWEH', '1995-10-18', 'JALAN NEGARA', '85821334779', 'dwi@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$PLcKxwu3RiLGRT6/mJ0bm.ITdlBAXhrfvzFfYND6xZRdIiySEUdnS', '1108038501', 1),
('5740113016', 'DERA FARIYANTI', 'Perempuan', 'MUARA TEWEH', '1995-01-11', 'JALAN APA YAH, ', '085821334750', 'dera@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$K6/FBkCqckSyaHvqGswa7OS7XXmv5jETpuTkBC8Jo8huWpbaeT3Ia', '1108038501', 1),
('5740113017', 'DESY PURNAMASARI', 'Perempuan', 'MUARA TEWEH', '1996-12-29', 'JLN BUKIT BAMBU', '085821334750', 'desy@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$3NzDRsOdHA6Ggch5yJMho.WidzhPgb6PGd4FwkM6.buASGqkKXbtG', '1123097302', 1),
('5740113019', 'ERMILA SARI', 'Perempuan', 'MUARA TEWEH', '1995-09-25', 'JALAN APA LAH KADA INGAT AKU', '85821334765', 'mila@gmail.com', 'KRISTEN', 'avatar.png', '$2y$10$RPXHDq3IQJqby7KmBb.iyugR/9cbMNMYyGIwtMLntY/dXHq9rgJgC', '1108038501', 1),
('5740113028', 'MAULIJAH EKA DAMAYANTI', 'Perempuan', 'MUARA TEWEH', '1996-12-27', 'JALAN MAWAR KAN?', '85821334800', 'eka@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$3rTmPA4s8KyMQPI0..wKdOIsYKyY4RLf2mw6IhgdDQh9QFt./G4r2', '1123097302', 1),
('5740113029', 'MELANTI', 'Perempuan', 'MUARA TEWEH', '1994-03-23', 'JALAN KUBURAN CINA', '085821334750', 'melan@gmail.com', 'ISLAM', '5c1ce9bac53d3.jpg', '$2y$10$DpODSQlGE6RtemBwexgE7eJn4TaLtOqIfaOMoX4/pXwuCXsKpE7rW', '991162207', 1),
('5740113037', 'RUSMAWATI', 'Perempuan', 'MUARA TEWEH', '1995-12-26', 'JALAN BUAH NAGA', '085821334750', 'rusmawati@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$fKAuBD7U1XD2QaFyXyAQpeXi0yKk3AdextnMLR95lVtbO0.ZyO49W', '1108038501', 1),
('5740113039', 'SAIFUL ANWAR', 'Laki-Laki', 'JINGAH', '1994-11-11', 'JALAN REVOLUSI RT.04 KEL.JINGAH KEC.TEWEH BARU', '085348001364', 'saiful.anwar.bigboss@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$UMhaB1vmWicZaPGW7uIdUe/1ieaH.U7dZkv.YhduEIbcpDWw8lvIq', '1123097302', 1),
('5740113047', 'WINDA', 'Perempuan', 'MUARA TEWEH', '1995-01-11', 'JALAN JINGAH', '085821334750', 'winda@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$BUayHzrRPSi27xtj7SUpeuZUc6mwGbG4Wt58u/S6DmyBRQmr5O2YO', '1123097302', 1),
('5740113050', 'MELISA ENI NOVIANA', 'Perempuan', 'TRAHAYAN ', '1996-11-26', 'JALAN TRAHAYAN', '085821334750', 'melisa@gmail.com', 'Kristen', 'avatar.png', '$2y$10$cHCoWUgbBhxfQlgUYsVt7.DjtmGzOKMIr4WOMlA1wI8YtQRa0E6VK', '1108038501', 1),
('5740115002', 'YEYEN', 'Perempuan', 'MUARA TEWEH', '1998-12-20', 'JALAN KENANGA', '0875740115002', 'yeyen@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$hKUoSB.dmu9NCga9XbSjAuwl4rFPEtA9zNoJ93F3TfXJG01QVmw1m', '991162207', 1),
('5740115007', 'RISNAWATI', 'Perempuan', 'KANDUI', '1997-12-30', 'JALAN KANDUI', '085821334750', 'risna@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$6GuR9KN0xlCo2rJfir8HbOqcxR3/yS.VEPtptPHCaNAkqQBUj92rW', '1123097302', 1),
('5740115026', 'LYDIA ULFAH', 'Perempuan', 'MUARA TEWEH', '1997-12-11', 'JLN SENGAJI HILIR', '085821334750', 'ulfah@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$kRGPJunfv45alYltd1JwCOHtQVoIZqbfY0iNx4jbCI3WysSf/U8qS', '1108038501', 1),
('5740115031', 'ERWIN MAULANA HIDAYAT', 'Laki-Laki', 'MUARA TEWEH', '1997-10-24', 'JALAN KUBURAN CINA', '085821334789', 'erwin@gmail.com', 'ISLAM', 'avatar.png', '$2y$10$d0LCsF7QKovfi79qBTtE.ubCuoka/6S8YVUBrmJD72Cj0b0Lw4i0y', '1123097302', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int(11) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(2) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
(1, 'MI-1101', 'Agama ', 2, 1),
(2, 'MI-1102', 'Pancasila', 2, 1),
(4, 'MI-1203', 'Statistik Deskriptif', 3, 1),
(5, 'MI-1103', 'Bahasa Indonesia', 2, 2),
(6, 'MI-1202', 'Kalkulus I', 2, 1),
(7, 'MI-1302', 'Logika dan Algoritma I', 3, 1),
(8, 'MI-1303', 'Pemrograman I', 4, 1),
(9, 'MI-1304', 'Pengolah Kata', 2, 1),
(10, 'MI-2307', 'SpreedSheet', 2, 1),
(11, 'MI-3208', 'Bahasa Inggris I', 2, 1),
(12, 'MI-1301', 'Pengantar Pengolahan Data Elektronik', 2, 1),
(13, 'MI-2102', 'Kewarganegaraan', 2, 2),
(14, 'MI-2204', 'Kalkulus II', 2, 2),
(15, 'MI-2206', 'Statistik Probabilitas', 2, 2),
(16, 'MI-2207', 'Dasar Akuntasi', 2, 2),
(17, 'MI-2305', 'Logika dan Algoritma II', 3, 2),
(18, 'MI-2306', 'Sistem Basis Data I', 2, 2),
(19, 'MI-2308', 'Pemrograman II', 4, 2),
(20, 'MI-3313', 'Sistem Operasi', 2, 2),
(21, 'MI-4209', 'Bahasa Inggris II', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `judul` text NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `id_mk`, `judul`, `file`) VALUES
(1, 1, 'assalamualaikum beijing', '5c0f5a8a1346c175610008_WahyuSahrani_Pertemuan6.docx'),
(2, 2, 'Pemrograman Web', '5c0f65c5c2d0aid_etika_kehidupanm_muslim_sehari_hari.pdf'),
(3, 2, 'bismillah', '5c0f6c6fc186fSystemAcceptanceTesting.ppt'),
(5, 19, 'percobaan kedua', '5c10a1deb3947id_etika_kehidupanm_muslim_sehari_hari.pdf'),
(8, 5, 'assalamualaikum beijing', '5c16b12a8b159Menghitung_nilai_IP_dengan_web_service.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_semester`
--

CREATE TABLE `paket_semester` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_semester`
--

INSERT INTO `paket_semester` (`id_paket`, `nama_paket`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id_semester`, `nama_semester`, `status`) VALUES
(20181, '2018 / 2019 Ganjil', '1'),
(20182, '2018 / 2019 Genap', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transkrip`
--

CREATE TABLE `transkrip` (
  `id_transkrip` int(11) NOT NULL,
  `ipk` varchar(5) NOT NULL,
  `judul_ta` text NOT NULL,
  `predikat` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nim` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_krs`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `khs`
--
ALTER TABLE `khs`
  ADD PRIMARY KEY (`id_khs`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `paket_semester`
--
ALTER TABLE `paket_semester`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  ADD PRIMARY KEY (`id_transkrip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `khs`
--
ALTER TABLE `khs`
  MODIFY `id_khs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `paket_semester`
--
ALTER TABLE `paket_semester`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20183;

--
-- AUTO_INCREMENT untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  MODIFY `id_transkrip` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_krs`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
