<!-- This code is for the form which registers new media -->

<div class="modal fade" id="register_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">
	        	Change or add the Location Here!
	        </h5>
	        <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id='testing'></div>
	        <form id="data_form" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="form-group">
					<input class="form-control" type="text" name="id" placeholder="id empty" value="">
				</div>
				<select id="category" class="custom-select form-control" name="category" required>
							<option value="" selected disabled>Choose Category</option>
							<option value="restaurants">Restaurant</option>
							<option value="sights"> Sight</option>
							<option value="events">Event</option>
				</select>
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" placeholder="Name of the location" value="">
				</div>
				<div class="form-group ">
					<label>Upload Image</label>
					<input class="d-block form-control" type="file" name="uploadFile" value="" alt="">
				</div>
				<div class="form-group">
					<img id="event_picture" class="media_photo mt-1 d-inline" src="" alt="No picture yet!">
					<div class="checkbox d-inline">
						<label class="d-inline"><input class="d-inline" type="checkbox" name="delete_image">Delete Image</label>
					</div>
				</div>
				<div class="form-group">
					<label>City</label>
					<input class="form-control" type="text" name="city" placeholder="City" value="">
					<label>ZIP</label>
					<input class="form-control" type="text" name="zip" placeholder="ZIP" value="">
					<label>Street</label>
					<input class="form-control" type="text" name="street" placeholder="Street" value="">
				</div>
					<!-- <div class="d-flex justify-content-between align-items-end form-group"> -->
				<!-- separate fields for Restaurant -->
				<div class="restaurant_container">	
					<div class="form-group">
						<label>Phone</label>
						<input class="form-control" type="text" name="phone" placeholder="Phone" value="">
					</div>
					<div class="form-group">
						<select id="restaurant_type" class="custom-select form-control" name="type">
							<option value=""  disabled>Choose Type</option>
							<option value="Austrian">Austrian</option>
							<option value="Chinese">Chinese</option>
							<option value="Indian">Indian</option>
						</select>
					</div>
				</div>
				<div class="multi_container">
					<div class="form-group">
						<label>Short Description</label>
						<input class="form-control" type="text" name="description" placeholder="Short Description" value="">
					</div>
					<div class="form-group">
						<label>Webpage</label>
						<input class="form-control" type="text" name="webpage" placeholder="Webpage" value="">
					</div>
				</div>
				<!-- separate extra fields for Sights -->
				<div class="sight_container">
					<div class="form-group">
						<select class="custom-select form-control" name="type_sights">
							<option value=""  disabled>Choose Type</option>
							<option value="Building">Building</option>
							<option value="Park">Park</option>
							<option value="Museum">Museum</option>
						</select>
					</div>
					<div class="form-group">
						<label>Visit-Date</label>
						<input class="form-control" type="datetime" name="visit_date" placeholder="Visit Date" value="">
					</div>
				</div>
				<!-- separate extra fields for Event -->
				<div class="event_container">	
					<div class="form-group">
						<label>Date</label>
						<input class="form-control" type="datetime" name="date" placeholder="Date" value="">
					</div>
					<div class="form-group">
						<label>Price</label>
						<input class="form-control" type="text" name="price" placeholder="Price" value="">
					</div>
					<div class="form-group">
						<label>Location</label>
						<input class="form-control" type="text" name="location" placeholder="Location" value="">
					</div>
				</div>
				<div class="d-flex justify-content-center btn-group">
					<button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
					<input class="btn btn-success" type="submit" name="submit" value="Submit">
				</div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>