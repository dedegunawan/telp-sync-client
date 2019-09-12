<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/3/19
 * Time: 8:14 AM
 */

namespace DedeGunawan\TelpSyncClient;


use DedeGunawan\UtilityClass\DataStructure;

class Sync
{
    protected $api_key;
    protected $secret_key;
    protected $api_url;
    protected $body;
    protected $params=[];



    public function __construct()
    {
        $this->setParams(new Params([]));
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * @param mixed $secret_key
     */
    public function setSecretKey($secret_key)
    {
        $this->secret_key = $secret_key;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * @param mixed $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return Params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param Params $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    public function appendParamsAuthentication() {
        $columns = $this->getParams()->getColumns();
        $columns['api_key'] = $this->getApiKey();
        $columns['secret_key'] = $this->getSecretKey();
        return $columns;
    }


    /**
     * @throws \Exception
     */
    public function validate_jadwal_ujian() {
        $jadwal_column = array(
            "tanggal",
            "jam_mulai",
            "jam_selesai",
            "id_ruangan",
            "ruangan",
            "peserta",
        );
        $ruangan_column = array(
            "id_ruangan",
            "nama_ruangan",
            "kapasitas",
            "nama_gedung",
        );
        $peserta_column = array(
            "no_reg",
            "npm",
            "password",
            "nama_peserta",
            "email",
        );

        if (!$this->getParams() instanceof DataStructure && is_array($this->getParams())) {
            $this->setParams(new DataStructure($this->getParams()));
        }

        foreach ($jadwal_column as $item) {
            if (!$this->getParams()->hasColumn($item)) throw new \Exception("Kolom $item tidak ada.");
        }

        $ruangan = new DataStructure($this->getParams()->getColumn('ruangan'));
        foreach ($ruangan_column as $item) {
            if (!$ruangan->hasColumn($item)) throw new \Exception("Kolom $item pada ruangan tidak ada.");
        }
        $pesertas = $this->getParams()->getColumn('peserta');

        foreach ($pesertas as $peserta) {
            $peserta = new DataStructure($peserta);
            foreach ($peserta_column as $item) {
                if (!$peserta->hasColumn($item)) throw new \Exception("Kolom $item pada peserta tidak ada.");
            }
        }

    }

    public function _curl_jadwal_ujian() {

        $api_key = $this->getApiKey();
        $secret_key = $this->getSecretKey();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getApiUrl()."/jadwal_ujian",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->getBody(),
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "User-Agent: PostmanRuntime/7.16.3",
                "api_key: $api_key",
                "cache-control: no-cache",
                "secret_key: $secret_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception($err);
        } else {
            return @json_decode($response);
        }
    }


    public function jadwal_ujian() {
        $this->validate_jadwal_ujian();
        $params = $this->appendParamsAuthentication();
        $this->setBody(json_encode($params));
        return $this->_curl_jadwal_ujian();

    }

    public function validate_hasil_ujian() {
        if (
            !$this->getParams()->hasColumn('peserta')
            &&
            !$this->getParams()->hasColumn('id_jadwal')
        ) throw new \Exception("Harus terdapat minimal kolom peserta / id_jadwal");
    }

    public function hasil_ujian() {
        $this->validate_hasil_ujian();
        $params = $this->appendParamsAuthentication();
        $this->setBody(json_encode($params));
        return $this->_curl_hasil_ujian();
    }

    public function _curl_hasil_ujian() {

        $api_key = $this->getApiKey();
        $secret_key = $this->getSecretKey();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getApiUrl()."/hasil_ujian",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->getBody(),
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "User-Agent: PostmanRuntime/7.16.3",
                "api_key: $api_key",
                "cache-control: no-cache",
                "secret_key: $secret_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        var_dump($response);

        curl_close($curl);

        if ($err) {
            throw new \Exception($err);
        } else {
            return @json_decode($response);
        }
    }
}