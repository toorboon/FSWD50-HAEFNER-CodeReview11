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

	public static function buildQuery($search, $edit_id = ''){

		$sql_select = "
		SELECT 
			e.id,
		    e.name,
		    e.image,
		    concat(a.street,', ',a.zip,', ',a.city) as address,
		    e.category,
		    e.start_date,
		    e.location,
		    e.price,
		    a.street,
		    a.zip,
		    a.city	";

		$sql_select .= "
			FROM travelomatic_events e
				LEFT JOIN travelomatic_address a
				ON e.address_id = a.id ";

		$sql_select .= "
			WHERE (name LIKE '%".$search."%')
				AND e.id LIKE '%".$edit_id."%' ";

		$sql_select .= "
			ORDER BY name;";
		
		return $sql_select;
	}

	public function build_insert_query(){

		//query for writing into the database
		$sql_insert_address = "
			INSERT INTO travelomatic_address (
				city,
				zip,
				street) ";

		$sql_insert_address .= "
			VALUES (
				'$this->city',
				'$this->zip',
				'$this->street');";

		$sql_insert_event = "
			INSERT INTO travelomatic_events (
				name,
				address_id,
				start_date,
			    price,
			    location,
			    image,
			    category) ";

		//in the future it could be a nice idea to make a lockup for the address_id, if existing already in the form!
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

	public function build_update_query($row_id){

		if ($this->image) {
			$image = "image = '$this->image',";
		} else {
			$image = '';
		}

		//query for writing into the database
		$sql_update_address = "
			UPDATE travelomatic_address ";

		$sql_update_address .= "
			SET city = '$this->city', 
				zip = '$this->zip',
				street = '$this->street' ";

		$sql_update_address .= "
			WHERE id in (SELECT address_id 
								 FROM travelomatic_events
								 WHERE id = ".$row_id.");";

		$sql_update_event = "
			UPDATE travelomatic_events ";

		$sql_update_event .= "
			SET name = '$this->name',
				start_date = '$this->event_date',
				price = '$this->price',
				location = '$this->location',
			    ".$image."
			    category = '$this->loc_type' ";

		$sql_update_event .= "
			WHERE id = ".$row_id.";";

		return array($sql_update_address, $sql_update_event);
	}
}

?>	