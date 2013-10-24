<?php
session_start();
include "includes/lib/db_connect.php";
include("includes/lib/class.paging.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TASK MANAGER SYSTEM</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/jquery.swfupload.js"></script>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(function(){
		jQuery('#swfupload-control').swfupload({
			upload_url: "upload-file.php",
			post_params: {
			"PHPSESSID" : "<?php echo session_id(); ?>",
			"PHPSESSNAME": "<?php echo session_name(); ?>",
			"propiedad_id": "<?php echo "1"; ?>",
			"principal": "1"
			},
			file_post_name: 'uploadfile',
			file_size_limit : "202400",
			file_types : "*.rar;*.zip;*.pdf;*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : 75,
			flash_url : "js/swfupload/swfupload.swf",
			button_image_url : 'js/swfupload/wdp_buttons_upload_114x29.png',
			button_width : 114,
			button_height : 29,
			button_placeholder : jQuery('#button')[0],
			debug: true
		})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			jQuery('#log').append(listitem);
			jQuery('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = jQuery.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				jQuery('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			jQuery(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			jQuery('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			jQuery('#log li#'+file.id).find('p.status').text('Uploading...');
			jQuery('#log li#'+file.id).find('span.progressvalue').text('0%');
			jQuery('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			jQuery('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			jQuery('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=jQuery('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="../task_manage/files/'+ file.name+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			jQuery(this).swfupload('startUpload');
		});
		
		jQuery('#swfupload-controla').swfupload({
			upload_url: "upload-file.php",
			post_params: {
			"PHPSESSID" : "<?php echo session_id(); ?>",
			"PHPSESSNAME": "<?php echo session_name(); ?>",
			"propiedad_id": "<?php echo "2"; ?>",
			"principal": "1"
			},
			file_post_name: 'uploadfile',
			file_size_limit : "202400",
			file_types : "*.rar;*.zip;*.pdf;*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : 75,
			flash_url : "js/swfupload/swfupload.swf",
			button_image_url : 'js/swfupload/wdp_buttons_upload_114x29.png',
			button_width : 114,
			button_height : 29,
			button_placeholder : jQuery('#buttona')[0],
			debug: false
		})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			jQuery('#loga').append(listitem);
			jQuery('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = jQuery.swfupload.getInstance('#swfupload-controla');
				swfu.cancelUpload(file.id);
				jQuery('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			jQuery(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			jQuery('#queuestatusa').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			jQuery('#loga li#'+file.id).find('p.status').text('Uploading...');
			jQuery('#loga li#'+file.id).find('span.progressvalue').text('0%');
			jQuery('#loga li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			jQuery('#loga li#'+file.id).find('div.progress').css('width', percentage+'%');
			jQuery('#loga li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=jQuery('#loga li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="../task_manage/files/'+ file.name+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			jQuery(this).swfupload('startUpload');
		});
		
		jQuery('#swfupload-controlb').swfupload({
			upload_url: "upload-file.php",
			post_params: {
			"PHPSESSID" : "<?php echo session_id(); ?>",
			"PHPSESSNAME": "<?php echo session_name(); ?>",
			"propiedad_id": "<?php echo "3"; ?>",
			"principal": "1"
			},
			file_post_name: 'uploadfile',
			file_size_limit : "202400",
			file_types : "*.rar;*.zip;*.pdf;*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : 75,
			flash_url : "js/swfupload/swfupload.swf",
			button_image_url : 'js/swfupload/wdp_buttons_upload_114x29.png',
			button_width : 114,
			button_height : 29,
			button_placeholder : jQuery('#buttonb')[0],
			debug: false
		})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			jQuery('#logb').append(listitem);
			jQuery('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = jQuery.swfupload.getInstance('#swfupload-controlb');
				swfu.cancelUpload(file.id);
				jQuery('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			jQuery(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			jQuery('#queuestatusb').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			jQuery('#logb li#'+file.id).find('p.status').text('Uploading...');
			jQuery('#logb li#'+file.id).find('span.progressvalue').text('0%');
			jQuery('#logb li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			jQuery('#logb li#'+file.id).find('div.progress').css('width', percentage+'%');
			jQuery('#logb li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=jQuery('#logb li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="../task_manage/files/'+ file.name+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			jQuery(this).swfupload('startUpload');
		});
	
		});	
		</script>       
		<style type="text/css" >
		#swfupload-control p{ margin:10px 5px; font-size:0.9em; }
		#log{ margin:0; padding:0; width:500px;}
		#log li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
			font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
		#log li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
		#log li .progress{ background:#999; width:0%; height:5px; }
		#log li p{ margin:0; line-height:18px; }
		#log li.success{ border:1px solid #339933; background:#ccf9b9; }
		#log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; 
			background:url('js/swfupload/cancel.png') no-repeat; cursor:pointer; }
			
		#swfupload-controla p{ margin:10px 5px; font-size:0.9em; }
		#loga{ margin:0; padding:0; width:500px;}
		#loga li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
			font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
		#loga li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
		#loga li .progress{ background:#999; width:0%; height:5px; }
		#loga li p{ margin:0; line-height:18px; }
		#loga li.success{ border:1px solid #339933; background:#ccf9b9; }
		#loga li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; 
			background:url('js/swfupload/cancel.png') no-repeat; cursor:pointer; }
			
		#swfupload-controlb p{ margin:10px 5px; font-size:0.9em; }
		#logb{ margin:0; padding:0; width:500px;}
		#logb li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
			font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
		#logb li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
		#logb li .progress{ background:#999; width:0%; height:5px; }
		#logb li p{ margin:0; line-height:18px; }
		#logb li.success{ border:1px solid #339933; background:#ccf9b9; }
		#logb li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; 
			background:url('js/swfupload/cancel.png') no-repeat; cursor:pointer; }
		#preview{
			position:absolute;
			border:1px solid #ccc;
			background:#333;
			padding:5px;
			display:none;
			color:#fff;
		}
		</style>

<script src="js/popup.js"></script>
<script src="js/main.js" type="text/javascript"></script>
<script language="javascript">	
	var $j=jQuery.noConflict();	
			
	
	  
	$j(document).ready(function(){
		$j('#add_comment').click(function(){
			$j('#new_comment').fadeIn("slow");
		});
		$j('#print_work_order_detail').click(function(){
			var order_id = $j('#work_order_id').val();
			w = window.open('work_order_detail_print.php?order_id='+order_id,'print');						
		});
		$j('#insert').click(function(){
			if($j('#description').val()==""){alert("input comment!"); return false;}
			else{
				var ssw="description="+$j('#description').val()+"&oid="+$j('#order_id').val();
				$j.ajax({
					type : "POST",
					url : "ajaxprocess/add_comment.php",
					data : ssw,
					success : function(msg){
						window.location = window.location;
					}
				});
			}
		});
		imagePreview();
	});
	
	
	function complete_file(s){	
		var r=confirm("Are you sure you've completed this work order?");
		if(r==true){
			var sss="order_id="+s;
			$j.ajax({
				type : "POST",
				url : "ajaxprocess/complete_work.php",
				data : sss,
				success : function(msg){
					var id="results";
					document.getElementById(id).innerHTML= msg;			
				}
			});
			return true;
		}else{
			return false;
		}
	}
</script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/autoExpandContract.js" type="text/javascript"></script>
<script type="text/javascript">
	document.observe('dom:loaded', function() {  
		$$('.highlight').each(function(item) {
			item.observe('focus', function(){
				item.style.backgroundColor = "#FDFFDE";  
			});  
			item.observe('blur', function(){   
				item.style.backgroundColor = "#ffffff";  
			});               
		});
	});
	function delete_file(){
		var r = confirm("Do you want to delete it?");
		if(r==true){		
			return true;
		}else
			return false;
	}
</script>
</head>
<body style="">
<center>
	
	<div style="height:10px"></div>
    <b style="color:red;">Please leave comments in the work order comments section below. We need to know about work order status, property conditions, damages, etc. It is mandatory that you provide us with property condition UPDATES prior to closing out any this work order.</b>
	<div class="main_div" style="border:5px solid black; width:650px; height:auto; min-height:500px; background-color:white">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?order_id=<?php echo $_REQUEST['order_id'];?>" method="post" enctype="multipart/form-data" id="subform">
    	<div class="dashboard_pane" style="width:93%; margin-top:10px;">
	        <input type="hidden" name="work_order_id" id="work_order_id" value="<?php echo $_REQUEST['order_id']; ?>" />
        	<div class="dashboard"><input type="button" name="print_this_page" value="PRINT" id="print_work_order_detail" class="buttontype" /></div>
            <div class="dashboard" style="margin-left:20px;"><input type="button" name="sasa" value="HOME" class="buttontype" onclick="document.location='index.php'" /></div>            <div class="dashboard" style="float:right; color:red"><?php if($sitecontent['completed_date']!="0000-00-00 00:00:00") echo "This work order was complete on ".date("m-d-Y",strtotime($sitecontent['completed_date']))  ?></div>            
            <div class="dashboard" style="margin-left:20px; color:blue" id="results"></div>
        </div>
        <div class="clear"></div>
        <div class="dashboard_pane" align="left" style="width:89%; line-height:13px; margin-top:10px; border:3px solid black; padding:25px; min-height:500px; margin-bottom:10px;">
        	<p>Work Order #: <?php echo $sitecontent['id'];  ?></p><br />
            <p>Order Date: <?php echo date("m-d-Y",strtotime($sitecontent['order_date'])); ?></p><br />
            <p>Due Date: <?php echo date("m-d-Y",strtotime($sitecontent['due_date'])); ?></p><br />
            <p>Client Name: <?php echo $sitecontent['client_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;Lock box code: <?php echo $sitecontent['lock_box_code']; ?></p><br />
            <div>
    	    	<div class="dashboard"></div>
                <div class="dashboard" style="margin-left:10px">
                	<p>Street: <?php echo $sitecontent['street'];?></p><br />
                    <p>City: <?php $state = $db->get_user_state($sitecontent['zip_order']);  echo $state['city']." ,".$state['state_abbr'];?></p><br />
                    <p style="">Zipcode: <?php echo $sitecontent['zip_order']; ?>
                    </p> <br />
                </div>
	        </div><div class="clear"></div>
            <p style="margin-top:15px;">Vendor: 
            	<?php if($sitecontent['vendor_id']==0) echo"unassigned"; else {echo $db->get_user_name($sitecontent['vendor_id']);}?>
            </p>
            <p style="margin-top:15px;">Work Order Details:             	
				<?php echo $db->get_order_detail_info($sitecontent['work_order_details_id']); ?></option>                
                </select>
                &nbsp;&nbsp;&nbsp;Price: $<?php echo $sitecontent['price']; ?>
                <?php if($_SESSION['usertype']==1){?><br /> <br />Total Price To Payout: $<?php echo $sitecontent['total_price']; }?> 
            </p>
            <p style="margin-top:15px;">            
            <textarea type='text' id="comment" class="highlight expand demoTextarea" style="width:95%; padding:10px; height:100%; background-color:white; color:black" disabled="disabled">            	<?php echo $sitecontent['description']; ?>                
            </textarea>            
            </p>                    
                 
    </form>
     <div class="clear"></div>
                <div style="margin:20px auto;" align="center">
                    <a href="#" class="buttontype" style="text-decoration:none;" onclick="complete_file(<?php echo $_REQUEST['order_id']; ?>)"/>CLICK HERE TO FILE AS COMPLETED</a>
                </div>
    </div>
</center>
<div style="width:98%; margin:0px auto; " >
	<div style="float:left; width:33%;">
    	<div style="margin-top:30px">
            	<div class="clear"></div>            	
	        	
                <div id="inlineContent" style="display:none; border-radius:15px;" align="center">
                    <a href="work_order_details.php?order_id=<?php echo $_REQUEST['order_id'];?>" style="float:right; position:relative; text-decoration:none; margin-top:-10px;">CloseWindow</a>
                    <div class="clear"></div>
                   
                    <div id="swfupload-control">
                        <p>Upload upto 75 image files(jpg, png, gif) and zip files(rar,zip) and (pdf), each having maximum size of 200MB</p>
                        <input type="button" id="button" />
                        <p id="queuestatus" ></p>
                        <ol id="log"></ol>
                    </div>
		
            	</div>
           
            </div>
            <div class="clear"></div>
            <div style="margin-top:10px">            	
                 	<div style="width:98%; border:2px solid black; height:auto">
                	<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:20px; color:blue; font-weight:bold;" align="center">
                    	<a href="#inlineContent" class="defaultDOMWindow" style="font-weight:bold; font-size:20px; text-decoration:none" >Upload Before Images</a>
						<div class="clear"></div>
						<?php if($_SESSION['usertype']==1) {?><a href="delete_all_files.php?f_type=1&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete All Files</a><?php }?>
                    </h2>

                     <script type="text/javascript"> 
						$j('.defaultDOMWindow').openDOMWindow({ 
							eventType:'click', 
							loader:1, 
							loaderImagePath:'images/animationProcessing.gif',
							windowBGColor:'#FFF',
							borderColor:'#FFF',
							loaderHeight:20, 
							loaderWidth:17,
							width:900,
							height:1000,
							modal:1
						});       
					</script>
					<div class="clear"></div>
                    <div style="width:100%;">
                    <?php $allfile=$db->get_file_info($_REQUEST['order_id']);
						foreach($allfile as $item){
							if($item['f_type']!=1) continue;				
					?>
                    <div id="file_<?php echo $item['id'];?>" style="font-size:18px; width:32%; text-align:center; margin-left:1%; float:left; font-family:Verdana, Geneva, sans-serif; color:black; font-weight:bold;">
                    	<?php 
							if(get_file_extension($item['file_name'])=="rar" ) 
								echo '<a href="img/WinRAR.png" class="preview" target="_blank"><img src="img/WinRAR.png" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="zip")
								echo '<a href="img/zip.gif" class="preview" target="_blank"><img src="img/zip.gif" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="pdf")
								echo '<a href="img/pdf.gif" class="preview" target="_blank"><img src="img/pdf.gif" width="60" height="60"/></a>';
							else{
								$temp_url="";
								if($item['id']<7696) $temp_url = "../task_manage/files/"; else $temp_url = "./files/";
								
								echo '<a href="'.$temp_url.$item['file_name'].'" class="preview" target="_blank"><img src="'.$temp_url.$item['file_name'].'" width="60" height="60"/></a>';
							}
						?>
                        
                        <a href="<?php if($item['id']<7696) echo "../task_manage/files/"; else echo "./files/"; ?><?php echo $item['file_name']; ?>" style="text-decoration:none; text-align:left; font-size:8px;" target="download"><?php echo $item['file_name']?></a>
                        
                        
                        <?php if($_SESSION['usertype']==1) {?><a href="password_asking_file.php?f_id=<?php echo $item['id']; ?>&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete File</a><?php }?>
                    </div>
                    <?php }?>
                    <div class="clear"></div>
                    </div>
                    </div>          
            </div>
        </div>   
    </div>
    <div style="float:left; width:33%;">
    	<div style="margin-top:30px">
            	<div class="clear"></div>            	
	        	
                <div id="inlineContenta" style="display:none; border-radius:15px;" align="center">
                    <a href="work_order_details.php?order_id=<?php echo $_REQUEST['order_id'];?>" style="float:right; position:relative; text-decoration:none; margin-top:-10px;">CloseWindow</a>
                    <div class="clear"></div>
                   
                    <div id="swfupload-controla">
                        <p>Upload upto 75 image files(jpg, png, gif) and zip files(rar,zip) and (pdf), each having maximum size of 200MB</p>
                        <input type="button" id="buttona" />
                        <p id="queuestatusa" ></p>
                        <ol id="loga"></ol>
                    </div>
		
            	</div>
            
            </div>
            <div class="clear"></div>            
            <div style="margin-top:10px">   
            	<div style="width:98%; border:2px solid black; height:auto">
                	<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:20px; color:blue; font-weight:bold;" align="center">                    	         	         
						<a href="#inlineContenta" class="defaultDOMWindowa" style="font-weight:bold; font-size:20px; text-decoration:none" >Upload During Images</a>
						<div class="clear"></div>
						<?php if($_SESSION['usertype']==1) {?><a href="delete_all_files.php?f_type=2&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete All Files</a><?php }?>
					
                   	</h2>
                    <script type="text/javascript"> 
						$j('.defaultDOMWindowa').openDOMWindow({ 
							eventType:'click', 
							loader:1, 
							loaderImagePath:'images/animationProcessing.gif',
							windowBGColor:'#FFF',
							borderColor:'#FFF',
							loaderHeight:20, 
							loaderWidth:17,
							width:900,
							height:1000,
							modal:1
						});       
					</script>
                                    	
                    <div style="width:100%;">
                    <?php $allfile=$db->get_file_info($_REQUEST['order_id']);
						foreach($allfile as $item){
							if($item['f_type']!=2) continue;				
					?>
                    
                    <div id="file_<?php echo $item['id'];?>" style="font-size:18px; width:32%; text-align:center; margin-left:1%; float:left; font-family:Verdana, Geneva, sans-serif; color:black; font-weight:bold;">
                    	<?php 
							if(get_file_extension($item['file_name'])=="rar" ) 
								echo '<a href="img/WinRAR.png" class="preview" target="_blank"><img src="img/WinRAR.png" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="zip")
								echo '<a href="img/zip.gif" class="preview" target="_blank"><img src="img/zip.gif" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="pdf")
								echo '<a href="img/pdf.gif" class="preview" target="_blank"><img src="img/pdf.gif" width="60" height="60"/></a>';
							else{
								$temp_url="";
								if($item['id']<7696) $temp_url = "../task_manage/files/"; else $temp_url = "./files/";
								
								echo '<a href="'.$temp_url.$item['file_name'].'" class="preview" target="_blank"><img src="'.$temp_url.$item['file_name'].'" width="60" height="60"/></a>';
							}
						?>
                        
                        <a href="<?php if($item['id']<7696) echo "../task_manage/files/"; else echo "./files/"; ?><?php echo $item['file_name']; ?>" style="text-decoration:none; text-align:left; font-size:8px;" target="download"><?php echo $item['file_name']?></a>
                        
                        
                        <?php if($_SESSION['usertype']==1) {?><a href="password_asking_file.php?f_id=<?php echo $item['id']; ?>&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete File</a><?php }?>
                    </div>
                    <?php }?>
                    <div class="clear"></div>
                    </div>
                    </div> 
                               
            </div>
        </div>   
    </div>
    <div style="float:left; width:33%;">
    	<div style="margin-top:30px">
            	<div class="clear"></div>            	
	        	
                <div id="inlineContentb" style="display:none; border-radius:15px;" align="center">
                    <a href="work_order_details.php?order_id=<?php echo $_REQUEST['order_id'];?>" style="float:right; position:relative; text-decoration:none; margin-top:-10px;">CloseWindow</a>
                    <div class="clear"></div>
                   
                    <div id="swfupload-controlb">
                        <p>Upload upto 75 image files(jpg, png, gif) and zip files(rar,zip) and (pdf), each having maximum size of 200MB</p>
                        <input type="button" id="buttonb" />
                        <p id="queuestatusb" ></p>
                        <ol id="logb"></ol>
                    </div>
		
            	</div>            
            </div>
            <div class="clear"></div>
            <div style="margin-top:10px">            	
            	<div style="width:98%; border:2px solid black; height:auto">
                	<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:20px; color:blue; font-weight:bold;" align="center">
                <a href="#inlineContentb" class="defaultDOMWindowb" style="font-weight:bold; font-size:20px; text-decoration:none" >Upload After Images</a>
					<div class="clear"></div>
						<?php if($_SESSION['usertype']==1) {?><a href="delete_all_files.php?f_type=3&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete All Files</a><?php }?>
                	</h2>
                    <script type="text/javascript"> 
						$j('.defaultDOMWindowb').openDOMWindow({ 
							eventType:'click', 
							loader:1, 
							loaderImagePath:'images/animationProcessing.gif',
							windowBGColor:'#FFF',
							borderColor:'#FFF',
							loaderHeight:20, 
							loaderWidth:17,
							width:900,
							height:1000,
							modal:1
						});       
					</script>                	
                    <div class="clear"></div>
                    <div style="width:100%;">
                    <?php $allfile=$db->get_file_info($_REQUEST['order_id']);
						foreach($allfile as $item){
							if($item['f_type']!=3) continue;				
					?>
                    <div id="file_<?php echo $item['id'];?>" style="font-size:18px; width:32%; text-align:center; margin-left:1%; float:left; font-family:Verdana, Geneva, sans-serif; color:black; font-weight:bold;">
                    	<?php 
							if(get_file_extension($item['file_name'])=="rar" ) 
								echo '<a href="img/WinRAR.png" class="preview" target="_blank"><img src="img/WinRAR.png" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="zip")
								echo '<a href="img/zip.gif" class="preview" target="_blank"><img src="img/zip.gif" width="60" height="60"/></a>'; 
							elseif(get_file_extension($item['file_name'])=="pdf")
								echo '<a href="img/pdf.gif" class="preview" target="_blank"><img src="img/pdf.gif" width="60" height="60"/></a>';
							else{
								$temp_url="";
								if($item['id']<7696) $temp_url = "../task_manage/files/"; else $temp_url = "./files/";
								
								echo '<a href="'.$temp_url.$item['file_name'].'" class="preview" target="_blank"><img src="'.$temp_url.$item['file_name'].'" width="60" height="60"/></a>';
							}
						?>
                        
                        <a href="<?php if($item['id']<7696) echo "../task_manage/files/"; else echo "./files/"; ?><?php echo $item['file_name']; ?>" style="text-decoration:none; text-align:left; font-size:8px;" target="download">
							<?php echo $item['file_name']?>
                        </a>
                        
                        
                        <?php if($_SESSION['usertype']==1) {?><a href="password_asking_file.php?f_id=<?php echo $item['id']; ?>&order_id=<?php echo $_REQUEST['order_id']; ?>" onclick="return delete_file();" style="color:red; text-decoration:none">Delete File</a><?php }?>
                    </div>
                    <?php }?>
                    <div class="clear"></div>
                    </div>
	            </div>                                
            </div>            
        </div>        
    </div>
    <div class="clear"></div>
    <div style="width:94%; border:2px solid black; padding:2%; margin:0px auto; min-height:100px; ">
    <table cellpadding="0" cellspacing="0" id="comment_table">
    	<tr>
            <td><input type="button" id="add_comment" value="Add comment"/></td>
            <td><input type="hidden" id="order_id" value="<?php echo $_GET['order_id']; ?>" /></td>
            <td></td>
        </tr>
        <tr><th colspan="3"><b style="color:black;">Comments</b></th></tr>
        <tr style="display:none" id="new_comment">
            <td><textarea id="description"></textarea></td>
            <td valign="top"><input type="button" id="insert" value="Insert"/></td>
            <td></td>
        </tr>
        <?php $allcomment=$db->get_comment_info($_REQUEST['order_id']);
            foreach($allcomment as $item){
        ?>
        <tr>       
            <td><p style="color:black; font-family:Verdana, Geneva, sans-serif; font-size:16px;"><?php echo $item['description']; ?></p></td>
            <td><p style="color:black; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#666; font-weight:bold"><?php $user_data = $db->get_vender_info($item['user_id']); if($item['user_id']==1) echo'FSS ADMIN'; else echo $user_data['realname']; ?></p></td>
            <td><p style="color:black; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#666; font-weight:bold"><?php echo date("m-d-Y",strtotime($item['date_time'])); ?></p></td>
        </tr>
        <?php }?>
    </table>
    </div>    
</div>
<div class="clear"></div>
<div style="height:300px"></div>
</body>
</html>