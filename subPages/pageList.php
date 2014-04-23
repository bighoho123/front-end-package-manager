<h1>Page List</h1>
<div class="row placeholders">
</div>
<?php 
	include("../include/_conn.php");
	$sql="SELECT * FROM dev_page";
	$result=mysqli_query($db,$sql);
	$allPages=array();
	while($row=mysqli_fetch_array($result)){
		$allPages[]=$row;
	}
?>
<table id='page-list' style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Path</th>
			<th style='width:100px;'>Package</th>
			<th style='width:170px;'>Action</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			foreach($allPages AS $page){
				echo "<tr>";
				echo "<td>".$page['name']." <i class='fa fa-file-text-o hasTooltip' style='cursor:help'></i><div class='tooltipText' style='display:none'>".$page['note']."</div></td>";
				echo "<td>".$page['path']."</td>";
				echo "<td><button type='button' class='btn btn-info page-package' data-pageid='".$page['id']."'><i class='fa fa-tachometer fa-lg'></i></button></td>";
				echo "<td><button type='button' class='btn btn-info edit-page' data-pageid='".$page['id']."'>Edit</button> <button type='button' class='btn btn-danger delete-page' data-pageid='".$page['id']."'>delete</button></td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<!-- Modal for edit the contained packages-->
<div class="modal fade" id="page-package-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
</div>
<script>
	// Initialize the dataTable
	jQuery("#page-list").dataTable({
		bPaginate:false,
		bInfo:false,
		aoColumns:[
			null,
			null,
			{"bSortable":false},
			{"bSortable":false}
		]

	});
	// Initialize the qTip
	jQuery(".hasTooltip").each(function(){
		jQuery(this).qtip({
			content:{
				text:jQuery(this).next(".tooltipText"),
				title:"Page Note",
			},
			style:{
				classes:'qtip-bootstrap'
			}
		});
	});
	// Bind the Edit Event
	jQuery(".edit-page").click(function(event) {
		var pageId=jQuery(this).data('pageid');
		var url="../subPages/addPage.php";
		jQuery("#result-panel").html("<div style='text-align:center'><i class='fa fa-refresh fa-spin fa-5x' style='margin-top:200px'></i></div>");
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: {pageId: pageId},
		  success: function(data, textStatus, xhr) {
		    jQuery("#result-panel").html(data);
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    jQuery("#result-panel").html("<div style='text-align:center;margin-top:200px'><p class='text-danger'>There's error when loading...</p></div>");
		  }
		});
		jQuery("[data-url]").removeClass('active');
		jQuery("#menu-edit-page").addClass('active');
		
	});
	// Bind the Delete Event
	jQuery(".delete-page").click(function(event) {
		var pageId=jQuery(this).data('pageid');
		var url="../widgetFunctions/deletePage.php";
		jQuery.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'html',
		  data: {pageId: pageId},
		  success: function(data, textStatus, xhr) {
		  	if (data==1){
			    toastr.options.positionClass="toast-bottom-right";
			  	toastr.success("This page has been deleted.");
			  	jQuery("[data-url='../subPages/pageList.php']").click();
		    }
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    toastr.options.positionClass="toast-bottom-right";
		    toastr.error("An error occured.");
		  }
		});
	});
	// Bind the show packages dialog event
	jQuery(".page-package").click(function(event) {
		var pageId=jQuery(this).data('pageid');
		jQuery.ajax({
		  url: '../subPages/showContainedPackages.php',
		  type: 'POST',
		  dataType: 'html',
		  data: {pageId: pageId},
		  success: function(data, textStatus, xhr) {
		    jQuery("#page-package-modal").html(data).modal();
		  }
		});
		
	});
</script>