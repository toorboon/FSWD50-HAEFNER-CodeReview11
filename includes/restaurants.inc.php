<?php
require_once ("abstract.location.inc.php");

class Restaurant extends Location {
	
	public $phone;
	public $webpage;
	public $type;
	public $description;
		
	function __construct($phone, $webpage, $type, $description = NULL, $location_id = NULL, $loc_type = NULL, $name, $city, $zip, $street, $image){
		parent::__construct($location_id, $loc_type, $name, $city, $zip, $street, $image);
		$this->phone = $phone;
		$this->webpage = $webpage;
		$this->type = $type;
		$this->description = $description;
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
			r.id,
		    r.name,
		    r.image,
		    concat(a.street,', ',a.zip,', ',a.city) as address,
		    r.category,		    
		    r.type,
		    r.description,
		    r.webpage,
		    r.phone ";

		$sql_select .= "
			FROM restaurant r
				LEFT JOIN address a
				ON r.address_id = a.id ";

		$sql_select .= "
			WHERE (r.name LIKE '%".$search."%') ";

		$sql_select .= "
			ORDER BY r.name;";
		
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

		

		$sql_insert_restaurant = "
			INSERT INTO restaurant (
				name,
				phone,
				type,
			    description,
			    address_id,
			    webpage,
			    image,
			    category )";

		//in the future it could be a nice idea to make a lockup for the address_id, if already existing already in the form!
		$sql_insert_restaurant .= "
			VALUES (
				'$this->name',
				'$this->phone',
				'$this->type',
				'$this->description',
				last_insert_id(),
				'$this->webpage',
				'$this->image',
				'$this->loc_type');";

		
		return array($sql_insert_address, $sql_insert_restaurant);
	}
}
/*$test = new Restaurant('phone?','webpage?','loc_type','test','test','test','test','test');
print_r($test);*/
?>	

