<!-- This code is for the form which registers new media -->
<?php 
	// if (!(isset($_SESSION['userId']))){
	// 	header("Location: index.php");
	// }	
		/*if(isset($_GET['update'])){
			$row_id = $_GET['id'] ?? null;
			include("includes/media.inc.php");
			
			echo "<script>$(document).ready(function(){
		  		$('#register_book_form').modal('show')
		  		})
		  	</script>";
			$new_session = Media::fetchFromDatabase($row_id);
		}
			// print_r($new_session);
			$location_id = $new_session[0]["id"] ?? NULL;
			$title = $new_session[0]["title"] ?? "Die Reisen des John Doe";
			$image = $new_session[0]["image"] ?? "img/default.jpg";
			$isbn = $new_session[0]["isbn"] ?? "1234567890";
			$short_description = $new_session[0]["short_description"] ?? "Some short description about this book";
			$publish_date = $new_session[0]["publish_date"] ?? "2018-11-09";
			$type = $new_session[0]["type"] ?? NULL;
			$status = $new_session[0]["status"] ?? NULL;
			$user_id = $new_session[0]["user_id"] ?? NULL;
			$author = $new_session[0]["author"] ?? "Horst Peter";
			$publisher = $new_session[0]["publisher"] ?? "Horst Wald Verlag";
			$address = $new_session[0]["address"] ?? "Horstgasse 1, 1210, Wien";
			$size = $new_session[0]["size"] ?? NULL;*/
			$location_id = NULL;
			$category = 'restaurant';
			$name = 'Horst Skulptur';
			$image = 'img/church.jpg';
			$city = 'Vienna';
			$zip = '1234';
			$street = 'Horststraße 1';
			$phone = '00431233445';
			$type = 'austrian';
			$description = 'Test me description!';
			$webpage = 'www.larifariland.com';
			$date = '2019-03-04';
			$price = 456;
			$location = 'krasses Pferd';
			$visited = NULL;
?>

<div class="modal fade" id="register_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">
	        	<?php if($location_id){echo("Change the Location Here!");}else{echo("Add New Location Here!");} ?>
	        </h5>
	        <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id='testing'></div>
	        <form id="data_form" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="form-group">
					<input class="form-control" type="text" name="id" placeholder="id empty" value="<?php echo $location_id; ?>">
				</div>
				<select id="category" class="custom-select form-control" name="category" required>
							<option value=""  disabled>Choose Category</option>
							<option value="restaurant" <?php if($category=='restaurant'){echo 'selected';}?> >Restaurant</option>
							<option value="sight" <?php if($category=='sight'){echo 'selected';}?> >Sight</option>
							<option value="event" <?php if($category=='event'){echo 'selected';}?> >Event</option>
				</select>
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" placeholder="Name of the location" value="<?php echo $name; ?>">
				</div>
				<div class="form-group ">
					<label>Upload Image</label>
					<input class="d-block form-control" type="file" name="uploadFile" value="" alt="">
				</div>
				<div class="form-group">
					<img class="media_photo mt-1 d-inline" src="<?php echo $image; ?>" alt="No picture yet!">
					<div class="checkbox d-inline">
						<label class="d-inline"><input class="d-inline" type="checkbox" name="delete_image">Delete Image</label>
					</div>
				</div>
				<div class="form-group">
					<label>City</label>
					<input class="form-control" type="text" name="city" placeholder="City" value="<?php echo $city; ?>">
					<label>ZIP</label>
					<input class="form-control" type="text" name="zip" placeholder="ZIP" value="<?php echo $zip; ?>">
					<label>Street</label>
					<input class="form-control" type="text" name="street" placeholder="Street" value="<?php echo $street; ?>">
				</div>
					<!-- <div class="d-flex justify-content-between align-items-end form-group"> -->
				<!-- separate fields for Restaurant -->
				<div class="restaurant_container">	
					<div class="form-group">
						<label>Phone</label>
						<input class="form-control" type="text" name="phone" placeholder="Phone" value="<?php echo $phone; ?>">
					</div>
					<div class="form-group">
						<select class="custom-select form-control" name="type">
							<option value=""  disabled>Choose Type</option>
							<option value="austrian" <?php if($type=='austrian'){echo 'selected';} ?>>Austrian</option>
							<option value="chinese" <?php if($type=='chinese'){echo 'selected';} ?>>Chinese</option>
							<option value="tibetian" <?php if($type=='tibetian'){echo 'selected';} ?>>Tibetian</option>
						</select>
					</div>
				</div>
				<div class="multi_container">
					<div class="form-group">
						<label>Short Description</label>
						<input class="form-control" type="text" name="description" placeholder="Short Description" value="<?php echo $description; ?>">
					</div>
					<div class="form-group">
						<label>Webpage</label>
						<input class="form-control" type="text" name="webpage" placeholder="Webpage" value="<?php echo $webpage; ?>">
					</div>
				</div>
				<!-- separate extra fields for Sights -->
				<div class="sight_container">
					<div class="form-group">
						<select class="custom-select form-control" name="type_sights">
							<option value=""  disabled>Choose Type</option>
							<option value="Building" <?php if($type=='building'){echo 'selected';} ?>>Building</option>
							<option value="Park" <?php if($type=='park'){echo 'selected';} ?>>Park</option>
							<option value="Museum" <?php if($type=='museum'){echo 'selected';} ?>>Museum</option>
						</select>
					</div>
					<div class="form-group">
						<label>Visit-Date</label>
						<input class="form-control" type="datetime" name="visit_date" placeholder="Visit Date" value="<?php echo $visited; ?>">
					</div>
				</div>
				<!-- separate extra fields for Event -->
				<div class="event_container">	
					<div class="form-group">
						<label>Date</label>
						<input class="form-control" type="datetime" name="date" placeholder="Date" value="<?php echo $date; ?>">
					</div>
					<div class="form-group">
						<label>Price</label>
						<input class="form-control" type="text" name="price" placeholder="Price" value="<?php echo $price; ?>">
					</div>
					<div class="form-group">
						<label>Location</label>
						<input class="form-control" type="text" name="location" placeholder="Location" value="<?php echo $location; ?>">
					</div>
				</div>
				<div class="d-flex justify-content-center btn-group">
					<button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
					<input class="btn btn-success" type="submit" name="submit" value="<?php if($location_id){echo "Update\""." id='edit_submit'";} else {echo"Insert\""." id='insert_submit'";}?>">
				</div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>