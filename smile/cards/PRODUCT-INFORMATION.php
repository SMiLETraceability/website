<div class="panel panel-default">
    <div class="panel-heading">
    <?php if ($page === "item") { ?>
       <h4>Product Information  <a href="product.php?prodid=<?php echo $data_arr->{'product'}->{'id'}; ?>" class="btn btn-info btn-sm pull-right" style="margin-left: 5px;">View Product</a> <a href="product-update.php?prodid=<?php echo $data_arr->{'product'}->{'id'}; ?>" class="btn btn-warning btn-sm pull-right">Update Product</a>&nbsp;&nbsp;</h4>
    <?php } else { ?>   
    <h4>Product Information</h4> 
    <?php } ?> 
    </div>
	<div class="panel-body">
		<?php if ($page === "product") { ?>
		   <h4><?php echo $data_arr->{'fn'}; ?></h4>
		<?php } else { ?>   
		   <h4><?php echo $data_arr->{'product'}->{'fn'}; ?></h4>
		<?php } ?>
		
		<div id="bdesc-txt">
		<?php if ($page === "product") { ?>
		   <p><?php echo $data_arr->{'description'}; ?></p>
		<?php } else { ?>   
		   <p><?php echo $data_arr->{'product'}->{'description'}; ?></p>
		<?php } ?>
		
		
		<?php if ($page === "product") { ?>
		   <p><strong>Website: </strong><?php echo $data_arr->{'url'}; ?></p>
		<?php } else { ?>   
		   <p><strong>Website: </strong><?php echo $data_arr->{'product'}->{'url'}; ?></p>
		<?php } ?>
				
		<?php if ($page === "product") { ?>
		   <p><strong>Price: </strong>&pound; <?php echo $data_arr->{'price'}; ?></p>
		<?php } else { ?>   
		   <p><strong>Price: </strong>&pound; <?php echo $data_arr->{'product'}->{'price'}; ?></p>
		<?php } ?>		
		
		</div>
		
	</div>
</div>

