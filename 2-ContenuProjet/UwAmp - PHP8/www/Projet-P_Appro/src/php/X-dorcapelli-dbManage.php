<?php  
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
		    $this->connector = new PDO("mysql:host=localhost;dbname=db_chess;charset=utf8","root","root");
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
     * Function that created book
     */
	public function addBook($booName, $booNbPage, $booExtract, $booResume, $booYearEdit, $fkCategory, $fkEditor, $fkAuthor)
	{
		$reqSQL = "INSERT INTO t_book(booName, booNbPage, booExtract, booResume, booYearEdit, fkCategory,fkEditor, fkAuthor) VALUES(:booName, :booNbPage, :booExtract, :booResume, :booYearEdit, :fkCategory, :fkEditor, :fkAuthor)";
		$binds[] = array("variable"=>$booName, "bind" => "booName", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$booNbPage, "bind" => "booNbPage", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$booExtract, "bind" => "booExtract", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$booResume, "bind" => "booResume", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$booYearEdit, "bind" => "booYearEdit", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$fkCategory, "bind" => "fkCategory", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkEditor, "bind" => "fkEditor", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkAuthor, "bind" => "fkAuthor", "type" => PDO::PARAM_INT);
        $req = $this->queryPrepareExecute($reqSQL, $binds);;
		$this->unsetData($req);
		return $this->connector->lastInsertId();
	}

	/**
     * Function that add a notice to a book
     */
	public function addNotice($notNote, $notText, $fkUser, $fkBook)
	{
		$reqSQL = "INSERT INTO t_notice(notNote, notText, fkUser, fkBook) VALUES(:notNote, :notText, :fkUser, :fkBook)";
		$binds[] = array("variable"=>$notNote, "bind" => "notNote", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$notText, "bind" => "notText", "type" => PDO::PARAM_STR);
        $binds[] = array("variable"=>$fkUser, "bind" => "fkUser", "type" => PDO::PARAM_INT);
        $binds[] = array("variable"=>$fkBook, "bind" => "fkBook", "type" => PDO::PARAM_INT);
        $req = $this->queryPrepareExecute($reqSQL, $binds);
		$this->unsetData($req);
	}

	/**
     * Function that show you all the book of the database order by category
     */
	public function bookCategory($id)
	{
		$reqSQL = "SELECT * FROM t_book JOIN t_author ON t_author.idAuthor = fkAuthor WHERE t_book.fkCategory = :idCategory";
		$binds[] = array("variable"=>$id, "bind" => "idCategory", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
	}

	/**
     * Function that show all information about all Stock
     */
	public function getAllStock()
	{
		$reqSQL = "SELECT * FROM t_stock";
		$req = $this->querySimpleExecute($reqSQL);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
	}

	/**
     * Function that show all informations about a book
     */
	public function getOneBook($id)
	{
		$reqSQL = "SELECT * FROM t_book JOIN t_author ON t_book.idBook = t_author.idAuthor WHERE idBook = :idBook";
		$binds[] = array("variable"=>$id, "bind" => "idBook", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that going to get the average of all the notice about a book
     */
    public function getNoticeAverage($idBook)
    {
    	$reqSQL = "SELECT (AVG(notNote)) AS Average FROM t_notice WHERE fkBook = :idBook";
		$binds[] = array("variable"=>$idBook, "bind" => "idBook", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that going to get the average of all the notice about a user
     */
    public function getAllPrepose($idUser)
    {
    	$reqSQL = "SELECT notNote, notText, usePseudo FROM t_notice JOIN t_user ON fkUser = idUser WHERE fkUser = :idUser ";
		$binds[] = array("variable"=>$idUser, "bind" => "idUser", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that going to check if a user exists or not in the table artiste
     */
    public function connectArtiste($artIdentifiant)
    {
    	$reqSQL = "SELECT artIdentifiant, artMdp FROM t_artiste WHERE artIdentifiant = :artIdentifiant LIMIT 1";
		$binds[] = array("variable" => $artIdentifiant, "bind" => "artIdentifiant", "type" => PDO::PARAM_STR);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that going to check if a user exists or not in the table caisse
     */
    public function connectCaisse($caiIdentifiant)
    {
    	$reqSQL = "SELECT caiIdentifiant, caiMdp FROM t_caisse WHERE caiIdentifiant = :caiIdentifiant LIMIT 1";
		$binds[] = array("variable" => $caiIdentifiant, "bind" => "caiIdentifiant", "type" => PDO::PARAM_STR);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    /**
     * Function that show all informations about all users
     */
    public function getCurrentUser()
    {
    	$reqSQL = "SELECT CURRENT_USER()";
		$req = $this->querySimpleExecute($reqSQL);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    public function addEditor($ediName)
    {
		$reqSQL = "INSERT INTO t_editor(ediName) VALUES (:ediName)";
		$binds[] = array("variable"=>$ediName, "bind" => "ediName", "type" => PDO::PARAM_STR);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$this->unsetData($req);

		$reqSQL = "SELECT * FROM t_editor WHERE ediName LIKE :ediName";
		$binds[] = array("variable"=>$ediName, "bind" => "ediName", "type" => PDO::PARAM_STR);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }

    public function updateUser($idUser)
    {
    	$reqSQL = "UPDATE t_user SET usePrepose = usePrepose + 1 WHERE idUser = :idUser";
		$binds[] = array("variable"=>$idUser, "bind" => "idUser", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$this->unsetData($req);
    }

    public function verifyNotice($fkUser, $fkBook)
    {
    	$reqSQL = "SELECT * FROM t_notice WHERE fkUser = :fkUser AND fkBook = :fkBook";
		$binds[] = array("variable" => $fkUser, "bind" => "fkUser", "type" => PDO::PARAM_INT);
		$binds[] = array("variable" => $fkBook, "bind" => "fkBook", "type" => PDO::PARAM_INT);
		$req = $this->queryPrepareExecute($reqSQL, $binds);
		$result = $this->formatData($req);
		$this->unsetData($req);
		return $result;
    }
}

?>