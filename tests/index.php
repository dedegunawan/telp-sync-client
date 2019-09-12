<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/3/19
 * Time: 8:16 AM
 */

require_once '../vendor/autoload.php';


$client = new \DedeGunawan\TelpSyncClient\Sync();

$client->setApiKey('telp');
$client->setSecretKey('unsil');
$client->setApiUrl('https://pmb.unsil.ac.id/telp/sync/');

$params = new \DedeGunawan\TelpSyncClient\Params([]);
$params->setIdJadwal('32');
$params->setTanggal('2019-03-28');
$params->setJamMulai('13:30:00');
$params->setJamSelesai('15:30:00');
$params->setIdRuangan('22');
$params->setRuangan([
    'id_ruangan' => 22,
    "nama_ruangan" => "01",
    "kapasitas" => "40",
    "nama_gedung" => "Teknik"
]);

$params->setPeserta([
    [
        "no_reg" => "000003",
        "tgl_reg" => "2019-03-14 06:13:18",
        "npm" => "147006159",
        "password" => "123456",
        "nama_peserta" => "Nizar Maulana",
        "jenis_kelamin" => "Laki-laki",
        "fakultas" => "Teknik",
        "jurusan" => "Informatika",
        "tempat_lahir" => "Ciamis",
        "tanggal_lahir" => "1996-03-07",
        "alamat" => "Dusun Cikaronjo, Rt/Rw 06/01, Desa Bendasari, Kecamatan Sadananya, Kabupaten Ciamis",
        "no_hp" => "081222939323",
        "no_wa" => "082223222222",
        "email" => "nizarmaulana@gmail.com",
        "keperluan_tes" => "Syarat Sidang",
        "nama_file" => "IMG_20170415_094701.jpg",
        "level" => "Mahasiswa"
    ],
    [
        "no_reg" => "000004",
        "tgl_reg" => "2019-03-14 06:13:18",
        "npm" => "147006160",
        "password" => "123456",
        "nama_peserta" => "Nizar Maulana",
        "jenis_kelamin" => "Laki-laki",
        "fakultas" => "Teknik",
        "jurusan" => "Informatika",
        "tempat_lahir" => "Ciamis",
        "tanggal_lahir" => "1996-03-07",
        "alamat" => "Dusun Cikaronjo, Rt/Rw 06/01, Desa Bendasari, Kecamatan Sadananya, Kabupaten Ciamis",
        "no_hp" => "081222939323",
        "no_wa" => "082223222222",
        "email" => "nizarmaulana@gmail.com",
        "keperluan_tes" => "Syarat Sidang",
        "nama_file" => "IMG_20170415_094701.jpg",
        "level" => "Mahasiswa"
    ],
]);

$client->setParams($params);

//var_dump($client->jadwal_ujian());


$params = new \DedeGunawan\TelpSyncClient\Params([
    'id_jadwal' => 32
]);
$client->setParams($params);
var_dump($client->hasil_ujian());
