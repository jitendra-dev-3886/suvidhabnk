<?php
$secretKey = "ThisForSomethrtAndBeSuterity2325";

$v = "This is a secret message";
echo ChCrytpo::encrypt($v, $secretKey);
// echo ChCrytpo::decrypt($v, $secretKey);

final class ChCrytpo{
	static private function checkCryptKey($secretKey){
		if(strlen($secretKey) != 32) throw new Exception('"SecretKey length is not 32 chars"'); //무조건 32byte되도록 로직을 바꿀 수 있음 (2기종간 합의 해야함)
		$iv = substr($secretKey, 0, 16); //IV는 2 기종간 합의하려면 이 규칙을 세울 필요 있음 
		return [$secretKey, $iv];
	}
	static function encrypt($v, $secretKey){
		$k = self::checkCryptKey($secretKey);
		return openssl_encrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
	}
	static function decrypt($v, $secretKey){
		$k = self::checkCryptKey($secretKey);
		return openssl_decrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
	}
	
}