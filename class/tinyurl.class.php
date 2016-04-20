<?php
class TinyURL
{
	function __construct()
	{
		$this->SiteURL = "http://localhost/bharat/git/tiny-url-with-php";

		if(isset($_POST['submit_url']) && isset($_POST['long_url']) && $_POST['long_url']!="") 
		{
			$this->MakeTinyURL($_POST['long_url']);
		}

		if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!="") 
		{
			$this->GetTinyURL($_SERVER['QUERY_STRING']);
		}
	}

	function DBConnection()
	{
		$this->con = mysqli_connect("localhost","root","","bharat_tiny_url");
	}

	function MakeTinyURL($long_url)
	{
		$this->DBConnection();
		$last_id = mysqli_fetch_assoc(mysqli_query($this->con,"select max(id) as max_id from tiny_url_master"));
		$tiny_url = $this->SiteURL."?".$this->EcryptString($last_id['max_id']+1);
		mysqli_query($this->con,"insert into tiny_url_master set 
					long_url = '".addslashes($long_url)."',
					tiny_url = '".$tiny_url."',
					created_date = '".date("Y-m-d H:i:s")."'
			");
	}

	function DisplayTinyURL()
	{
		$this->DBConnection();
		$query = mysqli_query($this->con,"select long_url, tiny_url from tiny_url_master order by id desc");
		if(mysqli_num_rows($query)>0)
		{
			echo "<table width='80%' border='1' cellpadding='5'>";
				echo "<tr><th>Tiny URL</th><th>Long URL </th></tr>";
				while($data = mysqli_fetch_assoc($query))
				{
					echo "<tr>";
						echo "<td>".$data['tiny_url']."</td>";
						echo "<td>".$data['long_url']."</td>";
					echo "</tr>";
				}
			echo "</table>";
		}
	}

	function GetTinyURL($id)
	{
		$this->DBConnection();
		$tiny_url_id = $this->DecryptString($id);
		$data = mysqli_fetch_assoc(mysqli_query($this->con,"select long_url from tiny_url_master where id = '".$tiny_url_id."'"));

		if(@$data['long_url']!="") {
			@header("location:".$data['long_url']);
			exit;
		} else {
			@header("location:example.php");
			exit;
		}
	}

	function EcryptString($string)
	{
		$search_array = array(0,1,2,3,4,5,6,7,8,9);
		$replace_array = array("a","b","c","d","e","f","g","h","i","j");
		
		return str_replace($search_array,$replace_array,$string);		
	}

	function DecryptString($string)
	{
		$search_array = array(0,1,2,3,4,5,6,7,8,9);
		$replace_array = array("a","b","c","d","e","f","g","h","i","j");
		
		return str_replace($replace_array,$search_array,$string);		
	}

}
?>