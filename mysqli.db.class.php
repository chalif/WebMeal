<?php
 class database_confs{
         var $host = "localhost";
         var $login = "";
         var $password = "";
         var $name = "";
         }


	class database extends database_confs{
		var $link;
		var $query;
		var $result;
		var $debug = 0;
		var $clear_parms = 0;
		var $utf = false;

		function connect(){
      $this->link = mysqli_connect($this->host,$this->login,$this->password, $this->name) or die(mysqli_connect_error());
			if($this->utf)
        mysqli_query($this->link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		}

		function switch_latin1(){
			mysqli_query($this->link, "SET NAMES 'latin1' COLLATE 'latin1_swedish_ci'");
		}
		function switch_utf8(){
			mysqli_query($this->link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		}

		function disconnect(){
			if($this->result)
				@mysqli_free_result($this->result);

			mysqli_close($this->link) or die(mysqli_connect_error());
		}

		function __destruct(){
			$this->disconnect();
		}

		function query($query=""){
			if($query)$this->query=$query;
			if($this->debug){
				trace($this->query);
				$this->result = mysqli_query($this->link, $this->query)
								or die(mysqli_error($this->link));
			}else{
				$this->result = mysqli_query($this->link, $this->query);
			}
		}

		function get_assocs($query=""){
			$ret_val=array();
			if($query)$this->query=$query;
			$this->query();
			if($this->result){
				while($row = mysqli_fetch_assoc($this->result))
					$ret_val[] = $row;
				mysqli_free_result($this->result);
			}
			return $ret_val;
		}

		function get_assoc($query=""){
			$ret_val=array();
			if($query)$this->query=$query;
			$this->query();
			if($this->result){
				while($row = mysqli_fetch_assoc($this->result))
					$ret_val = $row;
				mysqli_free_result($this->result);
			}
			return $ret_val;
		}

		function get_arrays($query=""){
			$ret_val=array();
			if($query)$this->query=$query;
			$this->query();
			if($this->result){
				while($row = mysqli_fetch_array($this->result))
					$ret_val[] = $row;
				mysqli_free_result($this->result);
			}
			return $ret_val;
		}

		function get_array($query=""){
			$ret_val=array();
			if($query)$this->query=$query;
			$this->query();
			if($this->result){
				while($row = mysqli_fetch_array($this->result))
					$ret_val = $row;
				mysqli_free_result($this->result);
			}
			return $ret_val;
		}

		function get_item($query=""){
			$ret_val=0;
			if($query)$this->query=$query;
			$this->query();
			if($this->result){
				list($ret_val) = mysqli_fetch_array($this->result);
				mysqli_free_result($this->result);
			}
			return $ret_val;
		}

		function select($type = "item", $table, $fields = array(), $where = array(), $statement = "1"){
			$i = 0;
			$needed_fields = "";
			$where_cause = "";
			if(sizeof($fields)){
				foreach($fields as $k=>$v){
					$i++;
					if($this->clear_parms)
						$needed_fields.="`".htmlspecialchars(stripslashes($v),ENT_QUOTES)."`";
					else
						$needed_fields.="`".$v."`";
					if($i<sizeof($fields))$needed_fields.=", ";
				}
			}
			if(sizeof($where)){
				foreach($where as $k=>$v){
					$i++;
					if($this->clear_parms)
						$where_cause.="`".$k."` = '".htmlspecialchars(stripslashes($v),ENT_QUOTES)."'";
					else
						$where_cause.="`".$k."` = '".$v."'";
					if($i<sizeof($where)+1)$where_cause.=" AND ";
				}
			}
			if(strlen($needed_fields)){
				$query = "select ".$needed_fields." from `".$table."` where ".$where_cause.$statement;
			}else{
				return false;
			}

			switch($type){
				case "item":
					return $this->get_item($query);
				break;

				case "assoc":
					return $this->get_assoc($query);
				break;

				case "assocs":
					return $this->get_assocs($query);
				break;

				case "array":
					return $this->get_array($query);
				break;

				case "arrays":
					return $this->get_arrays($query);
				break;
			}

			return false;
		}


		function update_table($table, $var = array(), $statement = "1"){
			$i = 0;
			$str = "";
			if(sizeof($var)){
				foreach($var as $k=>$v){
					$i++;
					if($this->clear_parms)
						$str.="`".$k."` = \"".htmlspecialchars(stripslashes($v),ENT_QUOTES)."\"";
					else
						$str.="`".$k."` = \"".$v."\"";
					if($i<sizeof($var))$str.=", ";
				}
				$this->query("update `".$table."` set ".$str." where ".$statement);
			}
			return(true);
		}

		function delete_from($table, $statement){
			$this->query("delete from `".$table."` where ".$statement);
			return(true);
		}

		function insert_into($table, $var = array()){
			$values = "";
			$str = "";
			$i = 0;
			if(sizeof($var)){
				foreach($var as $k=>$v){
					$i++;
					$values.="`".$k."`";
					if($this->clear_parms)
						$str.="\"".htmlspecialchars(stripslashes($v),ENT_QUOTES)."\"";
					else
						$str.="\"".$v."\"";
					if($i<sizeof($var)){
						$values.=", ";
						$str.=", ";
					}
				}
				$this->query("insert into `".$table."` (".$values.") values (".$str.")");
			}
			return($this->last_id());
		}

		function last_id(){
			return mysqli_insert_id($this->link);
		}
	}

	function trace($var){
		echo "\t";
		if(is_array($var)||is_object($var)){
			print_r($var);
		}else echo $var;
		echo "\n";
		return(0);
	}

?>
