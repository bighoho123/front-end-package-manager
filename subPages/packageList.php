<h1>Package List</h1>
<div class="row placeholders">
</div>
<?php 
	include("../include/_conn.php");
	$sql="SELECT * FROM dev_package";
	$result=mysqli_query($db,$sql);
	$allPackages=array();
	while($row=mysqli_fetch_array($result)){
		$allPackages[]=$row;
	}
?>
<table id='package-list' style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Version</th>
			<th>Dependency</th>
			<th style='width:240px;'>Action</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			foreach($allPackages AS $package){
				echo "<tr>";
				echo "<td><a target='_blank' href='".$package['website']."'>".$package['name']."</a> <i class='fa fa-file-text-o hasTooltip' style='cursor:help'></i><div class='tooltipText' style='display:none'>".$package['description']."</div></td>";
				echo "<td>".$package['version']."</td>";
				echo "<td>".$package['dependency']."</td>";
				echo "<td><button type='button' class='btn btn-info edit-package' data-packageid='".$package['id']."'>Edit</button> <button type='button' class='btn btn-info' data-code='".htmlentities($package['code'])."'>Code</button> <button type='button' class='btn btn-danger delete-package' data-packageid='".$package['id']."'>delete</button></td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<script>
	// Initialize the dataTable
	jQuery("#package-list").dataTable({
		bPaginate:false,
		bInfo:false,
		aoColumns:[
			null,
			null,
			null,
			{"bSortable":false}
		]
	});
	// Initialize the qTip
	jQuery(".hasTooltip").each(function(){
		jQuery(this).qtip({
			content:{
				text:jQuery(this).next(".tooltipText"),
				title:"Package Description",
			},
			style:{
				classes:'qtip-bootstrap'
			}
		});
	});
	// Bind the Edit Event
	jQuery(".edit-package").click(function(event) {
		var packageId=jQuery(this).data('packageid');
		var url="../subPages/addPackage.php";
		jQuery("#result-panel").html("<div style='text-align:center'><i class='fa fa-refresh fa-spin fa-5x' style='margin-top:200px'></i></div>");
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: {packageId: packageId},
		  success: function(data, textStatus, xhr) {
		    jQuery("#result-panel").html(data);
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    jQuery("#result-panel").html("<div style='text-align:center;margin-top:200px'><p class='text-danger'>There's error when loading...</p></div>");
		  }
		});
		jQuery("[data-url]").removeClass('active');
		jQuery("#menu-edit-package").addClass('active');
		
	});
	// Bind the Show Code Event
	jQuery("[data-code]").click(function(event) {
		var code=jQuery(this).data('code');
		copyToClipboard(code);
	});
	function copyToClipboard(text) {
	  window.prompt("Please insert the following code to your page...", text);
	}
	// Bind the Delete Event
	jQuery(".delete-package").click(function(event) {
		var packageId=jQuery(this).data('packageid');
		var url="../widgetFunctions/deletePackage.php";
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: {packageId: packageId},
		  success: function(data, textStatus, xhr) {
		  	if (data==1){
			    toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This package has been deleted.");
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