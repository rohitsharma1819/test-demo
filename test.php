<?php
   $is_login = $this->session->userdata('is_login');
	if ( $is_login ) 
	{
		$userid = $this->session->userdata('userid');
		$userdata = $this->user_model->getUser($userid);
		$useraddresses = $this->user_model->getAddress($userid);
		$seller_banners_arr = $this->banner_model->getSellerBanners($userid);
	}

	$categories0 = $this->category_model->getBoatCategories();	
	$mileage_arr = array('' => 'Any', '25000' => 'Less than 25000', '50000' => 'Less than 50000', '75000' => 'Less than 75000', '100000' => 'Less than 100000', '100001' => 'Greater than 100000');

	$position_arr = $this->banner_model->getbanners();
	if(isset($_GET['position_type']) && $_GET['position_type'] != ''){
		$position = $_GET['position_type'];	
		$position_detail = $this->banner_model->getbanner($position);
		
	}
	$cate_arr = $this->category_model->getTopCategories();#echo '<pre>';print_r($cate_arr);die();
	if(isset($_GET['cate']) && $_GET['cate'] != ''){
		$cate = $_GET['cate'];	
		$cate_detail = $this->category_model->getCategory($cate);
		$sub_cate_arr = $this->category_model->getChildCategories($cate);
		
	} else {
		$sub_cate_arr = array();
	}
	
	if(isset($_GET['sub_cate']) && $_GET['sub_cate'] != ''){
		$sub_cate = $_GET['sub_cate'];	
		$sub_cate_detail = $this->category_model->getCategory($sub_cate);
		
	}
	if(isset($_GET['transaction_type']) && $_GET['transaction_type'] != ''){
		$transaction_type = $_GET['transaction_type'];	
	}
	if(isset($_GET['campaign']) && $_GET['campaign'] != ''){
		$campaign = $_GET['campaign'];	
	}
	if(isset($_GET['link']) && $_GET['link'] != ''){
		$link = $_GET['link'];	
	}
	if(isset($_GET['duration']) && $_GET['duration'] != ''){
		$duration = $_GET['duration'];	
	}
	if(isset($_GET['zipcode']) && $_GET['zipcode'] != ''){
		$zipcode = $_GET['zipcode'];	
	}
	
	if(isset($_GET['country']) && $_GET['country'] != ''){
		$seller_country = $_GET['country'];	
	}
	
	if(isset($_GET['state']) && $_GET['state'] != ''){
		$seller_state = $_GET['state'];	
	}
	
	if((isset($_GET['id']) && $_GET['id'] != '') || (isset($id) && $id != '') ){
		$seller_banner_data = $this->banner_model->getSellerBanner($id);
		if(is_array($seller_banner_data)){
			extract($seller_banner_data);
			$position_detail = $this->banner_model->getbanner($position);
			$cate_detail = $this->category_model->getCategory($cate);
			$sub_cate_arr = $this->category_model->getChildCategories($cate);
			$sub_cate_detail = $this->category_model->getCategory($sub_cate);
			#echo '<pre>';print_r($seller_banner_data);die();
		}
	}
?>

<script src="<?php echo base_url()."content/js/jpicker-1.1.6.js";?>" ></script>
<script src="<?php echo base_url()."content/js/jquery.ui.mouse.js";?>" ></script>
<script src="<?php echo base_url()."content/js/jquery.ui.dialog.js";?>" ></script>
<script src="<?php echo base_url()."content/js/jquery.ui.position.js";?>" ></script>
<script src="<?php echo base_url()."content/js/jquery.ui.button.js";?>" ></script>
<script src="<?php echo base_url()."content/js/jquery.ui.draggable.js";?>" ></script>
<script src="<?php echo base_url()."content/js/ajaxfileupload.js";?>" ></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>content/css/jPicker-1.1.6.css">
<div class="breadcrumb">
  	<div class="container" style="margin-top:50px">
        <div class="row">
        	 <a href="<?php echo base_url(); ?>">Home</a> > Banner Listing
        </div>
    </div>
  </div>
<main class="bdb">
  	<div class="store-wraper">
    	<div class="container postproductpage">
        	<div class="row">    
            	<div class="leftpane store-L w-300">
                	<!-- <div class="box user">
                    	<h2><?php echo $userdata['username']; ?>’s Store <span class="right up"><img src="<?php echo base_url()?>content/images/btn-expand.png" alt="" /></span></h2>
                        <div class="boxcontent text-center">
                        	<?php
								if ( $userdata['photo'] != '' ){
								?>
									<img src="<?php echo base_url() . "content/uploads/photos/" . $userdata['photo']; ?>" width="150">
									<input type="button" id="changePhoto" value="Change photo"/>
								<?php
								}
								else
								{
								?>
									<img src="<?php echo base_url() . "content/images/unknown.jpg"; ?>" width="150"><br/>
									<input type="button" id="uploadPhoto" value="Upload photo"/>
								<?php
								}
								?>
                        </div>
                    	<div class="feedbacksec">
                        	No Feedback Given
                        </div>
                    </div>
                     -->
					<!--<div class="ad-banner">
                    	<img src="<?php echo base_url()?>content/images/ad-bann.jpg" alt=" ads banner" />
                    </div>-->
                </div>
 				<div class="rightpane">    
                 <div class="header-pan" style="padding-bottom: 10px;text-align: center;width: 75%;">
                    <span style="">Post Banner </span><span name="list" id='pbanner' class='p-banner' val='banner' style="background: url(&quot;/content/images/chk-box.png&quot;) center center no-repeat;background-color: rgba(0, 0, 0, 0);background-position-x: 0%;background-position-y: 0%;background-size: auto auto;background-position: 0px -40px;height: 19px;width: 20px;display: inline-block;background-size: 96%;background-color: #fff;cursor: pointer;margin: 2px 9px -5px 7px;"></span>
	 
	               <span class="right-panel" style="margin-left: 20px;">video uploading<span id='pvideo' class='p-banner' val='video' name="list" style="background: url(&quot;/content/images/chk-box.png&quot;) center center no-repeat;background-color: rgba(0, 0, 0, 0);background-position-x: 0%;background-position-y: 0%;background-size: auto auto;background-position: 0 0;height: 19px;width: 20px;display: inline-block;background-size: 96%;background-color: #fff;cursor: pointer;margin: 2px 9px -5px 7px;"></span></span></div>
                	<div id="contentArea" class="product-box w-700">
                	<h2 id="pe">Post Banner</h2>
                    <div class="divider"></div>
