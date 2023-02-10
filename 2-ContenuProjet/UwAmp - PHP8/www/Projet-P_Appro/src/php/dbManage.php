<?php
///ETML
///Author      : Dorian Capelli
///Date        : 01.02.2023
///Description : Database management

class dbManage
{
	private $connector;

    /**
     * Class constructor
     */
    public function __construct()
    {
        try
        {
		    $this->connector = new PDO("mysql:host=localhost;dbname=db_chess;charset=utf8","chess","chess");
		}
		catch (PDOException $e)
		{
		   die('Erreur : ' . $e->getMessage());
		}
    }

	private function querySimpleExecute($query)
	{
    	return $this->connector->query($query);
    }

    private function formatData($req)
    {
		return $req->fetchALL(PDO::FETCH_ASSOC);
    }

	private function queryPrepareExecute($query, $binds)
	{
        $req = $this->connector->prepare($query);
        try{
		    foreach($binds as $bind){
    			$req->bindValue($bind["bind"], $bind["variable"], $bind["type"]);
        	}
        	$req->execute();
		}
		catch (PDOException $e){
		   die('Erreur : ' . $e->getMessage());
		}

		return $req;
    }

  	private function unsetData($req)
  	{
    	$req->closeCursor();
    }

    /**
     * Function that created a member
     */
	public function addMember($memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory)
	{
		$reqSQL = "INSERT INTO t_member(memLastName, memFirstName, memDateBirth, memPhoneNumber, memLicencing, memRanking, fkTitle, fkCategory) VALUES(:memLastName, :memFirstName, :memDateBirth, :memPhoneNumber, :memLicencing, :memRanking, :fkTitle, :fkCategory)";
		$binds[] = array("variable"=>$memLastName, "bind" => "memLastName", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$memFirstName, "bind" => "memFirstName", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$memDateBirth, "bind" => "memDateBirth", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$memPhoneNumber, "bind" => "memPhoneNumber", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$memLicencing, "bind" => "memLicencing", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$memRanking, "bind" => "memRanking", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkTitle, "bind" => "fkTitle", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkCategory, "bind" => "fkCategory", "type" => PDO::PARAM_INT);
        $req = $this->queryPrepareExecute($reqSQL, $binds);;
		$this->unsetData($req);
		return $this->connector->lastInsertId();
	}

