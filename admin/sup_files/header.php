 <?php
 
// session_start();
//error_reporting(0);
include('db.php');

/* if(isset($_POST['save']))
{
  echo $_POST['txtEditor'];
} */




?>


<!--<link href="css/editor.css" type="text/css" rel="stylesheet"/>-->


<style>
.fileinput-button {
    background: none repeat scroll 0 0 #eeeeee;
    border: 1px solid #e6e6e6;
	   
}

.attachment-mail {
    margin-top: 30px;
}
.attachment-mail ul {
    display: inline-block;
    margin-bottom: 30px;
    width: 100%;
}
.attachment-mail ul li {
    float: left;
    margin-bottom: 10px;
    margin-right: 10px;
    width: 150px;
}
.attachment-mail ul li img {
    width: 100%;
}
.attachment-mail ul li span {
    float: right;
}
.attachment-mail .file-name {
    float: left;
}
.attachment-mail .links {
    display: inline-block;
    width: 100%;
}

.fileinput-button {
    float: left;
    margin-right: 4px;
    overflow: hidden;
    position: relative;
}
.fileinput-button input {
    cursor: pointer;
    direction: ltr;
    font-size: 23px;
    margin: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    transform: translate(-300px, 0px) scale(4);
}
.fileupload-buttonbar .btn, .fileupload-buttonbar .toggle {
    margin-bottom: 5px;
}
.files .progress {
    width: 200px;
}
.fileupload-processing .fileupload-loading {
    display: block;
}

/*footer{
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #e0dddd !important;
    color: #040404;
    font-weight: bold;
    font-size: 15px;
    background: #fff;
    padding: 2px 12px;
    display: block;
}*/
</style>



	
<div class="progress" style="width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #004C8C;
   z-index: 9045;
   text-align: center;
   display:none;">
   
   <div style="position: relative; width: 100%;">
   <img src="images/loader.gif" style="margin-top:18%;">
   </div>
</div>



<div class="modal fade" id="reload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body">
				  <!-- passing value form script-->
				  Are You Sure, Do You Want to Refresh Database !!
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
		  
		  	<input type="button" class="btn btn-primary"  value="YES" onclick="yes();" />
		  	<input type="button" class="btn btn-primary"  value="NO" data-dismiss="modal"/>
		  </div>
    </div>
  </div>
</div>
	
	
<div class="modal fade" id="commondelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body">
				  <!-- passing value form script-->
				  Are You Sure To Delete This Record !!
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
		  
		  <div id="seldelete"></div>
		  	<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>
	
	
	
 <div class="modal fade" id="commondialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="getCode">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="msg_box" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
		<div class="modal-header">
			<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			<div class="col-md-6">
				<h4 class="modal-title" id="gridModalLabel">New Message</h4>
			</div>
			
			<div class="col-md-6">
				<button type="button" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
				<button type="button" onclick="get_data();" class="btn btn-primary pull-right">Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
			</div>
			
		</div>
		<div class="modal-body">
		<form class="form-horizontal" id="form_data_admin" role="form" method="post" action="#">
			<input type="hidden" name="admin_email" id="admin_email" value="<?php echo $off_email;?>" />
           <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">To :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="email" id="to" name="to" placeholder="To" class="form-control">
            </div>
          </div>
		  
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Data Link :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" id="data_link" name="data_link" placeholder="Paste the link here." class="form-control">
            </div>
          </div>
          
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Subject :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" id="subject" name="subject" placeholder="Subject" class="form-control">
            </div>
          </div>
		  
		   <div class="form-group">
			   <label class="col-md-2 col-sm-2 control-label" for="textinput">Message :</label>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<div  style="width:100%;height: 200px; overflow:scroll;">
				  <!-- <textarea placeholder="Message" name="area3" style="width: 100% !important; height:200px;"></textarea>-->
				  <textarea name="textarea11" id="textarea11" class="form-control" cols="50" style="height: 200px !important;width:680px;"></textarea>
					
					</div>
				</div>
           </div>
		
		</div>
		<div class="modal-footer">
		<button type="button" onclick="get_data();" class="btn btn-primary">Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
			<!--<input type="reset" class="btn btn-warning" value="Reset" >-->
			
		</div>
		 </form>
    </div>
  </div>
