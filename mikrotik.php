<?php
use MongoDB\Driver\Session;
session_start();
require 'api.php';
class Mikbot
{
    public function CurlTele($token){
        $url = "https://api.telegram.org/bot" . $token . "/getUpdates";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");

            $respon = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($respon, true);
        //PROSES CEK FILE TXT
        if(!file_exists('idchat.txt')){
            echo "\033[33m[+]FILE IDCHAT.TXT TIDAK TERSEDIA" .PHP_EOL;
            echo "\033[33m[+]MEMBUAT FILE IDCHAT.TXT" .PHP_EOL;
            $url = "https://api.telegram.org/bot" . $token . "/getUpdates";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");

            $respon = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($respon, true);
            // var_dump($json);
            
            if(is_null($id = $json['result'][0]['message']['chat']['id'])){
                echo "\033[31m[+]GAGAL MEMBUAT FILE IDCHAT.TXT!" . PHP_EOL;
                "\n";
                echo "\033[31m[+]ID CHAT BOT TIDAK DITEMUKAN!" . PHP_EOL;
                "\n";
                echo "\033[31m[+]JIKA MASIH TIDAK MEDAPATKAN ID. COBA KIRIM PESAN KE BOT YANG ANDA BUAT DAN TUNGGU BEBERAPA SAAT LAGI!" . PHP_EOL;
                "\n";
                 exit;
             }
            $id = $json['result'][0]['message']['chat']['id'];
            $nama_file = 'idchat.txt';
            $file_idchat = fopen($nama_file, 'w');
            $konten = fwrite($file_idchat, $id);
            fclose($file_idchat);
            $id = trim(file_get_contents('idchat.txt'));

            
            
        }
            
            
            echo "\033[32m[+]FILE IDCHAT.TXT TERSEDIA" .PHP_EOL;
            echo "\033[32m[+]PERIKSA FILE IDCHAT.TXT" .PHP_EOL;
            $id = trim(file_get_contents('idchat.txt'));
            // var_dump($id);
            // exit;
            if($id == ""){
                "\n";
                echo "\033[31m[+]TIDAK ADA ISI DALAM IDCHAT.TXT!" . PHP_EOL;
                "\n";
                sleep(3);
                echo "\033[31m[+]MENCOBA MENDAPATKAN ID CHAT BOT KEMBALI!" . PHP_EOL;
                "\n";
                    $id = $json['result'][0]['message']['chat']['id'];
                    $nama_file = 'idchat.txt';
                    $file_idchat = fopen($nama_file, 'w');
                    $konten = fwrite($file_idchat, $id);
                    fclose($file_idchat);
                    $id = trim(file_get_contents('idchat.txt'));
                        if($id == ""){
                            echo "\033[31m[+]GAGAL!" . PHP_EOL;
                            "\n";
                            echo "\033[31m[+]JIKA MASIH TIDAK MEDAPATKAN ID. COBA KIRIM PESAN KE BOT YANG ANDA BUAT DAN TUNGGU BEBERAPA SAAT LAGI!" . PHP_EOL;
                            "\n";
                            exit;
                        }
                 
             }
            
        
            

        return $id;
            

    }


}




echo "__       __  ______  __    __  _______    ______   ________  ______  __    __ 
/  \     /  |/      |/  |  /  |/       \  /      \ /        |/      |/  |  /  |
$$  \   /$$ |$$$$$$/ $$ | /$$/ $$$$$$$  |/$$$$$$  |$$$$$$$$/ $$$$$$/ $$ | /$$/ 
$$$  \ /$$$ |  $$ |  $$ |/$$/  $$ |__$$ |$$ |  $$ |   $$ |     $$ |  $$ |/$$/  
$$$$  /$$$$ |  $$ |  $$  $$<   $$    $$< $$ |  $$ |   $$ |     $$ |  $$  $$<   
$$ $$ $$/$$ |  $$ |  $$$$$  \  $$$$$$$  |$$ |  $$ |   $$ |     $$ |  $$$$$  \  
$$ |$$$/ $$ | _$$ |_ $$ |$$  \ $$ |  $$ |$$ \__$$ |   $$ |    _$$ |_ $$ |$$  \ 
$$ | $/  $$ |/ $$   |$$ | $$  |$$ |  $$ |$$    $$/    $$ |   / $$   |$$ | $$  |
$$/      $$/ $$$$$$/ $$/   $$/ $$/   $$/  $$$$$$/     $$/    $$$$$$/ $$/   $$/ \n" . PHP_EOL;




