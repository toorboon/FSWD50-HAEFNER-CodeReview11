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

	public static function buildQuery($search, $edit_id = ''){

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
		    r.phone,
		    a.street,
		    a.zip,
		    a.city ";

		$sql_select .= "
			FROM restaurants r
				LEFT JOIN address a
				ON r.address_id = a.id ";

		$sql_select .= "
			WHERE (r.name LIKE '%".$search."%') 
				AND r.id LIKE '%".$edit_id."%' ";

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
			INSERT INTO restaurants (
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

	public function build_update_query($row_id){

		if ($this->image && $this->image != 'delete') {
			$image = "image = '$this->image',";
		} else if ($this->image == 'delete') {
			$image = "image = NULL,";
		} else {
			$image = '';
		}

		//query for writing into the database
		$sql_update_address = "
			UPDATE address ";

		$sql_update_address .= "
			SET city = '$this->city', 
				zip = '$this->zip',
				street = '$this->street' ";

		$sql_update_address .= "
			WHERE id in (SELECT address_id 
								 FROM restaurants
								 WHERE id = ".$row_id.");";

		$sql_update_restaurant = "
			UPDATE restaurants ";

		$sql_update_restaurant .= "
			SET name = '$this->name',
				phone = '$this->phone',
				type = '$this->type',
			    description = '$this->description',
			    webpage = '$this->webpage',
			    ".$image."
			    category = '$this->loc_type' ";

		$sql_update_restaurant .= "
			WHERE id = ".$row_id.";";

		return array($sql_update_address, $sql_update_restaurant);
	}
}

?>	

