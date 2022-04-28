<?php
require_once 'api.php';



$ip = "192.168.122.149";
$user = "admin";
$pass = "";

$API = new RouterosAPI;

if($API->connect($ip, $user, $pass)){
    echo "\033[36m[+]BERHASIL TERHUBUNG! \033[0m" . PHP_EOL;
   "\n";
    echo "[+]Apakah sudah membuat DHCP-CLIENT untuk masing masing ISP ?" . PHP_EOL;
    "\n";
    echo "[+]Pilih (Y/T) :  ";
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

                
                
    }elseif($pilihan_dhcp_client == "t" || $pilihan_dhcp_client == "T"){
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
   

































    // $route = $API->comm("/ip/route/print");
    // for($i = 0; $i <count($route); $i++){
    //     if( $IP_GATEWAY == $route[$i]['gateway']){
    //         echo $i;
    //         $dhcp = $API->comm("/ip/route/remove", array(
    //             "numbers" => $i
    //         ));
    //     }
    // }

      //print gateway routes
    //   for($i = 0; $i <count($route); $i++){
    //     if( $IP_GATEWAY == $route[$i]['gateway']){
    //         echo $i;
    //         $dhcp = $API->comm("/ip/route/remove", array(
    //             "numbers" => $i
    //         ));
    //     }
    // }

}