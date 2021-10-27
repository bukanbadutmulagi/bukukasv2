<?php
$file = fopen('idbukukas.txt','a');
include 'config.php';
function getToken($file){
	system("clear");
	system("figlet Token");
nohp:
echo "[?] Masukan Nomor HP : ";
$hp = trim(fgets(STDIN));
echo "[*] Tunggu sebentar";
	sleep(1);
	echo " ~ ";
	sleep(1);
	echo "~ \n";
	sleep(1);
$list = array(
'[1] SMS',
'[2] Whatsapp');
foreach($list as $listx){
		echo "$listx\n";
	}
echo "[?] Pilih Mode OTP : ";
$ot = trim(fgets(STDIN));
switch ($ot){
case 1:
$ot = "SMS";
goto nextbuy;
case 2:
$ot = "WHATSAPP";
goto nextbuy;
}
nextbuy:
$body = '{"operationName":"SendOtpMutation","variables":{"input":{"mobile":"+62'.$hp.'","purpose":"AUTH","mode":"'.$ot.'","skipBusinessCreation":true},"key":"0cad7ca9-34a3-4e6e-bddf-8b559fdb2b4c"},"query":"mutation SendOtpMutation($input: SendOtpInput!) {\n  sendOtp(input: $input) {\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$x = json_decode($exe, true);
$data = $x["data"]["sendOtp"]["success"];
if($data==true){
	echo "[!] Message : Cek $ot\n";
	} else {
		goto nohp;
		}
kodeOTP:
echo "[?] Masukan Kode OTP : ";
$otp = trim(fgets(STDIN));
$body = '{"operationName":"VerifyOtpMutation","variables":{"input":{"otp":"'.$otp.'","mobile":"+62'.$hp.'","deviceId":"eDlK-KruQkmnhZrOQeBAoO:APA91bFGbD4au1CfasKQqZCsl7n2xuV7GWxEWsE8Q-lS215gRTEW8uD-geM9ZDTrl5wx6FD9ThjoT2QekLiAogbjKfkSierl1c0_SJcX-0KE8MDYGGYWUOnQ4ZTwefJVBYZSw3QgkZ0X"},"key":"85fbb4c7-70cc-463a-a983-ffff09bdd283"},"query":"mutation VerifyOtpMutation($input: VerifyOtpInput!) {\n  verifyOtp(input: $input) {\n    token\n    user {\n      id\n      mobile\n      sessionsCount\n      businesses {\n        id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$j = json_decode($exe, true);
$data = $j["data"]["verifyOtp"]["__typename"];
		if($data=="Session"){
			$id = $j["data"]["verifyOtp"]["user"]["id"];
			$token = $j["data"]["verifyOtp"]["token"];
			$buid = $j["data"]["verifyOtp"]["user"]["businesses"][0]["id"];
			echo "[!] Token Valid : $token\n";
			echo "[!] Id Kamu : $id\n";
			echo "[!] Bussines id kamu : $buid\n";
			fputs ($file,"$token | $id | $buid" . "\r\n");
			} else {
$data = $j["errors"][0]["message"];
if($data=="Kode OTP salah atau sudah lewat masa aktifnya"){
	echo "[!] Message : Kode OTP salah atau sudah lewat masa aktifnya\n";
	} else {
		goto kodeOTP;
		}
}
}

