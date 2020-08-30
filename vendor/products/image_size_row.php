<?php
$id = "row" + time();
?>
<div class="row" id="<?php echo $id ?>">
    <div class="form-group col-md-5"> 
        <label for="height[]">Enter Height ( In Inches )  </label>
        <input type="number" id="height" class="form-control img_size" name="height[]" required="" placeholder="Enter Height">
    </div> 

    <div class="form-group col-md-5"> 
        <label for="width[]">Enter Width ( In Inches )  </label>
        <input type="number" id="width" class="form-control img_size" name="width[]" required="" placeholder="Enter Width">
    </div> 

    <div class="form-group col-md-2"> 
        <label style="color:transparent">.</label> 
        <span type="button" class="btn form-control fa fa-minus-square btn-danger"  style="color:white" onclick="delete_this_row(<?php echo $id ?>)"></span>
    </div> 
</div>