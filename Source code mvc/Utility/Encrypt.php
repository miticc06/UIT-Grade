<?php
class Encrypt {

    private static $instance;
 
    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new Encrypt();
        }
        return self::$instance;
    }
	
	public function encode($keypw, $string) // mã hóa
	{
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),MCRYPT_DEV_URANDOM); 
		$encrypted = base64_encode($iv.mcrypt_encrypt(MCRYPT_RIJNDAEL_128,hash('sha256',$keypw, true),$string,MCRYPT_MODE_CBC,$iv));
		return $encrypted; 
    }
	
	public function decode($keypw, $encrypted) // giải mã
	{
		$data = base64_decode($encrypted);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128,hash('sha256', $keypw, true),substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),MCRYPT_MODE_CBC,$iv),"\0");
		return $decrypted;
	}
	
}
?>