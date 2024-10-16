<?
	error_reporting(0);
	function num_rows($table,$condition){
		$query=mysql_query("SELECT * FROM $table WHERE $condition") or die (mysql_error());
		$num_rows=mysql_num_rows($query);
		return $num_rows;
	}
	
	function insert($table,$Fields,$value){
		$query=mysql_query("INSERT INTO $table ($Fields) VALUES ($value)") or die (mysql_error());
		return $query;	
	}
	
	function select($table,$condition){
		$query=mysql_query("SELECT * FROM $table WHERE $condition") or die (mysql_error());
		return $query;	
	}
	
	function delete($table,$condition){
		$query=mysql_query("DELETE FROM $table WHERE $condition") or die (mysql_error());	
		return $query;
	}
	
	function update($table,$command,$condition){
		$query=mysql_query("UPDATE $table SET $command WHERE $condition") or die (mysql_error());
		return $query;	
	}
?>