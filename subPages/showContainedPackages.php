<?php 
  include("../include/_conn.php");
  $pageId=isset($_POST['pageId'])?$_POST['pageId']:"";
?>
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalLabel">Packages Used</h4>
      </div>
      <div class="modal-body">
        <select class='selectize' multiple data-placeholder="Contained packages...">

        <?php 
            $sql="SELECT packageIds FROM dev_page WHERE id=$pageId";
            $result=mysqli_query($db,$sql);
            $packages=array();
            $packageSQL="";
            while($row=mysqli_fetch_array($result)){
                $packages=explode(",",$row['packageIds']);
            }
            $sql_pkg="SELECT name, id FROM dev_package";
            $res_pkg=mysqli_query($db,$sql_pkg);
            $allPackages=array();
            while($row_pkg=mysqli_fetch_array($res_pkg)){
                $allPackages[$row_pkg['id']]=$row_pkg['name'];
            }
            foreach($allPackages AS $id => $name){
                $isSelected="";
                if (in_array($id, $packages)){
                  $isSelected=" selected";
                }
                echo "<option value='$id' $isSelected>$name</option>";
            }
        ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary page-package-save">Save changes</button>
      </div>
    </div>
</div>
<script>
    jQuery(".selectize").selectize({
      plugins:['remove_button'],
    });
    // Bind the save event
    jQuery(".page-package-save").click(function(event) {
        var packageArray=jQuery(".selectize")[0].selectize.getValue();
        jQuery.ajax({
          url: '../widgetFunctions/updatePagePackage.php',
          type: 'POST',
          dataType: 'html',
          data: {pageId: '<?php echo $pageId; ?>',packageArray:packageArray},
          success: function(data, textStatus, xhr) {
            if (data=="1"){
                toastr.options.positionClass="toast-bottom-right";
                toastr.success("Change saved...");
                jQuery("#page-package-modal").modal('hide');
            }
          },
        });
        
    });
</script>