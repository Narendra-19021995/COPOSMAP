
<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Employee($connString);

	switch($action) {
	 case 'add':
		$empCls->insertEmployee($params);
	 break;
	 case 'edit':
		$empCls->updateEmployee($params);
	 break;
	 case 'delete':
		$empCls->deleteEmployee($params);
	 break;
	 default:
	 $empCls->getEmployees($params);
	 return;
	}
	
	class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getEmployees($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	function insertEmployee($params) {
		$data = array();;
		$sql = "INSERT INTO `studentdetails` (Name, Yearofstudy, CourseName, Age, contact, gender, Place) VALUES('" . $params["Name"] . "', '" . $params["Yearofstudy"] . "','" . $params["CourseName"] . "','" . $params["Age"] . "','" . $params["contact"] . "','" . $params["gender"] . "','" . $params["Place"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert employee data");
		
	}
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( ID LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR Name LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR Yearofstudy LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR CourseName LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR Age LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR contact LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR gender LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR Place LIKE '".$params['searchPhrase']."%' ";
			
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `studentdetails`";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	function updateEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update studentdetails set Name = '" . $params["edit_Name"] . "', Yearofstudy='" . $params["edit_Yearofstudy"]."', CourseName='" . $params["edit_CourseName"] . "', Age='" . $params["edit_Age"]."', contact='" . $params["edit_contact"]."', gender='" . $params["edit_gender"]."', Place='" . $params["edit_Place"]."' WHERE ID='".$_POST["edit_ID"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function deleteEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `studentdetails` WHERE ID = '".$params["id"]."'" ;
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete employee data");
	}
}
?>
	