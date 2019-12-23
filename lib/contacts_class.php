<?php
	//@session_start();
	class Contact{
	
		private $db;
		
		private static $contact = null;
		
		private function __construct(){
			$this->db = new mysqli("localhost", "root", "usbw", "oobsbase");
			$this->db->query("SET NAMES 'utf8'");
		}
		
		public static function getObject(){
			if(self::$contact === null) self::$contact = new Contact();
			return self::$contact;
		}
		
		public function addContact($sbbank, $sbregion, $sbservice, $sbposition, $sbfullname, $sbphone1, $sbphone2){
			if($sbbank == "") return false;
			if($sbfullname == "") return false;
			if($sbphone1 == "") return false;
			return $this->db->query("INSERT INTO `contacts` (`bank`, `region`, `service`, `position`, `fullname`, `phone1`, `phone2`) 
									VALUES ('$sbbank', '$sbregion', '$sbservice', '$sbposition', '$sbfullname', '$sbphone1', '$sbphone2')");
		}
		
		public function delContact($idtodel){
			return $this->db->query("DELETE FROM `contacts` WHERE `id` = '".$idtodel. "'");
		}
		
		function showAllContacts(){
			$result_set = $this->db->query("SELECT * FROM `contacts`");
			$contact = $result_set;
			return $contact;
			$result_set->close();
			}
			
		function showAllContactsIf($sorting, $quantity, $list){
			$result_set = $this->db->query("SELECT * FROM `contacts` ORDER BY $sorting LIMIT $quantity OFFSET $list");
			$contact = $result_set;
			return $contact;
			$result_set->close();
			}	
		
		function showSearchBankContacts($sbbank, $sbregion, $sbfullname){
			$result_set = $this->db->query("SELECT * FROM `contacts` WHERE `bank` LIKE '%$sbbank%' AND `region` LIKE '%$sbregion%' AND `fullname` LIKE '%$sbfullname%'");
			$contact = $result_set;
			return $contact;
			$result_set->close();
			}
			
		function showSearchBankContactsIF($sbbank, $sbregion, $sbfullname, $sorting, $quantity, $list){
			$result_set = $this->db->query("SELECT * FROM `contacts` WHERE `bank` LIKE '%$sbbank%' AND `region` LIKE '%$sbregion%' AND `fullname` LIKE '%$sbfullname%' 
			ORDER BY $sorting LIMIT $quantity OFFSET $list");
			$contact = $result_set;
			return $contact;
			$result_set->close();
			}
		
		public function __distruct(){
			if($this->db) $this->db->close();
		}
	
	}
	
	
	
?>