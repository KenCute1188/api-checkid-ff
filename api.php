<?php
// Đã Có Tự Động Change IP Chỉ Cần Việc Về Là Sử Dụng
$keyproxy = "TLW2JEs7uzlOiSKMVIMzS8udEV6Upzmt2R7Dqf"; // lấy api tại https://tinsoftproxy.com/
$tenmien = [
    "https://napthe.vn",
    "https://shop.garena.sg",
    "https://shop.garena.my/",
    "https://ggtopup.com/",
    "https://bdgamesbazar.com/",
    "https://topup.pk/",
    "https://kiosgamer.co.id/"
    // thêm các miền khác nữa vào đây
];
$random_mien = $tenmien[array_rand($tenmien)];
$url = $random_mien . "api/auth/player_id_login";
$idgame = "335518211";
$proxy_info = json_decode(file_get_contents("https://proxy.tinsoftsv.com/api/getProxy.php?key=" . $keyproxy), true);
if ($proxy_info['success'] == 'false' && $proxy_info['next_change'] == '0') {
    $change_proxy_info = json_decode(file_get_contents("https://proxy.tinsoftsv.com/api/changeProxy.php?key=" . $keyproxy), true);
}
$proxy_ip = $proxy_info['proxy'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy_ip);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = array(
    "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Cookie: source=pc; _ga=GA1.2.591678987.1670564587; _gid=GA1.2.802964828.1670564587; _gat_gtag_UA_137597827_3=1; session_key=bc1qqxvrnh2xtsqmrvd7wg0msg8mt5ysr932w3qs8c; b.vtpopup.51=1; datadome=6TESakoyMuvs1f~G3~9Elcg_he3wmjR7uFPJqG~ND-gfkdFOwk8-7hW88ssmYasvd_hUEt2w~HBJes8QtrCHFGUNsk-ioD5nncFyIuaptlVrvw3b~figpNYq9QOInMk4; _ga_VWDZYZV5E8=GS1.1.1670564587.1.1.1670564598.0.0.0",
    "Origin: $random_mien",
    "Pragma: no-cache",
    "Referer: $random_mien/app",
    "Sec-Fetch-Dest: empty",
    "Sec-Fetch-Mode: cors",
    "Sec-Fetch-Site: same-origin",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
    "accept: application/json",
    "content-type: application/json",
    "sec-ch-ua-mobile: ?0",
    "x-datadome-clientid: 6TESakoyMuvs1f~G3~9Elcg_he3wmjR7uFPJqG~ND-gfkdFOwk8-7hW88ssmYasvd_hUEt2w~HBJes8QtrCHFGUNsk-ioD5nncFyIuaptlVrvw3b~figpNYq9QOInMk4",
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$data = '{"app_id":100067,"login_id":"'.$idgame.'","app_server_id":0}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($ch);
curl_close($ch);
$delta = json_decode($resp, true);
$result = array(
    'nickname' => isset($delta['nickname']) ? $delta['nickname'] : 'Không có nickname',
    'region' => isset($delta['region']) ? $delta['region'] : 'Không có region',
    'open_id' => isset($delta['open_id']) ? $delta['open_id'] : 'Không có open_id'
);
echo json_encode($result);
?>