<!--<div id="contentArea">-->
	
					<?php
                
                    if ( !$useraddresses )
                    {
                        echo '<h4 style="color:#b00000;padding:5px 10px;border:1px solid #b90000;margin-top:10px;">You have to set your address first. Please click <a href="'.base_url('address').'">here</a></h4>';
                    }
                    ?>
                    <div class="postProductContentEvent">
                    <?php echo $this->session->flashdata('message'); ?>
                        <?php
                        if ( isset($success) && isset($msg) )
                        {
                            echo '<div id="postProduct_success" class="success" style="display:block;">'.$msg.'! </div>';
                            echo '<div id="postProduct_error" class="error posterror"></div>';
                        }
                        else if ( isset($error) ){
                            echo '<div id="postProduct_error" class="error posterror" style="display:block;">'.$error_message.'</div>';
                        }
                        else if ( isset($msg) && $msg == 'delete' ){
                            echo '<div id="" class="success" style="display:block;">Banner has been Deleted.</div>';
                        }
                        else{
                            echo '<div id="postProduct_success" class="success"></div><div id="postProduct_error" class="error posterror"></div>';	
                        }
                        ?>
						
                    <div id="" style="display:block;" class="error" >
					* All fields required.
					</div>
                    </div>
                    <div class="postProductContent" id="productpage">
					
                        
                        <form id="country_form" name="country_form" action="<?php echo base_url('bannerlisting'); ?>" method="get">
						<?php if(isset($_GET['id']) && $_GET['id'] != ''){ ?>
						<input type="hidden" name="id" id="psrh_id" value="<?php echo $_GET['id']; ?>" />
						<?php } ?>
						<input type="hidden" name="country" id="psrh_country" value="<?php echo $_GET['country']; ?>" />
						<input type="hidden" name="state" id="psrh_state" value="<?php echo $_GET['state']; ?>" />
						<input type="hidden" name="position_type" id="psrh_position" value="<?php echo $_GET['position_type']; ?>" />
						<input type="hidden" name="cate" id="psrh_cate" value="<?php echo $_GET['cate']; ?>" />
						<input type="hidden" name="sub_cate" id="psrh_sub_cate" value="<?php echo $_GET['sub_cate']; ?>" />
						<input type="hidden" name="transaction_type" id="psrh_transaction_type" value="<?php echo $_GET['transaction_type']; ?>" />
						<input type="hidden" name="link" id="psrh_link" value="<?php echo $_GET['link']; ?>" />
						<input type="hidden" name="duration" id="psrh_duration" value="<?php echo $_GET['duration']; ?>" />
						<input type="hidden" name="campaign" id="psrh_campaign" value="<?php echo $_GET['campaign']; ?>" />
						<input type="hidden" name="zipcode" id="psrh_zipcode" value="<?php echo $_GET['zipcode']; ?>" />
						</form>
                        <form id="post_form" name="post_form" action="<?php echo base_url('bannerlisting'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="uid" id="uid" value="<?php echo $userid; ?>" />
						<?php if($id && $id != ''){?>
						<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />						
						<?php } ?>
					<div class="cl-row">	 
						<div class="postItem">
                            <!-- <div class="postItemTitle">
                               State
                            </div>-->
                            <div class="postItemBody">
                               <input type="text" name="campaign" required placeholder="Campaign" id="campaign" value="<?php echo $campaign; ?>" />
                            </div>
                      </div>
					  
					
					   <div class="postItem">
                            <!-- <div class="postItemTitle">
                               Country
                            </div>-->
                            <div class="postItemBody">
                               <select id="seller_country" name="seller_country" >
								<option value="">Select Country</option>
							</select>
                                
                            </div>
                      </div>
                      </div>
                      <div class="cl-row">	
					  <div class="postItem">
                            <!-- <div class="postItemTitle">
                               State
                            </div>-->
                            <div class="postItemBody">
                                <select id="seller_state" name="seller_state" >
								<option value="">Select State</option>
							</select>
                                
                                
                            </div>
                      </div>
						 <div class="postItem">
                            <!-- <div class="postItemTitle">
                                Zip Code
                            </div>-->
                            <div class="postItemBody">
                                <input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="Zip Code" class="questico">
                                <!--<img class="quest"  src="<?php// echo base_url('content/images/quest.png')?>" title="Zip Code" >&nbsp;-->
                            </div>
                      </div>
                      </div>
                      <div class="cl-row">	
						<div class="postItem prod-desc">
                            <!--<div class="postItemTitle">
                                Banner Position
                            </div>-->
                            <div class="postItemBody">
                                <select id="position" name="position" >
								<option value="">Select Position</option>
								<?php foreach($position_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $position) echo 'selected';?>><?php echo $val['position_name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>
						<div class="postItem prod-desc">
                           <!-- <div class="postItemTitle">
                                Sub Transaction Type
                            </div>-->
                            <div class="postItemBody">
                                <?php $txn_arr = array('0'=> 'Transaction Type','00' => 'All Products','2' => 'Auction','1' => 'Buy Now','10' => 'Business Listing','7' => 'Classified','9' => 'E-Products','6' => 'Liquidation','8' => 'Live Streaming','3' => 'Subscription','4' => 'Ticketing','5' => 'Wholesale',); ?>
                                <select id="transaction_type" name="transaction_type" >
								<?php foreach($txn_arr as $key => $val){ ?>
								<option value="<?php echo $key; ?>" <?php if($key == $transaction_type) echo 'selected';?>><?php echo $val ;?></option>
								<?php } ?>
							</select>
                            </div>
                        </div>
                       
                        </div>
                        <div class="cl-row">
<div class="postItem prod-desc">
                            
                            <div class="postItemBody">
                                <select id="cate" name="cate" >
								<option value="">Select Category</option>
								<?php foreach($cate_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $cate) echo 'selected';?>><?php echo $val['name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>						
						<div class="postItem prod-desc">
                            
                            <div class="postItemBody">
                                <select id="sub_cate" name="sub_cate" >
								<option value="">Select Sub Category</option>
								<?php foreach($sub_cate_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $sub_cate) echo 'selected';?>><?php echo $val['name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>
						
					   
                        </div>
                        <div class="cl-row">	
                        <div class="postItem prod-desc">
                            
                            <div class="postItemBody"><?php #echo '<prE>';print_r($position_detail);die(); ?>
                                <select id="duration" name="duration" >
								<option value="00">Views</option>
								<?php if(isset($position_detail['banner_hit']) && $position_detail['banner_hit'] != ''){?>
                                <?php 
                                    for( $i = 1; $i < 26; $i ++ ){ ?>
                                       <option value="<?php echo $i; ?>" <?php if ($i == $duration) echo 'selected';?>><?php echo ($i*($position_detail['banner_hit']))  ; ?> </option>
                                <?php } ?>
                                <?php } ?>
							</select>
                                
                            </div>
                        </div>
						<div class="postItem emailadd">
                           <!-- <div class="postItemTitle">
                                Link
                            </div>-->
                            <div class="postItemBody">
                                <input type="text" id="link" name="link" required placeholder="Link" value="<?php echo $link; ?>" class="questico">
                            </div>
                        </div>
						
						<?php if(isset($position) && $position == 12){?>
						 <div class="cl-row" style="padding-bottom:20px">	
                        <textarea name="description" id="description" placeholder="Description here" style="width:100%;height:20%"><?php echo $description; ?></textarea>
                        <p id="descriptionp"></p>
						</div>
						<?php } ?>
                        <div class="cl-row">	
						<div class="postItem prod-desc">
                            <!--<div class="postItemTitle">
                                Upload Banner
                            </div>-->
                            <div class="postItemBody">
                              <div id="divinputfile2">
                    <input type="file" id="filepc2" onchange="document.getElementById('fakefilepc2').value = this.value;" size="30" name="banner_img" />
                    <div id="fakeinputfile2">
                 	 <input type="text" id="fakefilepc2" name="fakefilepc2" value="<?php if(isset($banner_img)) echo base_url().$banner_img; else if((isset($_GET['id']) && $_GET['id'] != '') || (isset($_POST['id']) && $_POST['id'] != '')) echo base_url('content/images/banner-review.jpg'); ?>" />
                </div>
                    </div>
                                
                            </div>
                        </div>
                        <div class="uploaded-ban">
                    	<img id="banner_preview"name="banner_preview" src="<?php if(isset($banner_img)) echo base_url().$banner_img; else echo base_url('content/images/banner-review.jpg'); ?>"  width="207" height="173" alt="<?php echo $campaign; ?>" />
                    </div>
					
                        
						<div class="postItemBody postItemBody-2" id="postTypeAll">
                               
                        <div class="postItem">
                           <!-- <div class="submi"><input type="submit" class="post" value="Submit" id="product_type" onclick="gaq();" /></div> -->
						   <?php if(isset($status) && $status == 1) $paid = 1; else $paid = 0; ?>
							<?php if(isset($position_detail) && !empty($position_detail) && ($position_detail['payment_enabled'] == 1) && ($paid == 0) && ($duration != '')){ ?>
							<div class="f-amount "><strong>Fee Amount:</strong>  <span style="color:red;font-size:25px">$ <?php echo $position_detail['price']*$duration; ?></span></div>
							<input type="hidden" name="fee" value="<?php echo $position_detail['price']; ?>" />
							<?php } ?>
                        </div>
						</div>
                        <div class="cl-row">	
						
						 <div class="postItem paypal-im">
						 <?php if(isset($position_detail) && !empty($position_detail) && ($position_detail['payment_enabled'] == 1) && ($paid == 0)){ ?>
                            <input type="submit" class="post" value="Paypal Checkout" id="product_type" onclick="gaq();" />
						 <?php }else{ ?>
						 <input type="submit" class="post" value="Submit" id="product_type" onclick="gaq();" />
						 <?php } ?>
                        </div>
						</div>
                        </form>
                        
                   
                    </div>
                    </div>
                    
                   
                    
                    
              	</div> </div>
				
			<!-- video uploading code -->
			
			<div id="videoArea" class="product-box w-700" style='min-height: 500px;display:none;'>
                	<h2 id="pe">Video Upload</h2>
                    <div class="divider"></div>
				<!--<div id="contentArea">-->
	
					<?php
                
                    if ( !$useraddresses )
                    {
                        echo '<h4 style="color:#b00000;padding:5px 10px;border:1px solid #b90000;margin-top:10px;">You have to set your address first. Please click <a href="'.base_url('address').'">here</a></h4>';
                    }
                    ?>
                    <div class="postProductContentEvent">
                    <?php echo $this->session->flashdata('message'); ?>
                        <?php
                        if ( isset($success) && isset($msg) )
                        {
                            echo '<div id="postProduct_success" class="success" style="display:block;">'.$msg.'! </div>';
                            echo '<div id="postProduct_error" class="error posterror"></div>';
                        }
                        else if ( isset($error) ){
                            echo '<div id="postProduct_error" class="error posterror" style="display:block;">'.$error_message.'</div>';
                        }
                        else if ( isset($msg) && $msg == 'delete' ){
                            echo '<div id="" class="success" style="display:block;">Banner has been Deleted.</div>';
                        }
                        else{
                            echo '<div id="postProduct_success" class="success"></div><div id="postProduct_error" class="error posterror"></div>';	
                        }
                        ?>
						
                    <div id="" style="display:block;" class="error" >
					* All fields required.
					</div>
                    </div>
                    <div class="postProductContent" id="productpage">
					
                        
                        <form id="country_form" name="country_form" action="<?php echo base_url('bannerlisting'); ?>" method="get">
						<?php if(isset($_GET['id']) && $_GET['id'] != ''){ ?>
						<input type="hidden" name="id" id="psrh_id" value="<?php echo $_GET['id']; ?>" />
						<?php } ?>
						<input type="hidden" name="country" id="psrh_country" value="<?php echo $_GET['country']; ?>" />
						<input type="hidden" name="state" id="psrh_state" value="<?php echo $_GET['state']; ?>" />
						<input type="hidden" name="position_type" id="psrh_position" value="<?php echo $_GET['position_type']; ?>" />
						<input type="hidden" name="cate" id="psrh_cate" value="<?php echo $_GET['cate']; ?>" />
						<input type="hidden" name="sub_cate" id="psrh_sub_cate" value="<?php echo $_GET['sub_cate']; ?>" />
						<input type="hidden" name="transaction_type" id="psrh_transaction_type" value="<?php echo $_GET['transaction_type']; ?>" />
						<input type="hidden" name="link" id="psrh_link" value="<?php echo $_GET['link']; ?>" />
						<input type="hidden" name="duration" id="psrh_duration" value="<?php echo $_GET['duration']; ?>" />
						<input type="hidden" name="campaign" id="psrh_campaign" value="<?php echo $_GET['campaign']; ?>" />
						<input type="hidden" name="zipcode" id="psrh_zipcode" value="<?php echo $_GET['zipcode']; ?>" />
						</form>
                        <form id="post_form" name="post_form" action="<?php echo base_url('bannerlisting'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="uid" id="uid" value="<?php echo $userid; ?>" />
						<?php if($id && $id != ''){?>
						<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />						
						<?php } ?>
					<div class="cl-row">	 
						<div class="postItem">
                            <!-- <div class="postItemTitle">
                               State
                            </div>-->
                            <div class="postItemBody">
                               <input type="text" name="campaign" required placeholder="Campaign" id="campaign" value="<?php echo $campaign; ?>" />
                            </div>
                      </div>
					  
					
					   <div class="postItem">
                            <!-- <div class="postItemTitle">
                               Country
                            </div>-->
                            <div class="postItemBody">
                               <select id="seller_country" name="seller_country" >
								<option value="">Select Country</option>
							</select>
                                
                            </div>
                      </div>
                      </div>
                      <div class="cl-row">	
					  <div class="postItem">
                            <!-- <div class="postItemTitle">
                               State
                            </div>-->
                            <div class="postItemBody">
                                <select id="seller_state" name="seller_state" >
								<option value="">Select State</option>
							</select>
                                
                                
                            </div>
                      </div>
						 <div class="postItem">
                            <!-- <div class="postItemTitle">
                                Zip Code
                            </div>-->
                            <div class="postItemBody">
                                <input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="Zip Code" class="questico">
                                <!--<img class="quest"  src="<?php// echo base_url('content/images/quest.png')?>" title="Zip Code" >&nbsp;-->
                            </div>
                      </div>
                      </div>
                      <div class="cl-row">	
						<div class="postItem prod-desc">
                            <!--<div class="postItemTitle">
                                Banner Position
                            </div>-->
                            <div class="postItemBody">
                                <select id="position" name="position" >
								<option value="">Select Position</option>
								<?php foreach($position_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $position) echo 'selected';?>><?php echo $val['position_name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>
						<div class="postItem prod-desc">
                           <!-- <div class="postItemTitle">
                                Sub Transaction Type
                            </div>-->
                            <div class="postItemBody">
                                <?php $txn_arr = array('0'=> 'Transaction Type','00' => 'All Products','2' => 'Auction','1' => 'Buy Now','10' => 'Business Listing','7' => 'Classified','9' => 'E-Products','6' => 'Liquidation','8' => 'Live Streaming','3' => 'Subscription','4' => 'Ticketing','5' => 'Wholesale',); ?>
                                <select id="transaction_type" name="transaction_type" >
								<?php foreach($txn_arr as $key => $val){ ?>
								<option value="<?php echo $key; ?>" <?php if($key == $transaction_type) echo 'selected';?>><?php echo $val ;?></option>
								<?php } ?>
							</select>
                            </div>
                        </div>
                       
                        </div>
                        <div class="cl-row">
<div class="postItem prod-desc">
                            
                            <div class="postItemBody">
                                <select id="cate" name="cate" >
								<option value="">Select Category</option>
								<?php foreach($cate_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $cate) echo 'selected';?>><?php echo $val['name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>						
						<div class="postItem prod-desc">
                            
                            <div class="postItemBody">
                                <select id="sub_cate" name="sub_cate" >
								<option value="">Select Sub Category</option>
								<?php foreach($sub_cate_arr as $key => $val){ ?>
								<option value="<?php echo $val['id'] ; ?>" <?php if ($val['id'] == $sub_cate) echo 'selected';?>><?php echo $val['name'] ; ?></option>
								<?php } ?>
							</select>
                                
                            </div>
                        </div>
						
					   
                        </div>
                        <div class="cl-row">	
                        <div class="postItem prod-desc">
                            
                            <div class="postItemBody"><?php #echo '<prE>';print_r($position_detail);die(); ?>
                                <select id="duration" name="duration" >
								<option value="00">Views</option>
								<?php if(isset($position_detail['banner_hit']) && $position_detail['banner_hit'] != ''){?>
                                <?php 
                                    for( $i = 1; $i < 26; $i ++ ){ ?>
                                       <option value="<?php echo $i; ?>" <?php if ($i == $duration) echo 'selected';?>><?php echo ($i*($position_detail['banner_hit']))  ; ?> </option>
                                <?php } ?>
                                <?php } ?>
							</select>
                                
                            </div>
                        </div>
						<div class="postItem emailadd">
                           <!-- <div class="postItemTitle">
                                Link
                            </div>-->
                            <div class="postItemBody">
                                <input type="text" id="link" name="link" required placeholder="Link" value="<?php echo $link; ?>" class="questico">
                            </div>
                        </div>
						
						<?php if(isset($position) && $position == 12){?>
						 <div class="cl-row" style="padding-bottom:20px">	
                        <textarea name="description" id="description" placeholder="Description here" style="width:100%;height:20%"><?php echo $description; ?></textarea>
                        <p id="descriptionp"></p>
						</div>
						<?php } ?>
                        <div class="cl-row">	
						<div class="postItem prod-desc">
                            <!--<div class="postItemTitle">
                                Upload Banner
                            </div>-->
                            <div class="postItemBody">
                              <div id="divinputfile2">
                    <input type="file" id="filepc2" onchange="document.getElementById('fakefilepc2').value = this.value;" size="30" name="banner_img" />
                    <div id="fakeinputfile2">
                 	 <input type="text" id="fakefilepc2" name="fakefilepc2" value="<?php if(isset($banner_img)) echo base_url().$banner_img; else if((isset($_GET['id']) && $_GET['id'] != '') || (isset($_POST['id']) && $_POST['id'] != '')) echo base_url('content/images/banner-review.jpg'); ?>" />
                </div>
                    </div>
                                
                            </div>
                        </div>
                        <div class="uploaded-ban">
                    	<img id="banner_preview"name="banner_preview" src="<?php if(isset($banner_img)) echo base_url().$banner_img; else echo base_url('content/images/banner-review.jpg'); ?>"  width="207" height="173" alt="<?php echo $campaign; ?>" />
                    </div>
					
                        
						<div class="postItemBody postItemBody-2" id="postTypeAll">
                               
                        <div class="postItem">
                           <!-- <div class="submi"><input type="submit" class="post" value="Submit" id="product_type" onclick="gaq();" /></div> -->
						   <?php if(isset($status) && $status == 1) $paid = 1; else $paid = 0; ?>
							<?php if(isset($position_detail) && !empty($position_detail) && ($position_detail['payment_enabled'] == 1) && ($paid == 0) && ($duration != '')){ ?>
							<div class="f-amount "><strong>Fee Amount:</strong>  <span style="color:red;font-size:25px">$ <?php echo $position_detail['price']*$duration; ?></span></div>
							<input type="hidden" name="fee" value="<?php echo $position_detail['price']; ?>" />
							<?php } ?>
                        </div>
						</div>
                        <div class="cl-row">	
						
						 <div class="postItem paypal-im">
						 <?php if(isset($position_detail) && !empty($position_detail) && ($position_detail['payment_enabled'] == 1) && ($paid == 0)){ ?>
                            <input type="submit" class="post" value="Paypal Checkout" id="product_type" onclick="gaq();" />
						 <?php }else{ ?>
						 <input type="submit" class="post" value="Submit" id="product_type" onclick="gaq();" />
						 <?php } ?>
                        </div>
						</div>
                        </form>
                        
                   
                    </div>
                    </div>
                    
                   
                    
                    
              	</div> </div>

			<!------------ end ---------->
				
				</div>
                
                 <!--Listing Start-->
				 <?php if(count($seller_banners_arr) > 0 && !empty($seller_banners_arr)){?>
                        <!--<div  class="m-top-20" >
                           
                            <div class="bannm-list"  >
							<table class="table"id="banner-list-grid">
							-->

							<div id="contentArea" class="product-box" style="min-height: 100px; margin-top: 15px; width: 98%;">
                        <h2 id="pe">Banner Listing</h2>
                        <div class="divider"></div>
                        <div class="col-lg-12" style="margin: 10px;">
                            <table id="banner-list-grid"  class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap no-footer" cellspacing="0" style="width: 98%;">
                            <thead>
							<!--<tr><th style="background-color:#1b5a99;" colspan="12" id="contentArea" ><h2  style="color:#ffffff" id="pe">Banner Listing</h2></th></tr>-->
							<tr>                 
							<!--<th>S.No</th>-->
							<th>Campaign</th>
							<th>Position</th>
							<th>Transaction Type</th>
							<th>Category</th>
							<th>Sub-Category</th>
							<th>Link</th>
							<th>Purchased Views</th>
							<th>Views</th>
							<th>Clicks</th>
							<th>Status</th>
							<th>Action</th>
							</tr>
							</thead>
                             <tbody>
							<?php $i = 0; $status_arr = array(0 => 'Payment Pending', 1 => 'Activated', 2 => 'Deactivated'); ?>
							<?php foreach($seller_banners_arr as $val){ ?>
							
							<?php
							$position_detail = $this->banner_model->getbanner($val['position']);
							$cate_detail = $this->category_model->getCategory($val['cate']);
							$sub_cate_detail = $this->category_model->getCategory($val['sub_cate']);
							?>
							<tr>
							<!--<td><?php //echo ++$i; ?></td>-->
							<td><?php echo $val['campaign']; ?></td>
							<td><?php echo $position_detail['position_name']; ?></td>
							<td><?php echo $txn_arr[$val['transaction_type']]; ?></td>
							<td><?php echo $cate_detail['name']; ?></td>
							<td><?php echo $sub_cate_detail['name']; ?></td>
							<td><?php echo $val['link']; ?></td>
							<td><?php echo $val['duration'] * $position_detail['banner_hit']; ?></td>
							<td><?php echo $val['views']; ?></td>
							<td><?php echo $val['clicks']; ?></td>
							<td><?php echo $status_arr[$val['status']]; ?></td>
							<td class="status promotion table tr td">
							
							<a href="<?php echo base_url('bannerlisting?id='.$val['id']); ?>">Edit / Preview</a> 
							<a href="<?php echo base_url('banner/deletedlisting?id='.$val['id']); ?>">Delete</a> </td>
							</tr>
							<?php } ?>
                             </tbody>
							</table>
							
          </div>
       </div>
				 <?php } ?>
    </div>
</main>
<div class="dialog" id="color_dlg" title="Color" style="padding:0;">
	<span id="color"></span><br/>
</div>

<div class="dialog" id="picture_dlg" title="Upload pictures" >
	<input type="hidden" id="pictureAction" value="new">
	<input type="hidden" id="pictureID" value="">
	<p><input type="file" id="upload_picture" name="upload_picture" accept="image/*"></p>
	<p style="text-align:right;"><input type="button" id="uploadPictureOK_btn" value="OK"><input type="button" id="uploadPictureCancel_btn" value="Cancel"></p>
</div>



<script>
	var base_url = "<?php echo base_url();?>";

	$.fn.jPicker.defaults.images.clientPath=base_url + 'content/images/';

	$(function(){
	
	    $('.p-banner').live('click',function(){
    		
			var data_type = $(this).attr('val');
			var style	  = $(this).css('background-position');
            
			$('.p-banner').css('background-position','0px 0px');
			if(style == '0px 0px'){
				$(this).css('background-position','0px -40px');
			}
			else{
                if($('.p-banner').css('background-position') == '0px 0px'){
                    alert('please select atleast one');
                }
				$(this).css('background-position','0px -40px');
			}
			
			switch(data_type){
				
				case 'video':
					$('#contentArea').hide();
					$('#videoArea').show();
				break;
				
				case 'banner':
					$('#contentArea').hide();
					$('#videoArea').show();
				break;
			}
            
		});
		 $("#pdelete").live("click", function (e) {
			if ($('#sizetable tbody > tr').length <= 1) {
				return false;
			}
			if ($(this).parent().parent().find("input[name='padd']").val()) {
				return false;
			}
				$(this).parent().closest("tr").css("background-color", "#FFFFEA");
				$(this).fadeOut('slow', function () {
					$(this).parent().closest("tr").prev('tr').remove();
					$(this).parent().closest("tr").remove();
				});
		});
		
		$("#padd").live("click", function (e, index) {
			var error = false;
			var error_txt = "";
			
			if ( $("#product_fix").attr('checked') == 'checked' || $("#sellUnitsIndividually").attr('checked') == 'checked'){
				var $list = $("#sizetable :input[name='psize[]']");
				$list.each(function(){
					product_size = $(this).val();
					if ( product_size == '' ){
						error = true;
						error_txt += "You should input product size.<br/>";
					} 
				});
				
				var $list = $("#sizetable :input[name='pcolor[]']");
				$list.each(function(){
					product_size = $(this).val();
					if ( product_size == '' ){
						error = true;
						error_txt += "You should input product color.<br/>";
					} 
				});
				
				var $list = $("#sizetable :input[name='pqty[]']");
				$list.each(function(){
					product_qty = $(this).val();
					if ( product_qty == '' ){
						error = true;
						error_txt += "You should input product quantity.<br/>";
					} else if ( !isNumDot(product_qty) ){
						error = true;
						error_txt += "You should input valid quantity. Quantity is numeric.<br/>";
					}
				});
				
				var $list = $("#sizetable :input[name='pprice[]']");
				$list.each(function(){
					product_price = $(this).val();
					if ( product_price == '' ){
						error = true;
						error_txt += "You should input product price.<br/>";
					} else if ( !isNumDot(product_price) ){
						error = true;
						error_txt += "You should input valid price. Price is numeric.<br/>";
					}
				});
			} 			
			if ( error ) {
				$("#postsize_error").html(error_txt);
				$("#postsize_error").slideDown();
				setTimeout(function(){$("#postsize_error").slideUp();$("#postsize_error").html('');}, 2000);
				return false;
			}
			
			$('#sizetable tbody > tr:last').after('<tr><td colspan="4"><input type="text" placeholder="Size" name="psize[]"   /><input type="hidden" id="pcolor[]" name="pcolor[]" value="ffffff"/><span  class="pcolorv" >color</span></td></tr><tr><td><input type="text" placeholder="Quantity" name="pqty[]" style="width:150px;" /></td><td><input type="text" placeholder="Price" name="pprice[]" style="width:150px;"/></td><td><input type="button"  value=" Add " name="padd" id="padd"/></td><td><input type="button"  value=" Delete " name="pdelete" id="pdelete" class="add"/></td></tr>');
			$('#sizetable tbody > tr:last').find("input[name='padd']").remove();
		});
		
		 $("#pldelete").live("click", function (e) {
			if ($('#sizetableWholesale tbody > tr').length <= 1) {
				return false;
			}
			if ($(this).parent().parent().find("input[name='pladd']").val()) {
				return false;
			}
				$(this).parent().closest("tr").css("background-color", "#FFFFEA");
				$(this).fadeOut('slow', function () {
					$(this).parent().closest("tr").remove();
				});
		});
		
		$("#pladd").live("click", function (e, index) {
			
			var error = false;
			var error_txt = "";
			
			if ( $("#product_wholesale").attr('checked') == 'checked' ){
				var $list = $("#sizetableWholesale :input[name='lsize[]']");
				$list.each(function(){
					product_size = $(this).val();
					if ( product_size == '' ){
						error = true;
						error_txt += "You should input product lot size.<br/>";
					} 
				});
				
				var $list = $("#sizetableWholesale :input[name='plcolor[]']");
				$list.each(function(){
					product_size = $(this).val();
					if ( product_size == '' ){
						error = true;
						error_txt += "You should input product color.<br/>";
					} 
				});
				
				var $list = $("#sizetableWholesale :input[name='lotsize[]']");
				$list.each(function(){
					product_qty = $(this).val();
					if ( product_qty == '' ){
						error = true;
						error_txt += "You should input product lot size.<br/>";
					} else if ( !isNumDot(product_qty) ){
						error = true;
						error_txt += "You should input valid lot size. lot size is numeric.<br/>";
					}
				});
				
				var $list = $("#sizetableWholesale :input[name='lprice[]']");
				$list.each(function(){
					product_price = $(this).val();
					if ( product_price == '' ){
						error = true;
						error_txt += "You should input product price.<br/>";
					} else if ( !isNumDot(product_price) ){
						error = true;
						error_txt += "You should input valid price. Price is numeric.<br/>";
					}
				});
			} 	
			
			if ( error ) {
				$("#postsize_errorl").html(error_txt);
				$("#postsize_errorl").slideDown();
				setTimeout(function(){$("#postsize_errorl").slideUp();$("#postsize_errorl").html('');}, 2000);
				return false;
			}
			
			$('#sizetableWholesale tbody > tr:last').after('<tr><td>Size</td><td><input type="text" name="lsize[]" style="width:70px;margin-right:15px;"/></td><td>Color</td><td><input type="hidden" name="plcolor[]" value="ffffff"/><span  class="plcolorv" alt="Please click to choose color" style="display:inline-block;padding:3px 15px;cursor:pointer;background-color:#fff;border:1px solid #999;margin-left:10px;vertical-align:top;">color</span></td><td>Lot size</td><td><input type="text" name="lotsize[]" style="width:70px;margin-right:15px;"/></td><td>Available Lots</td><td><input type="text" name="alotsize[]" style="width:70px;margin-right:15px;"/></td><td>MSRP</td><td><input type="text" name="mpprice[]"/></td><td>Lot Price</td><td><input type="text" name="lprice[]"/></td><td><input type="button"  value=" Add " name="pladd" id="pladd"/></td><td><input type="button"  value=" Delete " name="pldelete" id="pldelete"/></td></tr>');
			$('#sizetableWholesale tbody > tr:last').find("input[name='pladd']").remove();
		});
		
		$(".dialog").dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',
			height: 'auto'
		});
		
		var cObj = null;
		var csObj = null;
		$(".pcolorv").live("click", function (e, index) {
			cObj = $(this).parent().find("input[name='pcolor[]']");
			csObj = $(this);
			$("#color_dlg").dialog('open');	
		});
		
		$(".plcolorv").live("click", function (e, index) {
			cObj = $(this).parent().find("input[name='plcolor[]']");
			csObj = $(this);
			$("#color_dlg").dialog('open');	
		});
		
		$("#color_view").click(function(){
			$("#color_dlg").dialog('open');	
		});
		

		$("#color").jPicker({}, 
			function(color, context){
				
				var hex_color = color.val('hex');
				$("#product_color").val(hex_color);
				if(cObj)
					cObj.val(hex_color);
				$("#color_view").css('background-color', '#'+hex_color);
				if(csObj)
					csObj.css('background-color', '#'+hex_color);
				$("#color_dlg").dialog('close');
			},
			function(){
			
			},
			function(){
				$("#color_dlg").dialog('close');
			});

		$.jPicker.List[0].color.active.val('hex', 'FFFFFF');	
		
		$("#catId00").live('change', function(){
			var id = $(this).val();
			$("#catIdp").val(id);
			$("#selectedCat").text( $(this).find('option:selected').text() );
			if ($("#catId11").length)
				$("#catId11").remove();
			if ($("#catId22").length)
				$("#catId22").remove();
			if ($("#catId33").length)
				$("#catId33").remove();
			if ( $(this).find('option:selected').hasClass('parent') )
			{
				$.get(
					base_url + 'product/getChildCats/' + id,
					function(res){
						if ( res.has )
						{
							var categories = res.data;
							var $cate_select = $("<select id='catId11' size='13' class='postCategory'></select>");
							for( var i in categories )
							{
								var category = categories[i];
								if ( category.child )
								{
									var $option = $("<option value='" + category.id + "' class='parent'>"+category.name+ " >" + "</option>");
								}
								else
								{
									var $option = $("<option value='" + category.id + "' class='child'>"+category.name+"</option>");
								}
								
								$cate_select.append($option);
							}

							
							$("#postCategoriesProduct").append($cate_select);
						}
					}
				);
			}
		});

		$("#catId11").live('change', function(){
			var id = $(this).val();
			$("#catIdp").val(id);
			$("#selectedCat").text( $("#catId00").find('option:selected').text() + " " + $(this).find('option:selected').text() );
			if ($("#catId22").length)
				$("#catId22").remove();
			if ($("#catId33").length)
				$("#catId33").remove();
			if ( $(this).find('option:selected').hasClass('parent') )
			{
				$.get(
					base_url + 'product/getChildCats/' + id,
					function(res){
						if ( res.has )
						{
							var categories = res.data;
							var $cate_select = $("<select id='catId22' size='13' class='postCategory'></select>");
							for( var i in categories )
							{
								var category = categories[i];
								if ( category.child )
								{
									var $option = $("<option value='" + category.id + "' class='parent'>"+category.name+ " >" + "</option>");
								}
								else
								{
									var $option = $("<option value='" + category.id + "' class='child'>"+category.name+"</option>");
								}
								
								$cate_select.append($option);
							}

							$("#postCategoriesProduct").append($cate_select);
						}
					}
				);
			}
		});

		$("#catId22").live('change', function(){
			var id = $(this).val();
			$("#catIdp").val(id);
			$("#selectedCat").text( $("#catId00").find('option:selected').text() + " " + $("#catId11").find('option:selected').text() + " " + $(this).find('option:selected').text() );
			if ($("#catId33").length)
				$("#catId33").remove();
			if ( $(this).find('option:selected').hasClass('parent') )
			{
				$.get(
					base_url + 'product/getChildCats/' + id,
					function(res){
						if ( res.has )
						{
							var categories = res.data;
							var $cate_select = $("<select id='catId33' size='13' class='postCategory'></select>");
							for( var i in categories )
							{
								var category = categories[i];
								if ( category.child )
								{
									var $option = $("<option value='" + category.id + "' class='parent'>"+category.name+ " >" + "</option>");
								}
								else
								{
									var $option = $("<option value='" + category.id + "' class='child'>"+category.name+"</option>");
								}
								
								$cate_select.append($option);
							}

							
							$("#postCategoriesProduct").append($cate_select);
						}
					}
				);
			}
		});

		$("#catId33").live('change', function(){
			var id = $(this).val();
			$("#catIdp").val(id);
			$("#selectedCat").text( $("#catId00").find('option:selected').text() + " " + $("#catId11").find('option:selected').text() + " " + $("#catId22").find('option:selected').text() + " " + $(this).find('option:selected').text() );
		});

		var useraddress = "<?php echo $useraddresses?>";
		if ( !useraddress )
		{
			$(".postProductContent input, select").attr('disabled', true);
		}
		
		$("#product_auction").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#oColorDiv").show();
				$("#productsizediv").hide();
				$("#fixedpricespan").show();
				$("#quantityspan").show();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").show();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").hide();
				$("#spnShippingInfo").hide();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").hide();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#fixedpricespan").hide();
				$("#subscriptionspan").hide();
				$("#auctionpricespan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', true);
				$("#product_quantity").css('background-color','#e9e9e9');
			}	
		});

		$("#product_fix").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#oColorDiv").hide();
				$("#productsizediv").show();
				$("#fixedpricespan").hide();
				$("#quantityspan").hide();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").show();
				$("#postTypeAll").show();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").hide();
				$("#spnShippingInfo").hide();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").hide();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#auctionpricespan").hide();
				$("#subscriptionspan").hide();
				//$("#fixedpricespan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
			}
		});
		
		
		$("#product_classified").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#oColorDiv").show();
				$("#productsizediv").hide();
				$("#fixedpricespan").show();
				$("#quantityspan").show();
				$("#bestofferpan").show();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").show();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").hide();
				$("#spnShippingInfo").hide();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").hide();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#auctionpricespan").hide();
				$("#subscriptionspan").hide();
				$("#fixedpricespan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
			}
		});
		
		$("#product_subscription").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#oColorDiv").show();
				$("#productsizediv").hide();
				$("#fixedpricespan").show();
				$("#quantityspan").show();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").show();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").hide();
				$("#spnShippingInfo").hide();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").hide();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#auctionpricespan").hide();
				$("#fixedpricespan").show();
				$("#subscriptionspan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
			}
		});
		
		$("#product_wholesale").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#productsizediv").hide();
				$("#fixedpricespan").show();
				$("#oColorDiv").hide();
				$("#quantityspan").show();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").hide();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").hide();
				$("#spnShippingInfo").show();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").show();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#auctionpricespan").hide();
				$("#fixedpricespan").show();
				$("#subscriptionspan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
			}
		});
		
		$("#product_liquidation").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#oColorDiv").show(); 
				$("#productsizediv").hide();
				$("#fixedpricespan").show();
				$("#quantityspan").show();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").hide();
				$("#postTypeLiquidation").show();
				$("#spnShippingInfo").show();
				$("#buyIndShipping").hide();
				$("#postTypeWholesale, #sellUnitsIndividuallyDiv").hide();
				$("#sellUnitsIndividually").attr('checked',false);
				$("#auctionpricespan").hide();
				$("#fixedpricespan").show();
				$("#subscriptionspan").show();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
			}
		});
		$("#sellUnitsIndividually").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#productsizediv").show();
				$("#fixedpricespan").hide();
				$("#quantityspan").hide();
				$("#bestofferpan").hide();
				$("#discountBuyNowDiv").hide();
				$("#postTypeAll").show();
				$("#postTypeLiquidation").hide();
				$("#buyIndShipping").show();
				$("#auctionpricespan").hide();
				$("#subscriptionspan").hide();
				$("#product_quantity").val('1');
				$("#product_quantity").attr('readonly', false);
				$("#product_quantity").css('background-color','#fff');
				
			}else{
				$("#productsizediv").hide();
				$("#postTypeAll").hide();
				$("#buyIndShipping").hide();
				$("#discountBuyNowDiv").hide();
			}
		});
		
		$("#billing_period").live('change', function(){
			var value = $(this).val();
			console.log('billing_period: ' + value);
			switch ( value )
			{
			case "1":
				console.log('asdfasasdf');
				$("#billing_endterm_type_txt").text('days');
				break;
			case "2":
				$("#billing_endterm_type_txt").text('weeks');
				break;
			case "3":
				$("#billing_endterm_type_txt").text('months');
				break;
			case "4":
				$("#billing_endterm_type_txt").text('years');
				break;
			}
		});
		$("#e_product").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#e_product_body").slideDown();
			}
			else
			{
				$("#e_product_body").slideUp();
			}
		});

		$("#free_shipping").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#shipping_price").val('0.00');
				$("#in_shipping_price").val('0.00');
				$("#shipping_price").attr('readonly', true);
				$("#in_shipping_price").attr('readonly', true);
				$("#shipping_price").css('background-color', '#e9e9e9');
				$("#in_shipping_price").css('background-color', '#e9e9e9');
			}
			else
			{
				$("#shipping_price").val('');
				$("#shipping_price").attr('readonly', false);
				$("#shipping_price").css('background-color', 'white');
				$("#in_shipping_price").val('');
				$("#in_shipping_price").attr('readonly', false);
				$("#in_shipping_price").css('background-color', 'white');
				$("#shipping_price").focus();
			}
			
		});
		
		$("#free_shipping_b").click(function(){
			if ( $(this).attr('checked') == 'checked' )
			{
				$("#shipping_price_b").val('0.00');
				$("#shipping_price_b").attr('readonly', true);
				$("#shipping_price_b").css('background-color', '#e9e9e9');
				$("#in_shipping_price_b").val('0.00');
				$("#in_shipping_price_b").attr('readonly', true);
				$("#in_shipping_price_b").css('background-color', '#e9e9e9');
			}
			else
			{
				$("#shipping_price_b").val('');
				$("#shipping_price_b").attr('readonly', false);
				$("#shipping_price_b").css('background-color', 'white');
				$("#in_shipping_price_b").val('');
				$("#in_shipping_price_b").attr('readonly', false);
				$("#in_shipping_price_b").css('background-color', 'white');
				$("#shipping_price_b").focus();
			}
			
		});



		$("#uploadPicture").click(function(){
			$("#pictureAction").val('new');
			$("#picture_dlg").dialog('open');
		});

		$("#uploadPictureOK_btn").click(function(){
			var picture_action = $("#pictureAction").val();
			var picture_id = $("#pictureID").val();
			$.ajaxFileUpload({
				url:base_url + 'product/ajax_pictureUpload',
				secureuri:false,
				fileElementId:'upload_picture',
				dataType: 'JSON',
				data:{'file_field': 'upload_picture'},
				success: function (res)
				{
					
					
					var restype = res.substr(0,9);
					if ( restype == '##error##' )
					{
						res = res.substr(9);
						alert(res);
					}
					else
					{
						if ( picture_action == 'new' )
						{
							if ($("#product_picture1").val() == '')
							{
								$("#product_picture1").val(res);
								$("#postPicture1").html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
								$("#changePicture_btn1").show();
							}
							else if ($("#product_picture2").val() == '')
							{
								$("#product_picture2").val(res);
								$("#postPicture2").html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
								$("#changePicture_btn2").show();
							}
							else if ($("#product_picture3").val() == '')
							{
								$("#product_picture3").val(res);
								$("#postPicture3").html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
								$("#changePicture_btn3").show();
							}
							else if ($("#product_picture4").val() == '')
							{
								$("#product_picture4").val(res);
								$("#postPicture4").html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
								$("#changePicture_btn4").show();
							}
							else if ($("#product_picture5").val() == '')
							{
								$("#product_picture5").val(res);
								$("#postPicture5").html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
								$("#changePicture_btn5").show();
							}
						}
						else if ( picture_action == 'change' )
						{
							$("#product_picture"+picture_id).val(res);
							$("#postPicture"+picture_id).html('<img src="'+base_url+'content/uploads/products/pictures/thumb150_'+res+'">');
							$("#changePicture_btn"+picture_id).show();
						}
					}
				
				}
			});	
			$("#picture_dlg").dialog('close');
		});
		
		$("#uploadPictureCancel_btn").click(function(){
			$("#picture_dlg").dialog('close');
		});

		$(".changePicture").click(function(){
			var id = $(this).attr('link');
			$('#pictureAction').val('change');
			$("#pictureID").val(id);
			$("#picture_dlg").dialog('open');
		});
		
		$("#product_no_discount").click(function(){
			$('#discountBuyNowDetailDiv').hide();
		});
		
		$("#product_discount").click(function(){
			$('#discountBuyNowDetailDiv').show();
		});
		
		$("#shipping_method").change(function(){
			if($(this).val() == "Pickup"){
				$("#shipping_price").val('0.00');
				$("#in_shipping_price").val('0.00');
				$("#shipping_price").attr('readonly', true);
				$("#in_shipping_price").attr('readonly', true);
				$("#shipping_price").css('background-color', '#e9e9e9');
				$("#in_shipping_price").css('background-color', '#e9e9e9');
			}
			else
			{
				$("#shipping_price").val('');
				$("#shipping_price").attr('readonly', false);
				$("#shipping_price").css('background-color', 'white');
				$("#in_shipping_price").val('');
				$("#in_shipping_price").attr('readonly', false);
				$("#in_shipping_price").css('background-color', 'white');
				$("#shipping_price").focus();
			}
		});
		
		$("#shipping_method_b").change(function(){
			if($(this).val() == "Pickup"){
				$("#shipping_price_b").val('0.00');
				$("#in_shipping_price_b").val('0.00');
				$("#shipping_price_b").attr('readonly', true);
				$("#in_shipping_price_b").attr('readonly', true);
				$("#shipping_price_b").css('background-color', '#e9e9e9');
				$("#in_shipping_price_b").css('background-color', '#e9e9e9');
			}
			else
			{
				$("#shipping_price_b").val('');
				$("#shipping_price_b").attr('readonly', false);
				$("#shipping_price_b").css('background-color', 'white');
				$("#in_shipping_price_b").val('');
				$("#in_shipping_price_b").attr('readonly', false);
				$("#in_shipping_price_b").css('background-color', 'white');
				$("#shipping_price_b").focus();
			}
		});
	})

