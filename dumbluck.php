<?php
//Original location is https://www.github/arsmagic/dumbluck
//Script to randomly generate Bitcoin private keys and test corresponding wallets for any balance.
//Dependencies: BitWasp\Bitcoin library
//http://Blockchain.info/address/... engine availability for checking balances.
//
//Donations welcomed: 1PfWcDasQY8yzLfQwW31y2ZJxXv22rYCvZ


require '../vendor/autoload.php'; //CHANGE THE LOCATION ACCORDING TO YOUR SYSTEM SETTINGS


use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Crypto\EcAdapter\Adapter\EcAdapterInterface;
$otp="";
$startv=gmp_init("0x1");
$endv=gmp_init("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEBAAEDCE6AF48A03BBFD25E8CD0364140");
$rndmv=gmp_random_range($startv,$endv);
$otp="Total amount of private keys is: ".wordwrap(gmp_strval($endv),3," ",true)."<br>";
$otp.="Hex equivalent is: ".gmp_strval($endv,16)."<br>";
$otp.="<br>"."<br>";
$otp.="Randomly selected number is: ".strrev(wordwrap(strrev(gmp_strval($rndmv)),3," ",true))."<br>";
$otp.="Hex equivalent is: ".gmp_strval($rndmv,16)."<br>";
$otp.= "<br>"."<br>";


$flink="http://blockchain.info/address/";



$network = Bitcoin::getNetwork();
try {
$privateKey = PrivateKeyFactory::fromHex(gmp_strval($rndmv,16));


$publicKey = $privateKey->getPublicKey();



$otp.="Key Info\n";

$otp.=" - Compressed? " . (($privateKey->isCompressed() ? 'yes' : 'no')) . "<br>";



$otp.="Private key<br>";

$otp.= " - WIF: " . $privateKey->toWif($network) . "<br>";

$otp.= " - Hex: " . $privateKey->getHex() . "<br>";

$otp.= " - Dec: " . gmp_strval($privateKey->getSecret(), 10) . "<br>";



$otp.= "Public Key\n";

$otp.= " - Hex: " . $publicKey->getHex() . "<br>";

$otp.= " - Hash: " . $publicKey->getPubKeyHash()->getHex() . "<br>";



$address = new PayToPubKeyHashAddress($publicKey->getPubKeyHash());


$flink="http://blockchain.info/address/".$address->getAddress();

$otp.= " - Address: <a href=\"http://blockchain.info/address/" . $address->getAddress() . "\" target=\"blank\">".$address->getAddress()."</a><br>";
} catch (Exception $e) 
{
	echo "Failed to generate stuff for key ".gmp_strval($rndmv,16)."<br>";
};
$bal=0.0;
if ($flink!="http://blockchain.info/address/")
{
	$ss=file_get_contents($flink);
	$ss=substr($ss,strpos($ss, "<td id=\"final_balance\"><font color=\"green\"><span data-c=\""));
	$ss=substr($ss,0,strpos($ss,"BTC"));
	$ss=substr($ss,strpos($ss, "span data-c=\"")+13);
	$ss=substr($ss,strpos($ss, ">")+1);
	$otp.= htmlentities($ss)." <br>";
	$bal = floatval($ss);
}
else
{
	$otp.= "<br>0<br>Failed";
};

echo "<html>";
if ($bal!=0)
{
	echo "<title>FOUND something</title><body>";
}
else
{
	echo "<title>Nothing FOUND </title><body onload='window.location.reload(true);'>";
};
echo $otp;
echo "</body></html>";
?>
