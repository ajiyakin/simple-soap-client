# simple-soap-client
Simple Soap Client Menggunakan PHP

## Cara Install

### Menggunakan Komposer

```json
{
    ....
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ajiyakin/simple-soap-client"
        }
    ],
    "require": {
        "ajiyakin/simplesoapclient": "dev-master"
    },
    ....
}
```

## Persamaan Persepsi

### SOAP

Soap, secara sederhana (menurut bahasa saya) adalah proses komunikasi 2 komputer
(biasanya server), dimana komputer yang satu berusaha memanggil `fungsi` yang
ada dikomputer kedua atau sebaliknya. Media komunikasi kedua komputer tersebut
biasa disebut WSDL (biasanya berupa XML).


### Ide Dasar

#### Masalah yang coba dipecahkan package ini adalah:

Ketika kita sering bergonta-ganti konfigurasi untuk pemanggilan ke server
SOAP yang berbeda-beda. Misalnya ke-10 server SOAP yang berbeda-beda.

#### Solusi yang ditawarkan dari package ini adalah:

Membuat interface untuk kelas konfigurasi, ini karena prinsip dasar SOAP diatas
(bagian Persamaan Persepsi - SOAP) yang 'biasanya' hanya membutuhkan parameter
untuk autentikasi (biasanya username dan password), URL, nama fungsi, serta
parameter untuk fungsi yang akan dipanggilnya tersebut (yang biasa didalam
kurung sebelah nama fungsi itu loh kalo kita bikin fungsi).


## Cara Menggunakannya

1. Buat kelas yang mengimplementasikan interface `SimpleSoapConfigInterface`
   untuk setiap configurasi yang berbeda.
2. Instansiasi pemanggil soap (`SimpleSoapClient`), jangan lupan meng-inject
   object configurasi yang telah dibuat.
3. Panggil fungsi `execute` untuk mengeksekusi pemanggilan fungsi.


## Example

### Skenario

Saya ingin memanggil fungsi `AmbilJodoh` yang ada diserver
`http://nama.server/jodohku/soap?wsdl`. Sedangkan parameter yang dibutuhkan
untuk memanggil fungsi tersebut adalah parameter `id_jodoh`. Untuk autentikasi
saya telah diberi hak akses dengan username:`cinta` dan password:`rindu`.

### Penyelesaian

#### 1. Buat kelas yang mengimplementasikan `SimpleSoapConfigInterface`

```php
<?php // file SoapConfig.php

namespace aji;

use ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface as ConfigInterface;


class SoapConfig implements ConfigInterface
{
    private $url = 'http://nama.server/jodohku/soap?wsdl';
    private $username = 'cinta';
    private $password = 'rindu';

    // secara default, nama fungsi ini akan dipanggil jika nama fungsi tidak di set manual
    private $functionName = 'AmbilJodoh';

    // secara default, parameter ini akan dikirimkan, jika paramter tidak diset
    private $params = array(
        'id_jodoh' = '123456789'
    );


    public function getUrl(){ return $this->url; }
    public function getUsername(){ return $this->url; }
    public function getPassword(){ return $this->url; }
    public function getFunctionName(){ return $this->url; }
    public function getParams() { return $this->params; }
    public function setUrl($newUrl){ return $this->url = $newUrl; }
    public function setUsername($newUsername){ return $this->url = $newUsername; }
    public function setPassword($newPassword){ return $this->url = $newPassword; }
    public function setFunctionName($newFunctionName){ return $this->url = $newFunctionName; }
    public function setParams($newParams){ return $this->params = $newParams; }
}
```


#### 2. Implementasikan konfigurasi yang telah dibuat

```php
<?php // file JodohController.php

namespace aji;

use ajiyakin\simplesoapclient\SimpleSoapClient;


class JodohController
{
    public function ambilJodoh()
    {
        // buat konfigurasi
        $config = new SoapConfig();

        // set nama fungsi
        $config->setFunctionName('AmbilJodoh');

        // set parameter
        $params = array('id_jodoh' => '123456789');
        $config->setParams($params);

        // buat objek pemanggil soap (simple soap), jangan lupa inject configurasinya
        $soap = new SimpleSoapClient($config);

        // eksekusi
        $result = $soap->execute();

        // tampilkan hasilnya
        print_r($result);


        /**
         * Bagaimana jika saya ingin memanggil fungsi yang berbeda???
         * Gampaaaangg...
         */
        $config->setFunctionName('TolakJodoh');
        $config->setParams(array('alasan'=>'Fokus pendidikan'));
        $soap->setConfiguration($config);
        $result2 = $soap->execute();
        print_r($result2);
    }
}
```


### Unit Test Example

#### Not yet... :D


## TODO

- Tambahkan parameter optional untuk fungsi `execute` untuk memilih tipe
  kembalian dari server. Bisa JSON, XML ataupun Object.


# EXAMPLE UNTESTED !!!!!!!!