"\n";
"\n";
"\n";
"\n";

//PEMBUAT : EFENDI
//21 AGUSTUS 2021
                                                                               
echo "[+]IP ADDRESS : "; 
$ip = trim(fgets(STDIN));
echo "[+]USERNAME : "; 
"\n";
$username = trim(fgets(STDIN));
echo "[+]PASSWORD : ";
"\n";
$password = trim(fgets(STDIN));


$API = new RouterosAPI();
$tokbot = new Mikbot();
if($konek = $API->connect("$ip", "$username", "$password")){
   echo "\033[32m[+]BERHASIL TERHUBUNG! \033[0m" . PHP_EOL;
   "\n";
   sleep(3);
   echo "\033[33m[+]Menu \033[0m" . PHP_EOL;
   echo "\033[36m[1] Monitoring Online (Netwatch + Bot Telegram) \033[0m" . PHP_EOL;
   echo "\033[36m[2] Auto Setting Fail Over \033[0m" . PHP_EOL;
   echo "\033[32m[+]Pilih Menu Dengan Cara Input Angka :  \033[0m";
   $pilih_menu = trim(fgets(STDIN));
   "\n";
   if($pilih_menu == 1){
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   echo "\033[32m[+]Referensi cara mendapatkan token BOT https://bit.ly/3D7MaTW \033[0m" . PHP_EOL;
   echo "\033[33m[+]PERIKSA FILE TOKEN.TXT. PASTIKAN ANDA SUDAH MEMBUAT FILE TOKEN.TXT" . PHP_EOL;
   "\n";
   sleep(3);
    if(file_exists('token.txt')){
        echo "\033[32m[+]FILE TOKEN.TXT TERSEDIA" . PHP_EOL;
        "\n";
        $token = trim(file_get_contents('token.txt'));
        $token;
        //PROSES AMBIL TOKEN DI FILE TXT
        if($token != ""){
            echo "\033[32m[+]BERHASIL MENAMBAHKAN TOKEN" .PHP_EOL;
            "\n";
            echo "\033[33m[+]PERIKSA FILE IDCHAT.TXT" . PHP_EOL;
             "\n";
            echo "\033[33m[+]SEDANG MENGAMBIL ID CHAT BOT" .PHP_EOL;
            "\n";
            sleep(3);
            $id = $tokbot->CurlTele($token);
            //PROSES AMBIL ID CHAT BOT
                if(!isset($id)){
                    echo "\033[31m[+]TIDAK MENDAPATKAN ID BOT. PROGRAM BERAKHIR!" . PHP_EOL;
                     exit;
                    }
            //PROSES SAAT SUKSES MENDAPATKAN ID CHAT BOT
                echo "\033[32m[+]BERHASIL MENGAMBIL ID CHAT BOT" . PHP_EOL;
                "\n";
                //OPSI INPUT HOST
                ulang:
                echo "\033[33m[+]PILIH ANGKA : \033[0m" . PHP_EOL;
                "\n";
                echo "[1]MEMASUKAN HOST SECARA TUNGGAL " . PHP_EOL;
                "\n";
                echo "[2]MEMASUKAN HOST SECARA MASAL (Pastikan anda sudah membuat file ip.txt yang berisi host/ip) " . PHP_EOL;
                "\n";
                echo "[2]MEMASUKAN ANGKA : ";
                $chose = trim(fgets(STDIN));
                //PROSES JIKA PILIH NOMOR 1
                if($chose == 1){
                    echo "[+]MASUKAN HOST IP YANG INGIN DI MONITORING : ";
                    $isi_host = file('ip.txt');
                    $hostip = trim(fgets(STDIN));
                    "\n";
                    echo "[+]MASUKAN PESAN KETIKA LINK UP : ";
                    $pesan_up = trim(fgets(STDIN));
                    "\n";
                    echo "[+]MASUKAN PESAN KETIKA LINK DOWN : ";
                        $pesan_down = trim(fgets(STDIN));
                        $clean = trim($hostip);
                        $up = '/tool fetch url="https://api.telegram.org/bot' .$token. '/sendMessage?chat_id='.$id.'&text='. $pesan_up .' [' . $clean . ']' .  '" keep-result=no'; 
                        $down = '/tool fetch url="https://api.telegram.org/bot' .$token. '/sendMessage?chat_id='.$id.'&text='. $pesan_down . ' [' . $clean . ']' . '" keep-result=no';
                            $API->comm("/tool/netwatch/add", array(
                                    "host" => $hostip,
                                    "up-script" => $up,
                                    "down-script" => $down,
                                ));
                        sleep(3);
                        echo "\033[32m[+]BERHASIIL!" . PHP_EOL;
                        sleep(3);
                        echo "\033[32m[+]APAKAH INGIN MELANJUTKAN PROSES?(Y/N) : ";
                        $pilihan = trim(fgets(STDIN));
                                if($pilihan == "Y" or $pilihan == "y"){
                                    goto ulang;
                                }else {
                                    echo "\033[32m[+]PROGRAM SELESAI!!" . PHP_EOL;
                                }
                
                }//END PROSES NOMOR 1

                //PROSES JIKA PILIH NOMOR 2
                if($chose == 2 ){
                    echo "[+]MASUKAN PESAN KETIKA LINK UP : ";
                    $pesan_up = trim(fgets(STDIN));
                        "\n";
                    echo "[+]MASUKAN PESAN KETIKA LINK DOWN : ";
                    $pesan_down = trim(fgets(STDIN));
                        "\n";
                    $isi_host = file('ip.txt');
                    //SUKSES
                    foreach($isi_host as $hostip){
                        $clean = trim($hostip);
                        $up = '/tool fetch url="https://api.telegram.org/bot' .$token. '/sendMessage?chat_id='.$id.'&text='. $pesan_up .' [' . $clean . ']' .  '" keep-result=no'; 
                        $down = '/tool fetch url="https://api.telegram.org/bot' .$token. '/sendMessage?chat_id='.$id.'&text='. $pesan_down . ' [' . $clean . ']' . '" keep-result=no'; 
                        for($i=0; $i<count($isi_host); $i++){

                            $i = trim($hostip);
                        $API->comm("/tool/netwatch/add", array(
                            "host" => $i,
                            "up-script" => $up,
                            "down-script" => $down,
                        ));
                            sleep(3);
                            echo "\033[32m[+]BERHASIIL MEMASUKAN IP : " . $hostip . PHP_EOL;
                            "\n";
                        }//end for
                     }//end foreach
                     echo "\033[32m[+]SELESAI : " . $hostip . PHP_EOL;
                            "\n";
                     echo "\033[32m[+]APAKAH INGIN MELANJUTKAN PROSES?(Y/N) : ";
                        $pilihan = trim(fgets(STDIN));
                                if($pilihan == "Y" or $pilihan == "y"){
                                    goto ulang;
                                }else {
                                    echo "\033[32m[+]PROGRAM SELESAI!!" . PHP_EOL;
                                }
                    
                }//END PROSES NOMOR 2
                           
    
            }// END PROSES PENGECEKAN ID CHAT
        }// END PROSES PENGECEKAN TOKEN
}// END PROSES CONNECT
elseif($pilih_menu == 2){
    echo "[+]Apakah sudah membuat DHCP-CLIENT untuk masing masing ISP ?" . PHP_EOL;
    "\n";
    echo "[+]Pilih (Y/N) :  ";
    $pilihan_dhcp_client = trim(fgets(STDIN));
    $dhcp = $API->comm("/ip/dhcp-client/print");
    $route = $API->comm("/ip/route/print");

    //DHCP-CLIENT SUDAH TERSETTING
    if($pilihan_dhcp_client == "y" || $pilihan_dhcp_client == "Y"){
        for($j = 0; $j < count($route); $j++){
            if("0.0.0.0/0" == $route[$j]['dst-address']){
            $API->comm("/ip/route/remove", array(
                         "numbers" => $j
                               ));
            }
        }
        echo "\033[32m[+]List Gateway & Interface :  \033[0m" . PHP_EOL;
        echo "[+]-----------------------------------[+]" . PHP_EOL;
        "\n";
            //cek gateway dhcp-client
            for($k = 0; $k <count($dhcp); $k++){
                $array = '[' .  $k . '] '  .  $dhcp[$k]['gateway'] . " | " . $dhcp[$k]['interface'] . PHP_EOL;
                echo $array;
                $IP_GATEWAY = $dhcp[$k]['gateway'];
            }
            

            

            echo "[+]-----------------------------------[+]" . PHP_EOL;
                "\n";
                echo "[+]Cukup Masukan Angka [lihat pada list diatas]" . PHP_EOL;
                 echo "[+]Tentukan Interface Untuk Di Jadikan Utama & Backup :" . PHP_EOL;
                echo "\033[32m[+]Pilih ISP Utama : \033[0m";
                $pilihan_prioritas = trim(fgets(STDIN));
                "\n";
                echo "\033[32m[+]Pilih ISP Backup : \033[0m";
                $pilihan_backup = trim(fgets(STDIN));
                "\n";
                echo "[+]Proses konfigurasi, harap tunggu sebentar." . PHP_EOL;
                "\n";
                sleep(3);
                //SET STATIC ROUTE
                $ip_prioritas = $dhcp[$pilihan_prioritas]['gateway'];
                $ip_backup = $dhcp[$pilihan_backup]['gateway'];
                $API->comm("/ip/route/add", array(
                    "gateway" => $ip_prioritas,
                    "distance" => 1,
                    "check-gateway" => "ping",
                    "comment" => "Line Utama"
                ));
                $API->comm("/ip/route/add", array(
                    "gateway" => $ip_backup,
                    "distance" => 2,
                    "check-gateway" => "ping",
                    "comment" => "Line Backup"
                ));
                // echo "\033[32m[+]Sukses. \033[0m" . PHP_EOL;
                // "\n";
                echo "[+]Konfigurasi NAT." . PHP_EOL;
                "\n";
                sleep(3);
                for($k = 0; $k <count($dhcp); $k++){
                    $ether = $dhcp[$k]['interface'];
                    $API->comm("/ip/firewall/nat/add", array(
                        "chain" => "srcnat",
                        "out-interface" => $ether,
                        "action" => "masquerade",
                        "comment" => "Line $ether"
                    ));
                }
                echo "\033[32m[+]Selesai. \033[0m" . PHP_EOL;
                echo "\033[32m[+]Silahkan Setting DHCP-SERVER & DNS Secara Manual. \033[0m" . PHP_EOL;
                "\n";
                exit;

                
                
    }elseif($pilihan_dhcp_client == "n" || $pilihan_dhcp_client == "N"){
        input:
        echo "[+]Contoh = ether1" . PHP_EOL;
        echo "\033[32m[+]Input Interface Utama : \033[0m";
        $utama = trim(fgets(STDIN));
        $API->comm("/ip/dhcp-client/add", array(
            "interface" => $utama,
            "disabled" => "no",
        ));
        "\n";
        echo "[+]Contoh = ether2" . PHP_EOL;
        echo "\033[32m[+]Input Interface Backup : \033[0m";
        $backup = trim(fgets(STDIN));
        $API->comm("/ip/dhcp-client/add", array(
            "interface" => $backup,
            "disabled" => "no",
        ));
        sleep(3);
        "\n";
        //Hapus route dynamic
        for($j = 0; $j < count($route); $j++){
            if("0.0.0.0/0" == $route[$j]['dst-address']){
            $API->comm("/ip/route/remove", array(
                         "numbers" => $j
                               ));
            }
        }

        $dhcp = $API->comm("/ip/dhcp-client/print");
        echo "\033[32m[+]List Gateway & Interface :  \033[0m" . PHP_EOL;
        echo "[+]-----------------------------------[+]" . PHP_EOL;
        "\n";
            //cek gateway dhcp-client
            for($k = 0; $k <count($dhcp); $k++){
                $array = '[' .  $k . '] '  .  $dhcp[$k]['gateway'] . " | " . $dhcp[$k]['interface'] . PHP_EOL;
                echo $array;
                $IP_GATEWAY = $dhcp[$k]['gateway'];
            }

        echo "[+]-----------------------------------[+]" . PHP_EOL;
        "\n";
                echo "[+]Cukup Masukan Angka [lihat pada list diatas]" . PHP_EOL;
                 echo "[+]Tentukan Interface Untuk Di Jadikan Utama & Backup :" . PHP_EOL;
                echo "\033[32m[+]Pilih ISP Utama : \033[0m";
                $pilihan_prioritas = trim(fgets(STDIN));
                "\n";
                echo "\033[32m[+]Pilih ISP Backup : \033[0m";
                $pilihan_backup = trim(fgets(STDIN));
                "\n";
                echo "[+]Proses konfigurasi, harap tunggu sebentar." . PHP_EOL;
                "\n";
                sleep(3);
                //SET STATIC ROUTE
                $ip_prioritas = $dhcp[$pilihan_prioritas]['gateway'];
                $ip_backup = $dhcp[$pilihan_backup]['gateway'];
                $API->comm("/ip/route/add", array(
                    "gateway" => $ip_prioritas,
                    "distance" => 1,
                    "check-gateway" => "ping",
                    "comment" => "Line Utama"
                ));
                $API->comm("/ip/route/add", array(
                    "gateway" => $ip_backup,
                    "distance" => 2,
                    "check-gateway" => "ping",
                    "comment" => "Line Backup"
                ));
                echo "\033[32m[+]Sukses. \033[0m" . PHP_EOL;
                "\n";
                echo "[+]Konfigurasi NAT." . PHP_EOL;
                "\n";
                sleep(3);
                for($k = 0; $k <count($dhcp); $k++){
                    $ether = $dhcp[$k]['interface'];
                    $API->comm("/ip/firewall/nat/add", array(
                        "chain" => "srcnat",
                        "out-interface" => $ether,
                        "action" => "masquerade",
                        "comment" => "Line $ether"
                    ));
                }
                echo "\033[32m[+]Selesai. \033[0m" . PHP_EOL;
                echo "\033[32m[+]Silahkan Setting DHCP-SERVER & DNS Secara Manual. \033[0m" . PHP_EOL;
                "\n";
                exit;
        

    }
}
}else {
    echo "\033[31m[+]GAGAL TERHUBUNG" .PHP_EOL;
    "\n";
    echo "\033[31m[+]PASTIKAN ROUTER ANDA MENGGUNAKAN PORT API DEFAULT" .PHP_EOL;
    "\n";
    echo "\033[31m[+]HANYA DAPAT MENGGUNAKAN PORT API 8728" .PHP_EOL;
    }
