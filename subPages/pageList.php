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
			<th style='width:70px;'>Action</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			foreach($allPages AS $page){
				echo "<tr>";
				echo "<td>".$page['name']." <i class='fa fa-file-text-o hasTooltip' style='cursor:help'></i><div class='tooltipText' style='display:none'>".$page['note']."</div></td>";
				echo "<td>".$page['path']."</td>";
				echo "<td><button type='button' class='btn btn-info' data-pageid='".$page['id']."'>Edit</button></td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<script>
	// Initialize the dataTable
	jQuery("#page-list").dataTable({
		bPaginate:false,
		bInfo:false,
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
	jQuery("[data-pageid]").click(function(event) {
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
</script>