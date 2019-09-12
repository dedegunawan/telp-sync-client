<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/3/19
 * Time: 10:29 AM
 */

namespace DedeGunawan\TelpSyncClient;


use DedeGunawan\UtilityClass\DataStructure;

/**
 * Class Params
 * @package DedeGunawan\TelpSyncClient
 * @property mixed $id_jadwal
 * @property mixed $tanggal
 * @property mixed $jam_mulai
 * @property mixed $jam_selesai
 * @property mixed $id_ruangan
 * @property mixed $ruangan
 * @property mixed $peserta
 * @method void setIdJadwal($id_jadwal)
 * @method mixed getIdJadwal()
 * @method void setTanggal($tanggal)
 * @method mixed getTanggal()
 * @method void setJamMulai($jam_mulai)
 * @method mixed getJamMulai()
 * @method void setJamSelesai($jam_selesai)
 * @method mixed getJamSelesai()
 * @method void setIdRuangan($id_ruangan)
 * @method mixed getIdRuangan()
 * @method void setRuangan($ruangan)
 * @method Ruangan getRuangan()
 * @method void setPeserta($peserta)
 * @method array getPeserta()
 */
class Params extends CustomDataStructure
{
    public function validate() {
        foreach ($this->getColumns() as $column => $value) {
            if (is_array($value)) {

            }
        }
    }
}