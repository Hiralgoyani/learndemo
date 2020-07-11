<?php /* Template Name: Register Template */ ?>
<?php 
get_header();
?>

<div class="row">
	<div class="container">
		<div class="reg-form-container">
			<form method="post" action="#" id="regEmpForm" enctype="multipart/form-data" >
				<div class="form-control">
					<label>Name</label>
					<input type="text" name="emp_name" id="emp_name" class="emp-name input-control" required />
				</div>

				<div class="form-control">
					<label>Email</label>
					<input type="email" name="emp_email" id="emp_email" class="emp-email input-control" required />
				</div>

				<div class="form-control">
					<label>Password</label>
					<input type="password" name="emp_password" id="emp_password" class="emp-password input-control" required />
				</div>

				<div class="form-control">
					<label>DOB</label>
					<input type="date" name="emp_dob" id="emp_dob" class="emp-dob input-control" required />
				</div>

				<div class="form-control">
					<label>City</label>
					<select name="emp_city" id="emp_city" class="emp-city input-control" required>
						<option value="">--Choose city--</option>
						<option value="surat">Surat</option>
						<option value="mumbai">Mumbai</option>
						<option value="goa">Goa</option>
					</select>
				</div>

				<div class="form-control">
					<label>Gender</label>
					<input type="radio" name="emp_gender" value="M" id="emp_gender1" class="emp-gender input-control" checked="" /> Male
					<input type="radio" name="emp_gender" value="F" id="emp_gender2" class="emp-gender input-control" /> Female
				</div>

				<div class="form-control">
					<label>Hobbies</label>
					<input type="checkbox" name="emp_hbs[]" value="cricket" id="emp_hbs1" class="emp-hbs input-control"> Cricket
					<input type="checkbox" name="emp_hbs[]" value="football" id="emp_hbs2" class="emp-hbs input-control"> Football
					<input type="checkbox" name="emp_hbs[]" value="carrom" id="emp_hbs3" class="emp-hbs input-control"> carrom
				</div>

				<div class="form-control">
					<label>Profile</label>
					<input type="file" name="emp_profile" id="emp_profile" class="emp-profile input-control" required />
				</div>

				<div class="form-control">
					<label></label>
					<button type="button" name="emp_sub" id="emp_sub" class="emp-sub input-control">Register</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
get_footer();