<?php
header("Content-type: text/html; charset=UTF-8");

$baslik = "Turkey";
$baslik = rawurlencode($baslik);
$ch = curl_init();
$url = "https://yandex.com/images/search?text=$baslik";
echo "$url<br/><br/><br/>";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

//$html = file_get_html($url);
//echo "$html";

if ($response === false) {
    echo 'Hata: ' . curl_error($ch);
} else {
    // Web sayfasının içeriğini aldık, şimdi resimleri çıkarabiliriz.
    
    // Örnek: Resim etiketlerini bulup ekrana yazdıralım
    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $response, $matches);
    
    // İlk 10 resmi görüntüleyelim
    $counter = 0;
    foreach ($matches[1] as $imageURL) {
        if ($counter >= 10) {
            break; // İlk 10 resmi aldık, döngüyü durdur.
        }
        echo '<img src="' . $imageURL . '" alt="Resim ' . ($counter + 1) . '">';
        //echo "$imageURL <br/>";
$resim=str_replace("//","https://","$imageURL");
$resim = trim(html_entity_decode($resim));

echo "<br/>$resim <br/>";
//$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//$ziko= ''.substr(str_shuffle($permitted_chars), 0, 10).'';  
//file_put_contents("../resimler/country/$ziko.webp", fopen($resim, 'r')); //ulke klasoru
//$file = "../resimler/country/$ziko.webp";
//if (file_exists($file)) {
//$kaydet = $mysqli->query("INSERT  INTO resimler (isim,self,url) VALUES ('$ziko','$self','$resim')"); 
//}          
        $counter++;
        
    }
}
if ($kaydet) {
    $lastInsertedID = $mysqli->insert_id;
    echo "Son eklenen ID: " . $lastInsertedID;  
} else {
    echo "Veri eklenirken bir hata oluştu: " . $mysqli->error;
}
  
curl_close($ch);

?>
