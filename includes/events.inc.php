<?php
require_once("abstract.location.inc.php");

class Event extends Location {
	
	public $event_date;
	public $price;
	public $location;
		
	function __construct($event_date, $price, $location, $location_id = NULL, $loc_type, $name, $city, $zip, $street, $image){
		parent::__construct($location_id, $loc_type, $name, $city, $zip, $street, $image);
		
		$this->event_date = $event_date;
		$this->price = $price;
		$this->location = $location;
		$this->location_id = $location_id;
		$this->loc_type = $loc_type;
		$this->name = $name;
		$this->city = $city;
		$this->zip = $zip;
		$this->street = $street;
		$this->image = $image;
	}

	public static function buildQuery($search){

		$sql_select = "
		SELECT 
			e.id,
		    e.name,
		    e.image,
		    concat(a.street,', ',a.zip,', ',a.city) as address,
		    e.category,
		    e.start_date,
		    e.location,
		    e.price	";

		$sql_select .= "
			FROM event e
				LEFT JOIN address a
				ON e.address_id = a.id ";

		$sql_select .= "
			WHERE (name LIKE '%".$search."%') ";

		$sql_select .= "
			ORDER BY name;";
		
		return $sql_select;
	}

	public function build_insert_query(){

		//query for writing into the database
		$sql_insert_address = "
			INSERT INTO address (
				city,
				zip,
				street) ";

		$sql_insert_address .= "
			VALUES (
				'$this->city',
				'$this->zip',
				'$this->street');";

		$sql_insert_event = "
			INSERT INTO event (
				name,
				address_id,
				start_date,
			    price,
			    location,
			    image,
			    category) ";

		//in the future it could be a nice idea to make a lockup for the address_id, if already existing already in the form!
		$sql_insert_event .= "
			VALUES (
				'$this->name',
				last_insert_id(),
				'$this->event_date',
				'$this->price',
				'$this->location',
				'$this->image',
				'$this->loc_type');";

		return array($sql_insert_address, $sql_insert_event);
	}
}

?>	