	/**
	 * Function delete a member
	 */
	public function deleteMember($idMember){
		$reqSQL = "DELETE FROM t_play WHERE fkMember = :idMember";
		$binds[] = array("variable"=>$idMember, "bind" => "idMember", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);

		$reqSQL = "DELETE FROM t_member WHERE idMember = :idMember";
		$binds[] = array("variable"=>$idMember, "bind" => "idMember", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
	}

	/**
	 * Function update data of a member
	 */
	public function updateMember($idMember, $memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory)
    {
    	$reqSQL = "UPDATE t_member SET memLastName = :memLastName, memFirstName = :memFirstName, memDateBirth = :memDateBirth, memPhoneNumber = :memPhoneNumber, memLicencing = :memLicencing, memRanking = :memRanking,  fkTitle = :fkTitle, fkCategory = :fkCategory WHERE idMember = :idMember";
		$binds[] = array("variable"=>$idMember, "bind" => "idMember", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$memLastName, "bind" => "memLastName", "type" => PDO::PARAM_STR);
		$binds[] = array("variable"=>$memFirstName, "bind" => "memFirstName", "type" => PDO::PARAM_STR);
		$binds[] = array("variable"=>$memDateBirth, "bind" => "memDateBirth", "type" => PDO::PARAM_STR);
		$binds[] = array("variable"=>$memPhoneNumber, "bind" => "memPhoneNumber", "type" => PDO::PARAM_STR);
		$binds[] = array("variable"=>$memLicencing, "bind" => "memLicencing", "type" => PDO::PARAM_STR);
		$binds[] = array("variable"=>$memRanking, "bind" => "memRanking", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$fkTitle, "bind" => "fkTitle", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$fkCategory, "bind" => "fkCategory", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$this->unsetData($req);
    }

	/**
     * Function that add a team
     */
	public function addTeam()
	{
		$reqSQL = "INSERT INTO t_team(notNote, notText, fkUser, fkBook) VALUES(:notNote, :notText, :fkUser, :fkBook)";
		$binds[] = array("variable"=>$notNote, "bind" => "notNote", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$notText, "bind" => "notText", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$fkUser, "bind" => "fkUser", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkBook, "bind" => "fkBook", "type" => PDO::PARAM_INT);
        $req = $this->queryPrepareExecute($reqSQL, $binds);
		$this->unsetData($req);
		return $this->connector->lastInsertId();
	}

	/**
     * Function that add a member on a team
     */
	public function addPlay($fkMember, $fkTeam, $IsCaptain)
	{
		$reqSQL = "INSERT INTO t_play(fkMember, fkTeam, IsCaptain) VALUES(:fkMember, :fkTeam, :IsCaptain)";
		$binds[] = array("variable"=>$fkMember, "bind" => "fkMember", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$fkTeam, "bind" => "fkTeam", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$IsCaptain, "bind" => "IsCaptain", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);;
		$this->unsetData($req);
		return $this->connector->lastInsertId();
	}

	/**
     * Function that show all information about all member
     */
	public function getAllMembers()
	{
		$reqSQL = "SELECT * FROM t_member JOIN t_category ON t_member.fkCategory = t_category.idCategory LEFT JOIN t_title ON t_member.fkTitle = t_title.idTitle";
		$req = $this->querySimpleExecute($reqSQL);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
	}

	/**
     * Function that show all information about all members
     */
	public function getAllMembersInRange($startId, $endId)
	{
		if($startId > $endId){
			return "L'écart est négatif";
		}

		$reqSQL = "SELECT * FROM t_member JOIN t_category ON t_member.fkCategory = t_category.idCategory JOIN t_title ON t_member.fkTitle = t_title.idTitle WHERE idMember BETWEEN :startId AND :endId  ";
		$binds[] = array("variable"=>$startId, "bind" => "startId", "type" => PDO::PARAM_INT);
		$binds[] = array("variable"=>$endId, "bind" => "endId", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
	}

	/**
     * Function that show all members that refers to criterions (default value= '%' and add '%valueEnter%')
     */
	public function getMemberCriterion($memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory)
	{
		$paramNumber = 0;
		$reqSQL = "SELECT  * FROM t_member JOIN t_category ON t_member.fkCategory = t_category.idCategory LEFT JOIN t_title ON t_member.fkTitle = t_title.idTitle WHERE";
		if(!empty($memLastName)){
			$reqSQL .= " memLastName LIKE :memLastName AND";
			$binds[] = array("variable"=>"%".$memLastName."%", "bind" => "memLastName", "type" => PDO::PARAM_STR);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($memFirstName)){
			$reqSQL .= " memFirstName LIKE :memFirstName AND";
			$binds[] = array("variable"=>"%".$memFirstName."%", "bind" => "memFirstName", "type" => PDO::PARAM_STR);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($memDateBirth)){
			$reqSQL .= " memDateBirth LIKE :memDateBirth AND";
			$binds[] = array("variable"=>"%".$memDateBirth."%", "bind" => "memDateBirth", "type" => PDO::PARAM_STR);
		}
		else{
			$paramNumber += 1;
		}
        if(!empty($memPhoneNumber)){
			$reqSQL .= 	" memPhoneNumber LIKE :memPhoneNumber AND";
			$binds[] = array("variable"=>"%".$memPhoneNumber."%", "bind" => "memPhoneNumber", "type" => PDO::PARAM_STR);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($memLicencing)){
			$reqSQL .= " memLicencing LIKE :memLicencing AND";
			$binds[] = array("variable"=>"%".$memLicencing."%", "bind" => "memLicencing", "type" => PDO::PARAM_STR);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($memRanking)){
			$reqSQL .= " memRanking LIKE :memRanking AND";
			$binds[] = array("variable"=>$memRanking, "bind" => "memRanking", "type" => PDO::PARAM_INT);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($fkTitle)){
			$reqSQL .= " fkTitle LIKE :fkTitle AND";
			$binds[] = array("variable"=>$fkTitle, "bind" => "fkTitle", "type" => PDO::PARAM_INT);
		}
		else{
			$paramNumber += 1;
		}
		if(!empty($fkCategory)){        
			$reqSQL .= " fkCategory LIKE :fkCategory AND";
			$binds[] = array("variable"=>$fkCategory, "bind" => "fkCategory", "type" => PDO::PARAM_INT);
		}
		else{
			$paramNumber += 1;
		}

		if($paramNumber == 8){
			//remove the last 5 characters to remove the last AND and not have an sql error
			$reqSQL = substr($reqSQL, 0, -5);
			$req = $this->querySimpleExecute($reqSQL);
		}
		else{
			//remove the last 3 characters to remove the last AND and not have an sql error
			$reqSQL = substr($reqSQL, 0, -3);
			$req = $this->queryPrepareExecute($reqSQL, $binds);
		}
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
	}

	/**
     * Function that show all informations about a member
     */
	public function getOneMember($idMember)
	{
		/**
		 * Add the following line to format the date in dd/mm/yyyy
		 * DATE_FORMAT ((SELECT memDateBirth from t_member WHERE idMember = :idMember), '%d.%c.%Y') as 
		 */
		$reqSQL = "SELECT idMember, memLastName, memFirstName, memDateBirth, memPhoneNumber, memLicencing, memRanking, fkTitle, fkCategory, catName, titName  FROM t_member LEFT JOIN t_title ON t_member.fkTitle = t_title.idTitle JOIN t_category ON t_member.fkCategory = t_category.idCategory WHERE idMember = :idMember";
		$binds[] = array("variable"=>$idMember, "bind" => "idMember", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

	public function getAllTitle()
	{
		$reqSQL = "SELECT * FROM t_title";
		$req = $this->querySimpleExecute($reqSQL);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

	public function getAllCategory()
	{
		$reqSQL = "SELECT * FROM t_category";
		$req = $this->querySimpleExecute($reqSQL);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that going to check if a user exists or not in the table user
     */
    public function connectuser($useName)
    {
    	$reqSQL = "SELECT useName, usePassword FROM t_user WHERE useName = :useName LIMIT 1";
		$binds[] = array("variable" => $useName, "bind" => "useName", "type" => PDO::PARAM_STR);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }
}
?>