<?php
	include("../include/_conn.php");
	$packageId=isset($_POST['packageId'])?$_POST['packageId']:"";

	$name="";
	$website="";
	$version="";
	$dependency="";
	$code="";
	$description="";
	if ($packageId!=""){
		$sql="SELECT * FROM dev_package WHERE id=$packageId";
		$result=mysqli_query($db,$sql);
		while($row=mysqli_fetch_array($result)){
			extract($row);
		}
	}

?>
<?php if ($packageId=="") { ?>
<h1>Add a Package</h1>
<?php } else { ?>
<h1>Edit a Package</h1>
<?php } ?>
<div class="row placeholders">
</div>
<form class="form-horizontal" id='add-package-form'>
	<fieldset>
		<legend>Package Info</legend>
		<div class="form-group">
			<label for='package-name' class='col-lg-2 control-label'>Name</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='name' id='package-name' placeholder='Package Name...' value="<?php echo $name ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='package-website' class='col-lg-2 control-label'>Website</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='website' id='package-website' placeholder='Package Website...'  value="<?php echo $website ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='package-version' class='col-lg-2 control-label'>Version</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='version' id='package-version' placeholder='Package Version...'  value="<?php echo $version ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='package-dependency' class='col-lg-2 control-label'>Dependency</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='dependency' id='package-dependency' placeholder='Package Dependency...'  value="<?php echo $dependency ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='package-code' class='col-lg-2 control-label'>Code</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='code' id='package-code' placeholder='Package Code...'  value="<?php echo htmlentities($code) ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='package-description' class='col-lg-2 control-label'>Description</label>
			<div class="col-lg-8">
				<textarea class="form-control" rows="5" name='description' id="package-description" placeholder='Anything about this package...'><?php echo htmlentities($description); ?></textarea>
			</div>
		</div>
		<div class='col-lg-10'><hr></div>
		<div class="form-group">
	      <div class="col-lg-2 col-lg-offset-9">
	        <button type="submit" class="btn btn-primary" id='add-package-form-submit'>Submit</button>
	      </div>
	    </div>
	    <input type='hidden' name='packageId' value="<?php echo $packageId ?>">
	</fieldset>
</form>


<script type="text/javascript">
	jQuery("#add-package-form-submit").click(function(event) {
		event.preventDefault();
		var url='../widgetFunctions/addPackage.php';
		var data=jQuery("#add-package-form").serialize();
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: data,
		  success: function(data, textStatus, xhr) {
		  	if (data=="1"){
			  	toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This package has been added.");
			  	jQuery("#package-name").val("");
			  	jQuery("#package-website").val("");
			  	jQuery("#package-version").val("");
			  	jQuery("#package-dependency").val("");
			  	jQuery("#package-code").val("");
			  	jQuery("#package-description").val("");
			} else if (data=="2"){
				toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This package has been edited.");
			  	jQuery("#package-name").val("");
			  	jQuery("#package-website").val("");
			  	jQuery("#package-version").val("");
			  	jQuery("#package-dependency").val("");
			  	jQuery("#package-code").val("");
			  	jQuery("#package-description").val("");
			  	jQuery("[data-url='../subPages/packageList.php']").click();
			}
		  },
		  error: function(xhr, textStatus, errorThrown) {
		  	toastr.options.positionClass="toast-bottom-right";
		    toastr.error("An error occured.");
		  }
		});
		
	});
</script>