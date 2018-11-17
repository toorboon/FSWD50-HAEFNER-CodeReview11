<?php
require_once("abstract.location.inc.php");

class Sight extends Location {
	
	public $visited;
	public $type;
	public $description;
	public $webpage;
		
	function __construct($visited = NULL, $type, $description = NULL, $webpage = NULL, $location_id = NULL, $loc_type, $name, $city, $zip, $street, $image){
		parent::__construct($location_id, $loc_type, $name, $city, $zip, $street, $image);
		$this->visited = $visited;
		$this->type = $type;
		$this->description = $description;
		$this->webpage = $webpage;
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
			s.id,
		    s.name,
		    s.image,
		    concat(a.street,', ',a.zip,', ',a.city) as address,
		    s.category,
		    s.type,
		    s.description,
		    s.webpage ";

		$sql_select .= "
			FROM sight s
				LEFT JOIN address a
				ON s.address_id = a.id ";

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

		$sql_insert_sight = "
			INSERT INTO sight (
				name,
				address_id,
				visit_date,
			    type,
			    image,
			    category,
			    webpage,
			    description) ";

		//in the future it could be a nice idea to make a lockup for the address_id, if already existing already in the form!
		$sql_insert_sight .= "
			VALUES (
				'$this->name',
				last_insert_id(),
				'$this->visited',
				'$this->type',
				'$this->image',
				'$this->loc_type',
				'$this->webpage',
				'$this->description');";

		return array($sql_insert_address, $sql_insert_sight);
	}
}
/*$test = new Sight('1','2','3','4','5','6','7','8');
print_r($test);*/

?>	