</script>
<script>
$("#typeticket").change(function(){
	var typeticket	=	$('#typeticket').val();
if(typeticket	==0){
		window.location.href = base_url + 'post';
		//$("#productpage").show();
		//$("#eventpage").hide();
		//$("#pe").text('Post Product');
	}else if(typeticket	==1){
		window.location.href = base_url + 'postevent';
		//$("#eventpage").show();
		//$("#productpage").hide();
		//$("#pe").text('Post Event');
	} else if(typeticket	==2){
		window.location.href = base_url + 'postauto';
		//$("#eventpage").show();
		//$("#productpage").hide();
		//$("#pe").text('Post Event');
	} else if(typeticket	==3){
		window.location.href = base_url + 'postboat';
		//$("#eventpage").show();
		//$("#productpage").hide();
		//$("#pe").text('Post Event');
	} else if(typeticket	==4){
		window.location.href = base_url + 'postrealstate';
		//$("#eventpage").show();
		//$("#productpage").hide();
		//$("#pe").text('Post Event');
	} else if(typeticket	==5){
		window.location.href = base_url + 'posteproduct';
	}
	
});

function myDiscountFunction(ele){
	if(ele.value == 1){
		$('#spnMinBuy').hide();
		$('#spnDiscountAmt').show();
		$('#spnDiscountType').show();
		$('#spnPerProduct').hide();
		$('#spnOfProductQtyOf').hide();
		$('#spnOfProductQty').hide();
		$('#spnUserProduct').hide();
		$('#spnDuration').show();
	} else if(ele.value == 2){
		$('#spnMinBuy').show();
		$('#spnDiscountAmt').show();
		$('#spnDiscountType').show();
		$('#spnPerProduct').show();
		$('#spnOfProductQtyOf').hide();
		$('#spnOfProductQty').hide();
		$('#spnUserProduct').hide();
		$('#spnDuration').show();
	} else if(ele.value == 3){
		$('#spnMinBuy').show();
		$('#spnDiscountAmt').hide();
		$('#spnDiscountType').hide();
		$('#spnPerProduct').hide();
		$('#spnOfProductQtyOf').hide();
		$('#spnOfProductQty').show();
		$('#spnUserProduct').hide();
		$('#spnDuration').show();
	} else if(ele.value == 4){
		$('#spnMinBuy').show();
		$('#spnDiscountAmt').show();
		$('#spnDiscountType').show();
		$('#spnPerProduct').show();
		$('#spnOfProductQtyOf').show();
		$('#spnOfProductQty').show();
		$('#spnUserProduct').show();
		$('#spnDuration').show();
	}
}

