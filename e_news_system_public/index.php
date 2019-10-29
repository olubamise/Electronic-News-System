<?php
include ('inc/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Business Company</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
	<script type="text/javascript" src="unitpngfix.js"></script>
<![endif]--> 
<script type="text/javascript" src="js/jquery.js"></script>	
<script type="text/javascript">


function hideall() {
	$("#tab").hide();
	$("#tab1").hide();
	$("#tab2").hide();
	$("#tab3").hide();
	$("#tab4").hide();			
}
$(document).ready(function(){

$("#icon1").mouseover(function () {
hideall();
$("#tab1").css("display","block");     
});

$("#icon2").mouseover(function () {
hideall();
$("#tab2").css("display","block");     
});

$("#icon3").mouseover(function () {
hideall();
$("#tab3").css("display","block");     
});  

hideall();
$("#tab").show();       

  });
</script>
</head>
<body>
<div class="wrap">
	<div class="header">
    	<div class="logo"><a href="index.html"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
        
        <div id="menu">
            <ul>                                                                       
            <li class="selected"><a href="index.php">home</a></li>
            <li><a href="details.html">about us</a></li>
            <li><a href="contact.html">contact us</a></li>
            <li><a href="../e_news_system_admin/index.php">Login</a></li>
            </ul>
        </div>
           
    </div> <!--End of header-->
    
    
    <div class="home_center_content">
    

                    <div class="home_center_content">
                    <div class="box1" id="tab">
                    <div class="center_text">
                    <div class="big_title">We <span>grow</span> your Business <span>!</span></div>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    
                    </div>
                    <div class="right_img"><img src="images/pic1.jpg" alt="image" title=""/></div>
                    </div>
                    
                    <div class="box1" id="tab1">
                    <div class="center_text">
                    <div class="big_title">We <span>grow</span> your Business <span>!</span></div>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    </div>
                    
                    <div class="right_img"><img src="images/pic1.jpg" alt="image" title="" /></div>
                    </div>
                    
                    <div class="box1" id="tab2">
                    <div class="center_text">
                    <div class="big_title">Best <span>clients</span> and work <span>!</span></div>
                        <p> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                    <div class="right_img"><img src="images/pic2.jpg" alt="image" title="" /></div>
                    
                    </div>
                    
                    <div class="box1" id="tab3">
                    <div class="center_text">
                    <div class="big_title">Well <span>organized</span> team <span>!</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                    <div class="right_img"><img src="images/pic3.jpg" alt="image" title="" /></div>
                    </div>
                    
                    <ul class="center_button_icons tabset">
                    
                        <li id="icon1">
                        <a href="#tab1" class="tab">
                            <img src="images/icon_news.gif" border="0" alt="image" title="" /> 
                        </a>
                        </li>
                        
                        <li id="icon2">                     
                        <a href="#tab2" class="tab">
                            <img src="images/icon_work.gif" border="0"  alt="image" title=""/> 
                        </a>
                        </li>
                    
                        <li id="icon3">
                        <a href="#tab3" class="tab">             
                        <img src="images/icon_team.gif" border="0" alt="image" title="" />   
                        </a>	 						
                        </li>
                    
                        <li>
                        <a href="#tab" class="tab active"></a>
                        </li>
                    </ul>
                    </div>

    
    </div> <!--End of home_center_content-->
    
    <div class="main_content">
    
    		<div class="left_content">
            <div class="inner_left_content">
            <?php
		if(isset($_GET['id']))
		{
			$nid = trim($_GET['id']);
			$res = get_news_details($nid);
			
			if (rows($res) == 1)
			{
				$nd = get_obj($res);
				?>
                <h1><?php echo $nd->title; ?></h1>
				<p>
				<span class="orange"><strong><?php echo $nd->desc; ?></strong></span><br /><br />
<?php echo $nd->details; ?>
                </p>
				 <?php
			}
			}
			
			else
			{
				$res = get_news_default();
				if (rows($res) == 1)
				{
					$nd = get_obj($res);
			?>
            	<h1><?php echo $nd->title; ?></h1>
                <p>
                <span class="orange"><strong><?php echo $nd->desc; ?></strong></span><br /><br />
<?php echo $nd->details; ?>
                </p>
                <?php  
				}
				}?>
                </div>
            	<h1>Email Newsletter</h1>
                <p>
Subscribe to our newsletter to stay up to date with us. Latest news and updates can be sent into your email address autmatically if you subscribe for our news letter.</p> 
                <div class="newsletter">
                <input type="text" class="input" value="email" onclick="this.value=''"/>
                <input type="image" src="images/subscribe.gif" class="subscribe" />
                </div>       
                
           
            </div> <!--End of left_content-->
            
    		<div class="right_content">
            <?php
            	if(isset($_GET['id']))
		{
			$nid = trim($_GET['id']);
			$res = get_news_details($nid);
			
			if (rows($res) == 1)
			{
				$nd = get_obj($res);
				?>
                <div class="project_box">
                    <a href="#"><img src="<?php echo $nd->news_image; ?>" alt="" title="" border="0" class="feat_project" /></a>
              	</div>
                <?php } }
				else
				{
				?>
                 <div class="project_box">
                    <a href="#"><img src="<?php echo $nd->news_image; ?>" alt="" title="" border="0" class="feat_project" /></a>
                    <div class="project_details">
                    </div>
                </div>
                <?php } ?>
			 
                <h1>News &amp; Updates</h1>
                <?php
                $res = get_news_page();
				
				if (rows($res) > 0) 
				{
				?>
                <div>
							<marquee behviour="slide" direction="up" scrolldelay="500">
					<?php 
                	while ($u = get_obj($res))
					{
						
                ?>
                <div class="news_box">
                <a href="?details&id=<?php echo $u->id;?>"><img src="<?php echo $u->news_image; ?>" class="news_thumb" alt="image" title="" /> </a>
                <p class="news_content">
                <a href="?details&id=<?php echo $u->id;?>"><b><?php echo $u->title; ?></b></a><br>
                <?php echo $u->desc;?>...               
                </p>               
                </div>
                <?php
				}
				?>	
					</marquee>
              </div>				
            <?php } ?>
	  </div>
    		<!--End of right_content-->          
            
    	<div class="clear"></div>
    </div><!--End of main_content-->
    
    
</div><!--End of wrap-->

<div class="footer">
	<div class="footer_content">
    	<div class="footer_tab1">
        	<h2>Get in touch</h2>
        	<span class="email">Email: info@company.com</span>
            
            <div class="footer_info">
                <span class="orange">Adress:</span>
                <p class="info">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                </p>           
            </div>
            
            <div class="footer_info">
                <span class="orange">Phone:</span>
                <p class="info">
                008 900 800 32   /    008 900 800 32 
                </p>           
            </div> 
            <div class="footer_copyrights">
            <img src="images/footer_logo.gif" alt="" title="" /><br />
            &copy; 2009 All Rights Reserved
            </div>    
            
        
        </div> <!--End of footer_tab1-->
        
    	<div class="footer_tab2">
        	<h2>Favorites</h2>
            <div class="favorites_box">
                <span class="fav_nr">1</span>
                <p class="favorites">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                </p>           
            </div> 
            
            <div class="favorites_box">
                <span class="fav_nr">2</span>
                <p class="favorites">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                </p>           
            </div>        
            
            <div class="favorites_box">
                <span class="fav_nr">3</span>
                <p class="favorites">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                </p>           
            </div>        
 
        </div> <!--End of footer_tab2--> 
        
        
        
    	<div class="footer_tab3">
        	<h2>Links</h2>
                <div class="footer_links">
                    <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Clients</a></li>
                    <li><a href="#">Work</a></li>
                    <li><a href="#">Terms &amp; conditions</a></li>
                    <li><a href="#">RSS</a></li>
                    <li><a href="#">Contact</a></li>
                    </ul>
                </div> 
        </div> <!--End of footer_tab3-->      
        
        
        
             
        
    <div class="clear"></div>
	</div> <!--End of footer_content-->
</div><!--End of footer-->

</body>
</html>