<?php
abstract class Location {
	
	public $location_id;
	public $loc_type;
	public $name;
	public $city;
	public $zip;
	public $street;
	public $image;
		
	function __construct($location_id = NULL, $loc_type, $name, $city, $zip, $street, $image){
		$this->location_id = $location_id;
		$this->loc_type = $loc_type;
		$this->name = $name;
		$this->city = $city;
		$this->zip = $zip;
		$this->street = $street;
		$this->image = $image;
	}
}
?>	

