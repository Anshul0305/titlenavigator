<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>STORE - Title Navigator</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  </head>
  <body style="background-color:mediumaquamarine">

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12" >
			<div class="text-center" style="color:blue">
			<h3>
				Title Navigator - Version 1.1
			</h3>
				</br></br>
			</div>
			<form action="/titlenavigator" method="GET" id="TitleForm" class="form-horizontal" role="form">
				<div class="form-group">
					 
					<label for="inputTitleId" class="col-sm-1 control-label">
						Title Crid:
					</label>
					<div class="col-sm-8">
						<input id="crid" value="crid%3A%2F%2Fbbc.co.uk%2Fprogrammes%2F"  name="crid" type="text" class="form-control">
					</div>
					
					<div class="col-sm-2">
						 
						<button type="submit" class="btn btn-default">
							Find Details
						</button>
					</div>
					
				</div>
			
			</form>
			
			</br></br>
			
			
			
<!-- 			 <a id="modal-150869" href="#modal-container-150869" role="button" class="btn" data-toggle="modal">Launch demo modal</a> -->
			
			<div class="modal fade" id="modal-container-150869" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
							<h4 class="modal-title" id="myModalLabel">
								Modal title
							</h4>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Close
							</button> 
							<button type="button" class="btn btn-primary">
								Save changes
							</button>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>
	<div class="row">
		<?php 
		include 'ChromePhp.php';
		$crid = $_GET["crid"];
		if($crid=="")
		$crid="abcd";
		$json =  file_get_contents("https://api.store.bbc.com/store-gateway/v1/products/titles/".$crid."?apikey=".file_get_contents("apikey.txt"));
		$obj =  json_decode($json);
		$purchasableItems = $obj->product[0]->purchasableItems->purchasableItem;
		?>
		
		
		
		
		</br></br>
		<div id="result" class="col-md-12">
			
					<?php
					if($purchasableItems !=null){
					?>
			<div class="col-sm-12 text-center">
			<h4> <?php echo $obj->product[0]->parentProducts->product[0]->name.": ". $obj->product[0]->name?></h4>
	</br></br>
			</div>
	
			
			
			</br></br>
	
	
	
	<?php
 $array_content_id = [];
	for($i=0; $i<count($purchasableItems); $i++){
						$array_content_id[] = $purchasableItems[$i]->contentId;
	}

	?>
	
	
					<?php
					$i=1;
					if($array_content_id !=null){
						?>

<table class="table">
				<thead>
					<tr>
						<th>
							Content ID ( and Products linked to it )
						</th>
						
						<th>
							Version Type
						</th>
						<th>
							Propagation State
						</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						
					foreach(array_unique($array_content_id) as $cid){
						
				?>		
				
					<tr class="active">
						<td>
						 <?php	echo $i++ .'. ' . $cid; ?>
						</td>
					
						<td>
							<?php 
							  	foreach ($purchasableItems as $pi) {
							if ($pi->contentId == $cid) {
							 	echo $pi->versionTypes;
							 	break;
							}
						}

							?>
						</td>
						<td>
							<?php 
							  	foreach ($purchasableItems as $pi) {
							if ($pi->contentId == $cid) {
							 	echo ($pi->propagationState)?"True":"False";
							 	break;
							}
						}

							?>
						</td>
						</tr>
						<tr><td>
						<table>
							<th>Product Name</th>
							<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<th>Product ID</th>

						<?php foreach($purchasableItems as $pi) {?>
					
							<?php if($pi->contentId == $cid) 
								
							echo "<tr><td>".  $pi->name .' </td><td></td><td> <font color="brown">'.$pi->productId .'</font> ' . "</td></tr>";
							
							?>
						
						<?php } ?>
					
						</table>
						</td></tr>
					<?php
					}
						
					}
				else{
						if($_GET["crid"]!=""){
							
						}
				}
					
					?>
					
					
				</tbody>
			</table> 
			
			</br></br></br></br>
		</div>
	

		<h3>All Purchasable Items</h3>
			    <table class="table">
				<thead>
					<tr>
						<th>
							Product Type
						</th>
						<th>
							Product Name
						</th>
						<th>
							Content ID
						</th>
						<th>
							Profile
						</th>
						<th>
							Version
						</th>
					</tr>
				</thead>
				<tbody>
					
					
					<?php
						
					foreach($purchasableItems as $purchasableItem){
						var_dump();
				?>		
				
					<tr class="active">
						<td>
							<?php echo $purchasableItem->qualifier?>
						</td>
						<td>
							<?php echo  $purchasableItem->name ?>
						</td>
						<td>
							<?php echo $purchasableItem->contentId?>
						</td>
						<td>
							<?php echo $purchasableItem->profile?>
						</td>
						<td>
							<?php echo $purchasableItem->versionTypes?>
						</td>
					</tr>
					
					<?php
					}
						
					}
					else{
						if($_GET["crid"]!=""){
							echo "Invalid Data! Please Try Again!";
						}
							
						}
					
					?>
					
					
				</tbody>
			</table> 
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>