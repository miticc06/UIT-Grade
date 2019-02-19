<?php 
class UserModel
{
    private $id;
	private $mssv;
	private $pass;
	private $keypw;
	private $code;
	private $email;
	private $active;
	private $lastupdate;
	private $idmsg;
	private $cachediem;
	private $cachetkb;
	private $typenotice;
  //UserModel
	public function __construct($Id = 0, $Mssv = null, $Pass = null, $Keypw = null, $Code = null, $Email = null, $Active = null, $Lastupdate = null, $Idmsg = null, $Cachediem = null, $Cachetkb = null, $Typenotice = null)
	{
		$this->id = $Id;
		$this->mssv = $Mssv;
		$this->pass = $Pass;
		$this->keypw = $Keypw;
		$this->code = $Code;
		$this->email = $Email;
		$this->active = $Active;
		$this->lastupdate = $Lastupdate;
		$this->idmsg = $Idmsg;
		$this->cachediem = $Cachediem;
		$this->cachetkb = $Cachetkb;
		$this->typenotice = $Typenotice;
	}
		
	public function getMssv()
	{
		return $this->mssv;
	}

	public function getEmail()
	{
		return $this->email;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getLastupdate()
	{
		return $this->lastupdate;
	}	
	
	public function getCachetkb()
	{
		return $this->cachetkb;
	}	
	
	public function getIdmsg()
	{
		return $this->idmsg;
	}		
	
	public function getTypenotice()
	{
		return $this->typenotice;
	}		
	
	public function getCachediem()
	{
		return $this->cachediem;
	}		
	
	public function getActive()
	{
		return $this->active;
	}		
	
	public function getCode()
	{
		return $this->code;
	}	
	
	public function getKeypw()
	{
		return $this->keypw;
	}	
	
	public function getPass()
	{
		return $this->pass;
	}		
	
	
	public function setCode($Code)
	{
		$this->code = $Code;
	}
	
	public function setCachetkb($Cachetkb)
	{
		$this->cachetkb = $Cachetkb;
	}	
	
	public function setCachediem($Cachediem)
	{
		$this->cachediem = $Cachediem;
	}	

	public function setActive($Active)
	{
		$this->active = $Active;
	}	

	public function setEmail($Email)
	{
		$this->email = $Email;
	}	

	
	public function setIdmsg($Idmsg)
	{
		$this->idmsg = $Idmsg;
	}	
	
	public function setTypenotice($Typenotice)
	{
		$this->typenotice = $Typenotice;
	}	
	 
	public function setPass($Pass)
	{
		$this->pass = $Pass;
	}		

	public function setKeypw($Keypw)
	{
		$this->keypw = $Keypw;
	}		
	 
	 
	public function findUserById($Id)
    {
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM user WHERE id = \"$Id\"");
		if ($row = mysqli_fetch_array($result))
		{
			$this->id = $row['id'];
			$this->mssv = $row['mssv'];
			$this->pass = $row['pass'];
			$this->keypw = $row['keypw'];
			$this->code = $row['code'];
			$this->email = $row['email'];
			$this->active = $row['active'];
			$this->lastupdate = $row['lastupdate'];
			$this->idmsg = $row['idmsg'];
			$this->cachediem = $row['cachediem'];
			$this->cachetkb = $row['cachetkb'];
			$this->typenotice = $row['typenotice'];
			return $this;
		}
		else
			return null;
    }
	
	
	public function findUserByIdmsg($Idmsg)
    {
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM user WHERE idmsg = \"$Idmsg\"");
		if ($row = mysqli_fetch_array($result))
		{
			$this->id = $row['id'];
			$this->mssv = $row['mssv'];
			$this->pass = $row['pass'];
			$this->keypw = $row['keypw'];
			$this->code = $row['code'];
			$this->email = $row['email'];
			$this->active = $row['active'];
			$this->lastupdate = $row['lastupdate'];
			$this->idmsg = $row['idmsg'];
			$this->cachediem = $row['cachediem'];
			$this->cachetkb = $row['cachetkb'];
			$this->typenotice = $row['typenotice'];
			return $this;
		}
		else
			return null;
    }	 
	
	public function findUserByMssv($Mssv)
    {
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM user WHERE mssv = \"$Mssv\"");
		if ($row = mysqli_fetch_array($result))
		{
			$this->id = $row['id'];
			$this->mssv = $row['mssv'];
			$this->pass = $row['pass'];
			$this->keypw = $row['keypw'];
			$this->code = $row['code'];
			$this->email = $row['email'];
			$this->active = $row['active'];
			$this->lastupdate = $row['lastupdate'];
			$this->idmsg = $row['idmsg'];
			$this->cachediem = $row['cachediem'];
			$this->cachetkb = $row['cachetkb'];
			$this->typenotice = $row['typenotice'];
			return $this;
		}
		else
			return null;
    }	 	
	
	
	public function findUserByCode($Code)
    {
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM user WHERE code = \"$Code\"");
		if ($row = mysqli_fetch_array($result))
		{
			$this->id = $row['id'];
			$this->mssv = $row['mssv'];
			$this->pass = $row['pass'];
			$this->keypw = $row['keypw'];
			$this->code = $row['code'];
			$this->email = $row['email'];
			$this->active = $row['active'];
			$this->lastupdate = $row['lastupdate'];
			$this->idmsg = $row['idmsg'];
			$this->cachediem = $row['cachediem'];
			$this->cachetkb = $row['cachetkb'];
			$this->typenotice = $row['typenotice'];
			return $this;
		}
		else
			return null;
    }	


	
	public function UpdateUser()
    {
		global $conn;  
		
		$result = mysqli_query($conn, "UPDATE user SET pass = \"".$this->getPass()."\" , keypw = \"".$this->getKeypw()."\" , code = \"".$this->getCode()."\" , email = \"".addslashes($this->getEmail())."\" , active = \"".$this->getActive()."\" , idmsg = \"".$this->getIdmsg()."\" , cachediem = \"".addslashes($this->getCachediem())."\" , cachetkb = \"".addslashes($this->getCachetkb())."\" , typenotice = \"".$this->getTypenotice()."\" , lastupdate = now() WHERE id = \"".$this->getId()."\"" );
		
		if (!$result)
		{
		//	printf("Error: %s\n", mysqli_error($conn));
			return false; 
		} 
		else
			return true;
		  
    }
	
	
	public function RemoveUser() 
    {
		global $conn;  
		
		$result = mysqli_query($conn, "DELETE FROM user WHERE id = '".$this->getId()."'");
		
		if (!$result)
		{
			printf("Error: %s\n", mysqli_error($conn));
			return false; 
		} 
		else
			return true;
		  
    }
	
	
	public function InsertUser() 
    {
		global $conn;  
		
		$result = mysqli_query($conn, "INSERT INTO user (mssv, pass, code, email, idmsg, keypw, typenotice) VALUES ('" . $this->getMssv() . "', '" . $this->getPass() . "','".$this->getCode()."' ,'".$this->getEmail()."','".$this->getIdmsg()."','".$this->getKeypw()."', '".$this->getTypenotice()."')");
		
		if (!$result)
		{
			printf("Error: %s\n", mysqli_error($conn));
			return false; 
		} 
		else
			return true;
		  
    }	
	
	
}
