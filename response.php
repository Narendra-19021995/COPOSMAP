
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
		$sql = "INSERT INTO `faculty_regi` (Name, C_name, D_name, Address, contact, email, U_name, password, c_password) VALUES('" . $params["Name"] . "', '" . $params["C_name"] . "','" . $params["D_name"] . "','" . $params["Address"] . "','" . $params["contact"] . "','" . $params["email"] . "','" . $params["U_name"] . "','" . $params["password"] . "','" . $params["c_password"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert employee data");
		
	}
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( Fid LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR Name LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR C_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR D_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR Address LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR contact LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR email LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR U_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR password LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR c_password LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `faculty_regi`";
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
		$sql = "Update faculty_regi set Name = '" . $params["edit_Name"] . "', C_name='" . $params["edit_C_name"]."', D_name='" . $params["edit_D_name"] . "', Address='" . $params["edit_Address"]."', email='" . $params["edit_email"]."', contact='" . $params["edit_contact"]."', U_name='" . $params["edit_U_name"]."', password='" . $params["edit_password"]."', c_password='" . $params["edit_c_password"]."' WHERE Fid='".$_POST["edit_Fid"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function deleteEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `faculty_regi` WHERE Fid = '".$params["id"]."'" ;
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete employee data");
	}
}
?>
	