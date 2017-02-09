<?php
	//include('head.php');
	session_start();
	include "include/dataaccessclass.php";
	include "include/emailtemplate.php";
	include "include/config.inc.php";
	$var = new DataAccessLayer(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$var->connect();
	$tot = 0;
	$finalTot = 0;
	$insertUpdateStr = "";
	
	// Menu Display Only for Registered User
	if(isset($_SESSION['userid']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['usertype']))
	{
		header("Location: ./myaccount.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <!-- Google font -->
        <link href='css/library/googlefont.css' rel='stylesheet' type='text/css'>
        <!-- End Google Font -->
        <link rel="stylesheet" type="text/css" href="css/library/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/library/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="css/library/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/library/mediaelementplayer.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <!-- Start : Captcha Files -->
        <link href="captcha/css/style.css" rel="stylesheet">
	    
		<!-- End : Captcha Files -->
        
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        
        
        <title>Subscription - Mallipoo.com</title>
    </head>
    <body class="blog">
        <!-- Page wrap -->
        <div id="page-wrap">
            <?php include('menu.php'); ?>
        
            <section class="contact">
                <div class="section-wrap bg-parallax" >
                    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ Start : ViewProduct Div ~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                    <div id="viewProduct" class="enable">
                        <!--- ---------------------- Start : Product View ---------------------- --->
                        <div class="container">
                        	
                        	<form method="post" name="frmDelReq">
                                <div class="viewProduct">
                                  	<div id="distable_div" style="margin-top:50px;">
                                        <div class="table-responsive">
                                        	<div class="row">
                                        		<h1 class="big text-uppercase" style="padding-bottom:10px;margin-top:-10px;">Welcome to Mallipoo Online - <span style="text-transform: none;">Your search for Traditional Flower bliss ends here</span>
                                        		</h1>
                                        		<div  style="float: right;" class="fb-like" data-href="https://www.facebook.com/OfficialMallipoo" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
                                        		<h5 class="small text-italic" style="padding-bottom: 20px;">
												Relax!!! Look no further than the customer friendly, dedicated and committed team here at Mallipoo.com. Located in Banaswadi to the East of Namma Bengaluru, we specialize in delivering splendid quality traditional flowers at your doorstep in and around <span style="font-weight: bold;">BANASWADI</span>,Bengaluru only.
						                        </h5>
                                                <span style="font-size:14px;margin-bottom:10px;">&nbsp;&nbsp;&nbsp;&nbsp;To subscribe to mallipoo service, please fill below form. Please note,service is available only in Banaswadi,Kasturi Nagar,Kalyan Nagar region.</span>
                                            	 <br/><br/><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;To view seasonal product pricing, <a href="./pricing.php" target="_blank" alt="Pricing" style="color:blue;font-weight:bold;">click here</a></span>
                                            </div><br/>  
                                            <?php
                                            
                                            
                                            $selWhere = "status = 0 AND subscribeshow = 'Yes' ORDER by catid ASC";
                                            $selSS = $var->selectWhere("productmst",$selWhere);
                                            $selCC = $var->num_rows($selSS);
                                            if($selCC > 0)
                                            {?>
                                                    <!-- Start : panel panel-info -->
                                                    <div class="panel panel-info">
                                                        <!-- Start : panel-heading -->
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                User Detail
                                                            </h3>
                                                        </div><!-- End : panel-heading -->
                                                        <!-- Start : panel-body -->
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4">
                                                                        <input type="text" placeholder="Enter Name" class="form-control" name="name" id="name">
                                                                        <span style="color:#CC0000;" id="nameError"></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <input type="text" placeholder="Enter Email" class="form-control" name="email" id="email">
                                                                        <span style="color:#CC0000;" id="emailError"></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" placeholder="Enter Phone" class="form-control" name="phone" id="phone">
                                                                        <span style="color:#CC0000;" id="phoneError"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row"><br /><br /></div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <textarea placeholder="Enter Address" class="form-control" name="address" id="address"></textarea>
                                                                        <span style="color:#CC0000;" id="addressError"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- End : panel-body -->
                                                    </div><!-- End : panel panel-info -->													

												<!-- Start : panel panel-info -->
												<div class="panel panel-info" style="margin-top:5px;">
													<!-- Start : panel-heading -->
													<div class="panel-heading">
														<h3 class="panel-title">
															Subscription Detail
														</h3>
													</div><!-- End : panel-heading -->
													<!-- Start : panel-body -->
													<div class="panel-body">
														<div style="font-style: oblique;font-size: 13px;margin-bottom:8px;"><span style="font-weight: bold;color: darkred;">Hint</span> : Enter integer (number) in text box below. Example: "Jasmine Temple Garland" for Monday, enter "1". This imply that you need 1 jasmine garland on Every Monday.</div>
														<table id="example" class="table table-bordered table-condensed checkboxs js-table-sortable">
															<thead>
																<tr class="selectable">
                                                                	<th class="text-center" rowspan="2" valign="middle" style="width:1%">No</th>
																	<th class="text-center" rowspan="2" valign="middle">Flower String Types</th>
                                                                    <th class="text-center" rowspan="2" style="width:12%">Price</th>
																	<th class="text-center" colspan="7" style="text-align:center">No. of Molam/String</th>
                                                                    <th class="text-center" rowspan="2" style="width:10%">Final Price</th>
																</tr>
																<tr class="selectable">
																	<th class="text-center" style="width:7%">Monday</th>
																	<th class="text-center" style="width:7%">Tuesday</th>
																	<th class="text-center" style="width:7%">Wednesday</th>
																	<th class="text-center" style="width:7%">Thursday</th>
																	<th class="text-center" style="width:7%">Friday</th>
																	<th class="text-center" style="width:7%">Saturday</th>
																	<th class="text-center" style="width:7%">Sunday</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$i=1;
																while($selRR = $var->fetch_array($selSS))
																{
																		switch ($selRR['catid'])
																		{
																			case 1: $bgcolor="#78c76b";break;
																			case 2: $bgcolor="#baf5af";break;
																			case 4: $bgcolor="#e7f5af";break;
																			case 5: $bgcolor="#f1d9a4";break;
																			default: $bgcolor="#f1a7a4";break;
																		}
																		?>
                                                                        <tr class="selectable" style="background:<?=$bgcolor;?>">
                                                                        	<td><?php echo $i; ?></td>
                                                                            <td>
                                                                                <?php echo $selRR['name']; ?>
                                                                                <input type="hidden" name="prodid[]" id="prodid" value="<?php echo $selRR['prodid']; ?>" class="form-control" />
                                                                            </td>
                                                                            <td>
																				<?php 
																					$price = $selRR['price'];
																					echo $price;
																					
																					$perPrice = explode("per",$price);
																					$prodPrice = substr($perPrice[0],4);
																				?>
                                                                                <input type="hidden" name="prodPrice[]" id="prodPrice<?php echo $i;?>" value="<?php echo $prodPrice; ?>" class="form-control" />
                                                                            </td>
                                                                            <td><input type="number" name="mon[]" id="mon<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="tue[]" id="tue<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="wed[]" id="wed<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="thu[]" id="thu<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="fri[]" id="fri<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="sat[]" id="sat<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="sun[]" id="sun<?php echo $i;?>" value="0" size="4" min="0" max="1000" list="numbers" class="form-control" onChange="calculatePrice(<?php echo $i;?>,<?php echo $selCC; ?>);"/></td>
                                                                            <td><input type="number" name="finalPrice[]" id="finalPrice<?php echo $i;?>" value="0" class="form-control" readonly/></td>
                                                                        </tr>
                                                                        <?php
																	$i++;
																}
																?>
                                                                <tr class="selectable">
                                                                    <td colspan="10" class="text-right"><h4 class="panel-title" style="color:#CC0000;font-weight:bold;margin-top:6px;">Grand&nbsp;Total&nbsp;Per&nbsp;Week:&nbsp;</h4></td>
                                                                    <td><input type="text" name="grandTotal" id="grandTotal" value="<?php $finalDis =0; echo $GrandTot = $finalTot - $finalDis; ?>" class="form-control" style="color:#CC0000;font-weight:500;" readonly /></td>
                                                                </tr>
															</tbody>
														</table>
													</div><!-- End : panel-body -->
												</div><!-- End : panel panel-info -->
												<?php
                                            }
											?>
                                        </div>
                                    </div>
                                    <div class="row" style="display:inline-flex;">
                                        <div class="col-md-2">
                                            <img src="captcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' style="width: 104px;height: 40px;">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Enter Captcha Code" class="form-control" name="captcha_code" id="captcha_code" style="width:160px" />
                                        </div>
                                       
                                        <div class="col-md-4" style="margin-top:12px;color:#fff;width:50%">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Can't read the image? click <a href='javascript: refreshCaptcha();' style="color:#fff;font-weight:bold;font-size:12px;">here</a> to refresh.
                                        </div>
                                    </div>
                                    <script type='text/javascript'>
                                        function refreshCaptcha()
                                        {
                                            var img = document.images['captchaimg'];
                                            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
                                            
                                        }
                                    </script>
                                <div class="form-actions fluid">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6"  style="display:inline-flex;">
                                        <div class="col-md-2">
                                            <button class="btn btn-info" type="submit" name="btnSubmit" id="btnSubmit" value="Submit">Submit</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default" type="reset">Clear</button>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                
                                </div>
                            </form>
                        </div><!--- ---------------------- End : Product View ---------------------- --->
                    </div>
                    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ Start : ViewProduct Div ~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                </div>
            </section><br /><br />
            <?php include('footer.php'); ?>
        </div>
        <!-- End Page wrap -->
        
        <!-- Start : User Defined Validation -->
        <script language="javascript">
			function calculatePrice(id,count)
			{
				var finalPrice = parseFloat(document.getElementById('finalPrice'+id).value);
				var prodPrice = parseFloat(document.getElementById('prodPrice'+id).value);
				var sun = document.getElementById('sun'+id).value;
				var mon = document.getElementById('mon'+id).value;
				var tue = document.getElementById('tue'+id).value;
				var wed = document.getElementById('wed'+id).value;
				var thu = document.getElementById('thu'+id).value;
				var fri = document.getElementById('fri'+id).value;
				var sat = document.getElementById('sat'+id).value;
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Sunday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(sun == 0 || sun.length == 0)
				{
					sun = 0;
				}
				else if(sun != 0 || sun.length != 0)
				{
					sun = parseFloat(sun);
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Monday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(mon == 0 || mon.length == 0)
				{
					mon = 0;
				}
				else if(mon != 0 || mon.length != 0)
				{
					mon = parseFloat(mon);
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Tueday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(tue == 0 || tue.length == 0)
				{
					tue = 0;
				}
				else if(tue != 0 || tue.length != 0)
				{
					tue = parseFloat(tue);
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Wednesday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(wed == 0 || wed.length == 0)
				{
					wed = 0;
				}
				else if(wed != 0 || wed.length != 0)
				{
					wed = parseFloat(wed);
				}				
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Thursday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(thu == 0 || thu.length == 0)
				{
					thu = 0;
				}
				else if(thu != 0 || thu.length != 0)
				{
					thu = parseFloat(thu);
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Friday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(fri == 0 || fri.length == 0)
				{
					fri = 0;
				}
				else if(fri != 0 || fri.length != 0)
				{
					fri = parseFloat(fri);
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Saturday Blank Or Not ~~~~~~~~~~~~~~~~~~~~ */
				if(sat == 0 || sat.length == 0)
				{
					sat = 0;
				}
				else if(sat != 0 || sat.length != 0)
				{
					sat = parseFloat(sat);
				}
				
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Calculate Quantity ~~~~~~~~~~~~~~~~~~~~ */
				var qty = parseFloat(sun + mon + tue + wed + thu + fri + sat);
				
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Calculate FinalPrice ~~~~~~~~~~~~~~~~~~~~ */
				if(qty != 0)
				{
					var finalPriceQty = prodPrice * qty;
				
				}
				else if(qty == 0)
				{
					var finalPriceQty = 0;
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Assign FinalPrice to finalPrice Textbox ~~~~~~~~~~~~~~~~~~~~ */
				document.getElementById('finalPrice'+id).value = finalPriceQty;
				grandTotal(count);
			}
			
			function grandTotal(count)
			{
				var cnt = parseFloat(count);
				var ftot = 0;
					
				for(var i=1;i<=cnt;i++)
				{
					var finalprice = parseFloat(document.getElementById('finalPrice'+i).value);
					ftot = ftot + finalprice;
				}
				
				/* ~~~~~~~~~~~~~~~~~~~~ Start : Assign FinalTotal to finalTotal Textbox ~~~~~~~~~~~~~~~~~~~~ */
				//document.getElementById('finalTotal').value = ftot;	
				/*console.log("FinalTotal ==> ",ftot);*/
				
				/* ~~~~~~~~~~~~~~~~~~ Start : Assign FinalDiscount to finalDiscount Textbox ~~~~~~~~~~~~~~~~~~ */
				//var discountPrice = parseFloat((ftot * 10) / 100);
				//document.getElementById('finalDiscount').value = discountPrice;
				/*console.log("Discount ==> ",discountPrice);*/
				
				/* ~~~~~~~~~~~~~~~~~~ Start : Assign GrandTotal to grandTotal Textbox ~~~~~~~~~~~~~~~~~~ */
				//discountPrice = 0;
				//var grandTotal = parseFloat(ftot - discountPrice);
				//grandTotal = Math.round(grandTotal / 10) * 10;
				document.getElementById('grandTotal').value = ftot;
				/*console.log("GrandTotal ==> ",grandTotal);*/
			}
		</script>
        <!-- End : User Defined Validation -->
        
        <!-- Load jQuery -->
        <script type="text/javascript" src="js/library/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/library/jquery.parallax-1.1.3.js"></script>
        <script type="text/javascript" src="js/library/jquery.owl.carousel.js"></script>
        <script type="text/javascript" src="js/library/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="js/library/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="js/library/jquery.easing.min.js"></script>
        <script type="text/javascript" src="js/library/plugins.js"></script>
        <script type="text/javascript" src="js/library/circletype.min.js"></script>
        <script type="text/javascript" src="js/library/jquery.sticky.js"></script>
        <script type="text/javascript" src="js/library/jquery.sticky1.js"></script>
        <script type="text/javascript" src="js/library/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/library/mediaelement-and-player.min.js"></script>
        <script type="text/javascript" src="js/library/retina.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script src="js/library/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/library/sweetalert.css"/>
        <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','js/analytics.js','ga');
       
         ga('create', 'UA-20585382-5', 'megadrupal.com');
         ga('send', 'pageview');        
       </script>
       
       
       
       
       <?php
		/************************* Start : Add Subscription Code *************************/
       if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == "Submit")
		{
		    /* Getting Value of User Detail */
			$updateProdID = array();
			$name = ucwords(strtolower($_POST['name']));
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$address = preg_replace( "/\r|\n/", "", $_POST['address'] );
			
			/* Getting Value of Subscription Qty day wise */
			$sunday = $_POST['sun']; 
			$monday = $_POST['mon']; 
			$tuesday = $_POST['tue']; 
			$wednesday = $_POST['wed']; 
			$thursday = $_POST['thu']; 
			$friday = $_POST['fri']; 
			$satday = $_POST['sat']; 
			$productid = $_POST['prodid']; 
			$productPrice = $_POST['prodPrice']; 
			$prodQtyPrice = $_POST['finalPrice']; 
			$prodCnt = count($productid);
		    
			$password = $var->randomPassword(6); /* 6 = passwordLength */
			$captcha = $_POST['captcha_code'];
		    $wanrning= "";
		    
		    $alldays = array_merge($sunday, $monday,$tuesday,$wednesday,$thursday,$friday,$satday);
		    //To find product selected or not
		    
		    $prodfound= 0;
		    for ($e=0;$e<=count($alldays);$e++)
		    {
		      if($alldays[$e]>0)
		      {
		       $prodfound = 1;
		       break;
		      }
		    }
		    
		    if(!isset($name)|| $name=="")
		    {
		      $wanrning = $wanrning."Please Enter Name\\n";
		    }
		    
		    $emailva = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
             $mob="/^[1-9][0-9]*$/";
		    if(!isset($email) || $email=="")
		    {
		     $wanrning = $wanrning."Please Enter Email\\n";
		    }
		    elseif(!preg_match($emailva, $email)) 
		    {
		      $wanrning = $wanrning."Please  Enter Valid Email\\n";
		    }
		    
		    if(!isset($phone) || $phone=="")
		    {
		     $wanrning = $wanrning."Please Enter Phone Number\\n";
		    }
		    else {
		     if(!preg_match($mob, $phone) || strlen($phone) != 10) 
		     {
		      $wanrning = $wanrning."Please Enter valid Number\\n";
		     }
		    }
		    
		    
		    if (!isset($prodfound) || $prodfound == 0 )
				{
					 $wanrning = $wanrning."Please select atleast one product\\n";
			}
			
		    if(strlen($wanrning)>0)
		    {
		       ?>
				<script language="javascript">
				swal({   
					title: "Warning",  
					text: "<?php echo $wanrning; ?>",   
					type: "error",   
					showCancelButton: false,   
					confirmButtonColor: "#146c08",   
					confirmButtonText: "OK",   
					closeOnConfirm: true }, 
					function(){   
						event.preventDefault();
						document.getElementById("name").value = "<?=$name;?>";
						document.getElementById("email").value = "<?=$email;?>";
						document.getElementById("phone").value = "<?=$phone;?>";
						document.getElementById("address").value = "<?=$address;?>";
						//window.location = "./";
						});
				</script>
				<?php
				die();
		    }
		    
			if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $captcha) != 0)/* Captcha verification is incorrect. */
			{  
				?>
				<script language="javascript">
				swal({   
					title: "Warning",   
					text: "The Captcha code does not match.Please Re-enter Captcha Code.",   
					type: "error",   
					showCancelButton: false,   
					confirmButtonColor: "#146c08",   
					confirmButtonText: "OK",   
					closeOnConfirm: true }, 
					function(){   
						event.preventDefault();
						document.getElementById("name").value = "<?=$name;?>";
						document.getElementById("email").value = "<?=$email;?>";
						document.getElementById("phone").value = "<?=$phone;?>";
						document.getElementById("address").value = "<?=$address;?>";
						//window.location = "./";
						});
				</script>
				<?php
				die();
			}
			else /*Captcha verification is Correct. Final Code Execute here!*/
			{
				//$message = "Dear ".$name." ,<br /><br />Welcome to Mallipoo.com<br /><br /><b>Your Account Information</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username = <b>$email</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password = <b>$password</b> <br /><br /><br /><br />Thanks&nbsp;&amp;&nbsp;Support<br />Mallipoo.com";
				$message = sprintf($user_newcredentials,$name,$email,$password);
				$sendMail = $var->send_mail($email, 
				"support@mallipoo.com", 
				"mallipoo", 
				"support@mallipoo.com", 
				"Login Information for Mallipoo.com", 
				$message);
				
				if($sendMail == "ok")
				{
                       $password = base64_encode($password);
					$insertQry = "INSERT INTO usermst(name, email, password, phone, address, ipaddress, created) VALUES('$name', '$email', '$password', '$phone', '$address', '$ipaddress', '$currentDate')";
					$insertQQ = mysql_query($insertQry) or die(mysql_error());
					$userid = mysql_insert_id();
					
					$_SESSION['userid'] = $userid;
					$_SESSION['name'] = $name;
					$_SESSION['email'] = $email;
					$_SESSION['usertype'] = "User";
				}
				else if($sendMail == "error")
				{
					?>
					<script language="javascript">
					swal({   
						title: "Warning",   
						text: "Error in sending mail. \n",   
						type: "error",   
						showCancelButton: false,   
						confirmButtonColor: "#146c08",   
						confirmButtonText: "OK",   
						closeOnConfirm: true }, 
						function(){   
							window.location = "./";
							});
					</script>
					<?php
					die();
				}
			}
			
			/* Start : Insert Subscription Table */
				/* get subscription Number */
				$subscriptionno = "MBANS10".$_SESSION['userid'];
				
			
			$subWhere = "userid = '$userid'";
			$subSelQry = $var->selectWhere('subscriptionmst',$subWhere);
			$subCnt = $var->num_rows($subSelQry);
			
			if($subCnt == 0)
			{
				/* Start : Insert into Subscription Table  */
				$insertSubMstQry = "INSERT INTO subscriptionmst(subscriptionno, userid, subscriptiondate, subscriptiontime, ipaddress) VALUES('$subscriptionno', '$userid', '$currentDate', '$currentTime', '$ipaddress')";
				$insertSubMstQQ = mysql_query($insertSubMstQry) or die(mysql_error());
				$subscriptionID = mysql_insert_id(); 
						
				for($i=0;$i<$prodCnt;$i++)
				{
					$sun = $sunday[$i]; $mon = $monday[$i]; $tue = $tuesday[$i]; $wed = $wednesday[$i]; $thu = $thursday[$i]; $fri = $friday[$i]; $sat = $satday[$i]; $prodid = $productid[$i]; $prodPrice = $productPrice[$i];$finalPrice = $prodQtyPrice[$i]; $createdate = $currentDate; /* $currentDate come from config file */ $createtime = $currentTime;
					
					if($sun != 0 || $mon != 0 || $tue != 0 || $wed != 0 || $thu != 0 || $fri != 0 || $sat != 0)
					{
						/* Start : Insert into Subscription Detail Table */
						$insertSubDetailQry = "INSERT INTO subscriptiondetail(subscriptionid, prodid, mon, tue, wed, thu, fri, sat, sun, prodprice, finalprice, createdate, createtime) VALUES('$subscriptionID', '$prodid', '$mon', '$tue', '$wed', '$thu', '$fri', '$sat', '$sun', '$prodPrice', '$finalPrice', '$createdate', '$createtime')";
						$insertSubDetailQQ = mysql_query($insertSubDetailQry) or die(mysql_error());
					}
				}
				subscribeMailSend("Insert"); /* Sending mail */
			}
		}
		?>
		<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5854d47fe7588f121244c5de/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    </body>
</html>

<?php
	function subscribeMailSend($alertmessage)
	{
		/* ~~~~~~~~~~~~~~~~~ Start : Mail Send Code ~~~~~~~~~~~~~~~~~ */
		ob_start();
		include(dirname(__FILE__).'/backend/pdf/examples/res/subscribemail.php');			
		$content = ob_get_clean();
		$message = $content;
						
		$sendMail = $var->send_mail($_SESSION['email'], "support@mallipoo.com", "Mallipoo", "support@mallipoo.com", "Mallipoo Subscription - Confirmation ".$_SESSION['email'], $message);
		
		if($sendMail == "ok")
		{
			if($alertmessage == "Insert")
			{
				?>
				<script language="javascript">
				swal({   
					title: "Subscription Message",   
					text: "Subscribe Successfully \n Check your mail for Subscription Detail",   
					type: "success",   
					showCancelButton: false,   
					confirmButtonColor: "#146c08",   
					confirmButtonText: "OK",   
					closeOnConfirm: true }, 
					function(){   
						window.location = "subscribemail.php";
						});
				</script>
				<?php
			}
		}
		else if($sendMail == "error")
		{
			if($alertmessage == "Insert")
			{
				?>
				<script language="javascript">
				swal({   
					title: "Warning",   
					text: "Subscribe Successfully \n Error in Sending Mail",   
					type: "error",   
					showCancelButton: false,   
					confirmButtonColor: "#146c08",   
					confirmButtonText: "OK",   
					closeOnConfirm: true }, 
					function(){   
						window.location = "subscribemail.php";
						});
				</script>
				<?php
			}
		}
		/* ~~~~~~~~~~~~~~~~~ End : Mail Send Code ~~~~~~~~~~~~~~~~~ */
	}
?>