function enabledKey(id){
	if(id ==0){
		$("#product_access_key").val('');
		$("#product_access_key").attr('disabled',true);
	}
	if(id ==1){
		$("#product_access_key").attr('disabled',false);
		$("#product_access_key").blur(function(){
			  $.post("product/ajax_checkprivatekey",{key:$(this).val()},function(data)
			  {
				 	if(data == 1){
						alert("Private key already exist");
						$( "#product_access_key" ).val('');
						$( "#product_access_key" ).focus();	
					} else if(data == 2){
						alert("Please enter private key.");
						$( "#product_access_key" ).val('');
						$( "#product_access_key" ).focus();	
					}
			  });
  		});
	}

}

function gaq(){
	var temp_cat = $("#catId00").val();
	var temp_ship = $("#shipping_method").val();
	var temp_product = $("input[name='product_type'] :checked").val();
	_gaq.push(['_trackEvent', 'Post Product', [temp_cat], [temp_ship], [temp_product]['<?php echo $userdata['username']; ?>']  ]);
	//_gaq.push(['_trackEvent', 'Post Product', '['+temp_cat+']', '['+temp_ship+']', '['+temp_product+']['<?php echo $userdata['username']; ?>+'] ]);
}
$(function(){
	var userid = "7";
	print_country('seller_country');

	var country = "<?php echo $seller_country; ?>";
	var state = "<?php echo $seller_state; ?>";

	if ( country )
	{

		setIndexCountry('seller_country', 'seller_state', country, state);
	}
	
	$("#seller_country").change(function(){
		var country = $(this).val();
		$("#psrh_country").val(country);
		$("#country_form").submit();
	});

	$("#seller_state").change(function(){
		var state = $(this).val();
		$("#psrh_state").val(state);
		$("#country_form").submit();
	});
	
	$("#position").change(function(){
		var state = $(this).val();
		$("#psrh_position").val(state);
		$("#country_form").submit();
	});
	$("#cate").change(function(){
		var state = $(this).val();
		$("#psrh_cate").val(state);
		$("#country_form").submit();
	});
	$("#sub_cate").change(function(){
		var state = $(this).val();
		$("#psrh_sub_cate").val(state);
		$("#country_form").submit();
	});
	$("#transaction_type").change(function(){
		var state = $(this).val();
		$("#psrh_transaction_type").val(state);
		$("#country_form").submit();
	});
	$("#campaign").blur(function(){
		var state = $(this).val();
		$("#psrh_campaign").val(state);
		$("#country_form").submit();
	});
	
	$("#link").blur(function(){
		var state = $(this).val();
		$("#psrh_link").val(state);
		$("#country_form").submit();
	});
	
	$("#duration").change(function(){
		var state = $(this).val();
		$("#psrh_duration").val(state);
		$("#country_form").submit();
	});

	$("#zipcode").change(function(){
		var state = $(this).val();
		$("#psrh_zipcode").val(state);
		$("#country_form").submit();
	});

	$('#post_form').submit(function(){
		if($('#campaign').val() == ''){
			alert('Campaign name required!');
			return false;
		}
		if($('#seller_country').val() == ''){
			alert('Please select Country!');
			return false;
		}
		if($('#seller_state').val() == ''){
			alert('Please select state!');
			return false;
		}
		if($('#zipcode').val() == ''){
			alert('Zipcode is required!');
			return false;
		}
		if($('#position').val() == ''){
			alert('Please select Position type!');
			return false;
		}
		if($('#transaction_type').val() == '0'){
			alert('Please select transaction type!');
			return false;
		}
		if($('#cate').val() == ''){
			alert('Please select category!');
			return false;
		}
		if($('#sub_cate').val() == ''){
			alert('Please select sub category!');
			return false;
		}
		if($('#duration').val() == '00'){
			alert('Please select duration!');
			return false;
		}
		if($('#link').val() == ''){
			alert('Please enter link!');
			return false;
		}
		if($('#fakefilepc2').val() == ''){
			alert('Please select an image!');
			return false;
		}
		
	});
	
	$('#description').keypress(function(e) {
    var tval = $('#description').val(),
        tlength = tval.length,
        set = 100,
        remain = parseInt(set - tlength);
    $('#descriptionp').text(remain );
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#description').val((tval).substring(0, tlength - 1))
    }
})

});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#banner_preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#filepc2").change(function() {
  readURL(this);
});

</script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script> $.noConflict(); </script>
<script type="text/javascript" src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>   
<script type="text/javascript" src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#banner-list-grid').DataTable({
            "order": [[1, "desc"]]
        });
    }); 
</script>  