</div>


 <!-- top navigation -->
        <div class="top_nav hidden-print">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
               <!-- <a href="<?php //echo $_SERVER['REQUEST_URI']; ?>">sd</a>-->
				
              </div>
			  
			   <ul class="nav navbar-nav hidden-xs">
                    <!--<li><a href="javascript:void(0);" onclick="toggleFullScreen();">	<i class="fa fa-expand"></i>  </a></li>-->
					<!--<li><a href="index.php">	<i class="fa fa-home fa-5x"></i>  </a></li>-->
					<!-- <li> <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-lg">	<i class="fa fa-envelope fa-5x"></i>  </a> </li> -->
				</ul>	

              <ul class="nav navbar-nav navbar-right">
                <li class="">
				<?php 
				if(($ad_profile_img)=='')
				{?>
					 <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/1.jpg" alt=""> <b><?php echo $ad_email;?> </b> &nbsp;
                    <span class=" fa fa-angle-down"></span>
                  </a>
				 <?php 
				}
				else
				{?>
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $ad_profile_img; ?>" alt="" style="border:1px solid black;"> <b><?php echo $ad_email;?> </b> &nbsp;
                    <span class=" fa fa-angle-down"></span>
                  </a>
				<?php
				}
				?>
				
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li> <a href="profile.php"><i class="fa fa-user  pull-right"></i> Profile</a></li>
					<li class="hidden-lg hidden-md"> <a href="index.php">	<i class="fa fa-home  pull-right"></i> Home </a> </li>
					<li class="hidden-lg hidden-md"> <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-lg">	<i class="fa fa-envelope  pull-right"></i> Write Mail </a> </li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
		
		
<script>


/* values.push({
    name: "content",
    value: content_val
});
values = jQuery.param(values);

 */

function databaseRefresh(){
	$('#reload').modal({backdrop:'static'});
}


function yes()
{
<?php
	mysql_query('Delete FROM stu_edu_10 WHERE class = 10 and fk_stu_id IN (select id from stu_student where college_id='.$ad_clg_id.')');
	mysql_query('Delete FROM stu_edu_12 WHERE class = 12 and fk_stu_id IN (select id from stu_student where college_id='.$ad_clg_id.')');


	$commonSql_10 = 'INSERT INTO stu_edu_10 SELECT * FROM stu_education WHERE class = 10 and fk_stu_id IN (select id from stu_student where college_id='.$ad_clg_id.')';
	mysql_query($commonSql_10) or die("Error in Selection Query <br> ".$commonSql_10."<br>". mysql_error());

	$commonSql_12 = 'INSERT INTO stu_edu_12 SELECT * FROM stu_education WHERE class = 12 and fk_stu_id IN (select id from stu_student where college_id='.$ad_clg_id.')';
	mysql_query($commonSql_12) or die("Error in Selection Query <br> ".$commonSql_12."<br>". mysql_error());
?>
reload12();
}
 
 
 
function get_data(){
	debugger;
document.getElementById("textarea11").value = "<html><head><title></title><head><body>"+nicEditors.findEditor("textarea11").getContent();
var msg = document.getElementById("textarea11").value;
	//alert(msg);
	var url ='adminreg/send_mail.php';
 	$(".progress").show();
	$.ajax({
			type:'GET',
			url:url,
			data: $("#form_data_admin").serialize(),
			success:function(data){
				//alert(data);
				debugger;
              setTimeout(function(){ 
				$(".progress").hide(); 
				$("#msg_box").hide();
				$("#getCode").html(data);
			    $("#commondialog").modal();
				}, 3000); 
				
			}  
		});

	}
	
function reload12()
{	// <!-- function is call to header.php (Bootstrap model popup)-->
	window.location='index.php';

}

</script>		