function getLink(){
	system("clear");
	echo "                     _   _     _       _
           __ _  ___| |_| |   (_)_ __ | | __
          / _` |/ _ \ __| |   | | '_ \| |/ /
         | (_| |  __/ |_| |___| | | | |   <
          \__, |\___|\__|_____|_|_| |_|_|\_\
          |___/";
          echo "                     dananfff";
 echo "\n\n";
getLink:
echo "[?] Masukan Nominal : ";
$nominal = trim(fgets(STDIN));
if($nominal==""){
 die;
 } else {
$body = '{"operationName":"GeneratePaymentLinkMutation","variables":{"input":{"amount":'.$nominal.',"membershipBankId":"466291","contactId":null,"screen":"Profile"},"key":"3e9d6019-5edb-4920-98a1-116acf830bca"},"query":"mutation GeneratePaymentLinkMutation($input: GeneratePaymentLinkInput!) {\n  generatePaymentLink(input: $input) {\n    id\n    status\n    amount\n    notes\n    createdAt\n    partnerTransactionId\n    url\n    slug\n    contact {\n      id\n      name\n      mobile\n      __typename\n    }\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["generatePaymentLink"]["status"];
if($data=="created"){
	$link1 = $json["data"]["generatePaymentLink"]["slug"];
	$link = "https://pay.bukukas.io/$link1";
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	system("xdg-open $link");
	} else {
		goto getLink;
		}
	}
}
//
function tpDana(){
	system("clear");
echo "                  ____                                                         |  _ \  __ _ _ __   __ _
                 | | | |/ _` | '_ \ / _` |
                 | |_| | (_| | | | | (_| |
                 |____/ \__,_|_| |_|\__,_|";
echo "\n";
topupDana:
echo "\n[?] Masukan Nomor Dana : ";
$nope = trim(fgets(STDIN));
if($nope==""){
	goto topupDana;
	} else {
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"38","accountNumber":"8059'.$nope.'"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["inquireBankAccount"];
if($data==null){
	echo "[!] Message : Mohon cek kembali informasi rekening dan coba lagi";
	goto topupDana;
	} else {
		$an = $data["accountName"];
		$anu = $data["accountNumber"];
		$bc = $data["bankCode"];
		echo "[*] Informasi : $an\n";
		}
	
}
//
$body = '{"operationName":"findCreateContact","variables":{"input":{"bankId":38,"accountNumber":"'.$anu.'","accountName":"'.$an.'","businessId":"2106606","name":"'.$an.'X"}},"query":"query findCreateContact($input: FindCreateContactInput!) {\n  findCreateContact(input: $input) {\n    id\n    mobile\n    name\n    contactBanks {\n      id\n      accountNumber\n      bank {\n        id\n        name\n        imageUrl\n        code\n        __typename\n      }\n      primary\n      __typename\n    }\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["findCreateContact"]["mobile"];
if ($data==null){
	$id = $json["data"]["findCreateContact"]["id"];
	} else {
		goto topupDana;
		}
//
echo "[*] Nominal Transfer Payment : ";
$nom = trim(fgets(STDIN));
$body = '{"operationName":"CreatePaymentMutation","variables":{"input":{"amount":'.$nom.',"businessId":"2106606","bankId":"3","contactId":"'.$id.'","screen":"BukukasPay"},"key":"12a5af93-c796-4894-8a70-81dbf0e8582b"},"query":"mutation CreatePaymentMutation($input: CreatePaymentInput!) {\n  createPayment(input: $input) {\n    ...payment\n    __typename\n  }\n}\n\nfragment payment on Payment {\n  id\n  amount\n  createdAt\n  settledAt\n  paidAt\n  status\n  notes\n  business {\n    id\n    __typename\n  }\n  modeType\n  mode {\n    ... on VirtualAccount {\n      id\n      number\n      amount\n      bank {\n        id\n        name\n        imageUrl\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  payouts {\n    id\n    amount\n    partnerTrxId\n    contactName\n    contactMobile\n    recipientAccountNumber\n    recipientAccountName\n    bank {\n      id\n      name\n      imageUrl\n      __typename\n    }\n    __typename\n  }\n  paymentGateway {\n    name\n    __typename\n  }\n  __typename\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$j = json_decode($exe, true);
$data = $j["data"]["createPayment"]["status"];
if($data=="created"){
	$va = $j["data"]["createPayment"]["mode"]["number"];
echo "[*] Virtual Account :  $va\n";
} else {
	goto topupDana;
	}

}

function sinarmas(){
	system("clear");
	system("figlet Sinarmas");
britosinarmas:
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"92","accountNumber":"0015405341"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["inquireBankAccount"]["success"];
if($data==true){
	$an = $json["data"]["inquireBankAccount"]["accountName"];
	$anu = $json["data"]["inquireBankAccount"]["accountNumber"];
	} else {
		die;
		}
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"466291","input":{"bankId":"92","accountNumber":"0015405341","accountName":"DANANG SEPTIAWAN","pin":"280920"},"key":"0f9188f4-b2c6-4d07-ab6d-f52ab1085942"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["updateMembershipBank"]["accountNumber"];
if($data=="0015405341"){
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	echo "\n[!] Sukses Mengganti Bank Sinarmas\n";
	} else {
		die;
		}
}

//
function maybankDandang(){
	system("clear");
	system("figlet Maybank");
toMaybank:
echo "\n";
echo "[?] Masukan Rek. Maybank Syariah : ";
$an = trim(fgets(STDIN));
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"36","accountNumber":"'.$an.'","accountName":"BANK NEO COMMERCE","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti Bank $nb\n";
}
//
function mandiriDandang(){
	system("clear");
	system("figlet Mandiri");
toMaybank:
echo "\n";
echo "[?] Masukan Rek. Mandiri  : ";
$an = trim(fgets(STDIN));
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"3","accountNumber":"'.$an.'","accountName":"MANDIRI","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti Bank $nb\n";
}
//
function cimbDandang(){
	system("clear");
	system("figlet Cimb Niaga");
echo "[?] Masukan Nomor Dana  : ";
$nope = trim(fgets(STDIN));
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"38","accountNumber":"8059'.$nope.'"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe= net($body,$headers);
$j = json_decode($exe, true);
$ex = $j["data"]["inquireBankAccount"]["success"];
if($ex==true){
	$an = $j["data"]["inquireBankAccount"]["accountName"];
	$anu = $j["data"]["inquireBankAccount"]["accountNumber"];
	echo "[!] Nama Penerima : $an\n";
goto toMaybank;
} else {
	die;
	}
toMaybank:
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"38","accountNumber":"'.$an.'","accountName":"'.$anu.'","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti Bank $nb\n";
}

//
function britamaa(){
	system("clear");
	system("figlet BRI");
britama:
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"4","accountNumber":"132501005910504"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["inquireBankAccount"]["success"];
if($data==true){
	$an = $json["data"]["inquireBankAccount"]["accountName"];
	$anu = $json["data"]["inquireBankAccount"]["accountNumber"];
	} else {
		die;
		}
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"466291","input":{"bankId":"4","accountNumber":"132501005910504","accountName":"DANANG SEPTIAWAN","pin":"280920"},"key":"fd0e900e-e46c-4f30-87b3-50d6bee76330"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeader($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
$data = $json["data"]["updateMembershipBank"]["accountNumber"];
if($data=="132501005910504"){
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	echo "\n[!] Sukses Mengganti Bank ke BRI\n";
	} else {
		die;
		}
}

function editToken(){
system("clear");
system("figlet edit Token");
echo "[$] pkg install nano";
echo "\n[$] pkg install nano";
echo "\n[$] nano config.php";
echo "\n[$] CTRL + X";
echo "\n[$] Ketik Y";
echo "\n[$] Save and Run";
echo "\n[?] Install Package diatas ? (y/n) : ";
$x = trim(fgets(STDIN));
if($x=="y"){
system("pkg install php");
system("pkg install nano");
system("pkg install git");
system("termux-setup-storage");
system("git clone https://github.com/bukanbadutmulagi/bukukasv2");
system("cd bukukasv2");
} else {
	die;
	}
}
//
function permataDandang(){
	system("clear");
	system("figlet Permata");
	echo "[?] Masukan Nomor Gopay  : ";
$nope = trim(fgets(STDIN));
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"6","accountNumber":"898'.$nope.'"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe= net($body,$headers);
$j = json_decode($exe, true);
$ex = $j["data"]["inquireBankAccount"]["success"];
if($ex==true){
	$an = $j["data"]["inquireBankAccount"]["accountName"];
	$anu = $j["data"]["inquireBankAccount"]["accountNumber"];
	echo "[!] Nama Penerima : $an\n";
goto toPermata;
} else {
	die;
	}
toPermata:
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"6","accountNumber":"'.$an.'","accountName":"'.$anu.'","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti $nb\n";
}
//
function shopeeDandang(){
	system("clear");
	system("figlet Shopeepay");
	echo "\n";
	echo "[?] Masukan Nomor Shopeepay  : ";
$nope = trim(fgets(STDIN));
$body = '{"operationName":"InquireBankAccountQuery","variables":{"bankCode":"3","accountNumber":"893'.$nope.'"},"query":"query InquireBankAccountQuery($bankCode: String!, $accountNumber: String!) {\n  inquireBankAccount(bankCode: $bankCode, accountNumber: $accountNumber) {\n    accountName\n    accountNumber\n    bankCode\n    success\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe= net($body,$headers);
$j = json_decode($exe, true);
$ex = $j["data"]["inquireBankAccount"]["success"];
if($ex==true){
	$an = $j["data"]["inquireBankAccount"]["accountName"];
	$anu = $j["data"]["inquireBankAccount"]["accountNumber"];
	echo "[!] Nama Penerima : $an\n";
goto toSp;
} else {
	die;
	}
toSp:
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"3","accountNumber":"'.$an.'","accountName":"'.$anu.'","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
	echo "[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti Bank $nb\n";
}
//
function briDanang(){
	system("clear");
	system("figlet BRI");
toSp:
$body = '{"operationName":"UpdateMembershipBankMutation","variables":{"id":"18512","input":{"bankId":"4","accountNumber":"132501005910504","accountName":"DANANG SEPTIAWAN","pin":"280920"},"key":"d7378247-d356-488e-a6f7-04f7dad48c80"},"query":"mutation UpdateMembershipBankMutation($id: ID!, $input: UpdateMembershipBankInput!) {\n  updateMembershipBank(id: $id, input: $input) {\n    id\n    businessMembership {\n      user {\n        name\n        __typename\n      }\n      business {\n        name\n        __typename\n      }\n      __typename\n    }\n    bank {\n      name\n      id\n      imageUrl\n      code\n      __typename\n    }\n    accountNumber\n    accountName\n    __typename\n  }\n}\n"}';
$headers = classHeaderb($body);
$exe = net($body,$headers);
$json = json_decode($exe, true);
echo "[*] Mengganti ke bank BRI";
	echo "\n[*] Tunggu sebentar";
	sleep(1);
	echo " • ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
	sleep(1);
	echo "• ";
$nb = $json["data"]["updateMembershipBank"]["bank"]["name"];
	echo "\n[!] Sukses Mengganti Bank $nb\n";
}
//

system("clear");
system("figlet         MENU");
echo "\n[01] GetLink Payment [Minimal 25k]";
echo "\n[02] Topup Dana Virtual Account";
echo "\n[03] BRI to SINARMAS";
echo "\n[04] SINARMAS to BRI";
echo "\n[05] Cimb Niaga x Dana";
echo "\n[06] Maybank X Neo Top up";
echo "\n[07] Mandiri X PostPay";
echo "\n[08] Permata X Gojek";
echo "\n[09] Shopee X Bukukas ";
echo "\n[10] Ganti BRI Payment";
echo "\n[11] getToken Bukukas";
echo "\n[12] Tutorial Edit Token Bukukas";
echo "\n[*] Masukan Pilihan : ";
$x = trim(fgets(STDIN));
switch ($x){
	case 1:
	$ex = getLink();
	die;
	case 2:
	$ex = tpDana();
	die;
	case 3:
	$ex = sinarmas();
	die;
	case 4:
	$ex = britamaa();
	die;
	case 11:
	$ex = getToken($file);
	die;
	case 6:
	$ex = maybankDandang();
	die;
	case 7:
	$ex = mandiriDandang();
	die;
	case 5:
	$ex = cimbDandang();
	die;
	case 12:
	$ex = editToken();
	die;
	case 8:
	$ex = permataDandang();
	die;
	case 9:
	$ex = shopeeDandang();
	die;
	case 10:
	$ex = briDanang();
	die;
	}
