<?php
	include("../include/_conn.php");
	$pageId=isset($_POST['pageId'])?$_POST['pageId']:"";

	$name="";
	$path="";
	$note="";
	if ($pageId!=""){
		$sql="SELECT * FROM dev_page WHERE id=$pageId";
		$result=mysqli_query($db,$sql);
		while($row=mysqli_fetch_array($result)){
			extract($row);
		}
	}

?>
<?php if ($pageId=="") { ?>
<h1>Add a Page</h1>
<?php } else { ?>
<h1>Edit a Page</h1>
<?php } ?>
<div class="row placeholders">
</div>
<form class="form-horizontal" id='add-page-form'>
	<fieldset>
		<legend>Page Info</legend>
		<div class="form-group">
			<label for='page-name' class='col-lg-2 control-label'>Name</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='name' id='page-name' placeholder='Page Name...' value="<?php echo $name ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='page-path' class='col-lg-2 control-label'>Path</label>
			<div class="col-lg-8">
				<input type="text" class='form-control' name='path' id='page-path' placeholder='Page Path...'  value="<?php echo $path ?>">
			</div>
		</div>
		<div class="form-group">
			<label for='page-note' class='col-lg-2 control-label'>Note</label>
			<div class="col-lg-8">
				<textarea class="form-control" rows="5" name='note' id="page-note" placeholder='Anything about this page...'><?php echo $note; ?></textarea>
			</div>
		</div>
		<div class='col-lg-10'><hr></div>
		<div class="form-group">
	      <div class="col-lg-2 col-lg-offset-9">
	        <button type="submit" class="btn btn-primary" id='add-page-form-submit'>Submit</button>
	      </div>
	    </div>
	    <input type='hidden' name='pageId' value="<?php echo $pageId ?>">
	</fieldset>
</form>


<script type="text/javascript">
	jQuery("#add-page-form-submit").click(function(event) {
		event.preventDefault();
		var url='../widgetFunctions/addPage.php';
		var data=jQuery("#add-page-form").serialize();
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: data,
		  success: function(data, textStatus, xhr) {
		  	if (data=="1"){
			  	toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This page has been added.");
			  	jQuery("#page-name").val("");
			  	jQuery("#page-path").val("");
			  	jQuery("#page-note").val("");
			} else if (data=="2"){
				toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This page has been edited.");
			  	jQuery("#page-name").val("");
			  	jQuery("#page-path").val("");
			  	jQuery("#page-note").val("");
			  	jQuery("[data-url='../subPages/pageList.php']").click();
			}
		  },
		  error: function(xhr, textStatus, errorThrown) {
		  	toastr.options.positionClass="toast-bottom-right";
		    toastr.error("An error occured.");
		  }
		});
		
	});
</script>