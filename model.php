<?php
class Banner_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function addbanner($admindata)
	{
		$this->db->insert('master_banner_type', $admindata);
		$insert_id = $this->db->inserted_id();
		if ( $insert_id ) 
		{
			return $insert_id;
		}
		else
		{
			return false;
		}
	}
	
	function insert_sellerBanner($admindata)
	{
		$test = $this->db->insert('seller_banners', $admindata);
		$insert_id = $this->db->insert_id();
		if ( $insert_id ) 
		{
			return $insert_id;
		}
		else
		{
			return false;
		}
	}
	
	function update_sellerBanner($id, $data)
	{
		$this->db->where('id', $id);
		if ( $this->db->update('seller_banners', $data) )
			return true;
		else
			return false;
		
	}


	function updatebanner($id, $data)
	{
		$this->db->where('id', $id);
		if ( $this->db->update('master_banner_type', $data) )
			return true;
		else
			return false;
		
	}

	function removebanner($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('master_banner_type');
	}
	
	function delete_sellerbanner($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('seller_banners');
	}

	function getbanner($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('master_banner_type');
		if( $query->num_rows() == 1 )
		{
			$rows = $query->result_array();
			return $rows[0];
		}
		else
		{
			return false;
		}
	}
	
	function getSellerBanner($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('seller_banners');
		if( $query->num_rows() == 1 )
		{
			$rows = $query->result_array();
			return $rows[0];
		}
		else
		{
			return false;
		}
	}

	function authAdminuser($name, $password)
	{
		$this->db->where(array('adminname'=>$name, 'password'=>$password));
		$query = $this->db->get('master_banner_type');
		if ( $query->num_rows() == 1 )
		{
			$result_array = $query->result_array();
			return $result_array[0]['id'];
		}
		else
		{
			return false;
		}
	}

	function validAdminmail($mail)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('master_banner_type');
		if ( $query->num_rows() > 0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}	

	function getAllAdminusers()
	{
		$query = $this->db->get('master_banner_type');
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function getBanners()
	{
		$this->db->where('status', 1);
		$query = $this->db->get('master_banner_type');
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function getSellerBanners($uid)
	{
		$this->db->where('uid', $uid);
		$query = $this->db->get('seller_banners');
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function getAllSellerBanners()
	{
		
		$query = $this->db->select('user.username,seller_banners.*,master_banner_type.position_name,master_banner_type.banner_hit,master_banner_type.payment_enabled')
         ->from('seller_banners')
         ->join('user', 'user.id = seller_banners.uid')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position');
		$query = $this->db->get();
		
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function getBannerbytype($type)
	{
		
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('views < banner_hit AND seller_banners.status=1')
                  ->where('position in ('. $type .')')
		  ->order_by("RAND()")
		 ->limit(1, 0);
         
		$query = $this->db->get();
		
		
		
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function gethomepageBanner($catid = '', $pids = '')
	{
		if($catid != '') $txt = ' AND seller_banners.cate = '.$catid.' '; else $txt = '';
		if($pids != ''){ 
			$parentIds = explode(",", $pids);
			$parentIds[] = $catid;
			$parentIds = array_filter($parentIds);
			
			foreach($parentIds as $val){
				$s[] = "'".$val."'";
			}
			
			$txt .= ' OR seller_banners.sub_cate IN ('.implode(",",$s).') '; 
		}
		else $txt .= '';
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('views < banner_hit AND seller_banners.status=1 '.$txt.' AND position = ', 12)
		  ->order_by("modified_on","asc")
		  
		 ->limit(10, 0);
		$query = $this->db->get();
		#echo $sql = $this->db->last_query();die();
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function addview($id)
	{
		$this->db->where('id', $id);
		$this->db->set('views', 'views+1', FALSE);
		$this->db->set('modified_on', time(), FALSE);
		$this->db->update('seller_banners');
		
	}
	
	function addclicks($id)
	{
		$this->db->where('id', $id);
		$this->db->set('clicks', 'clicks+1', FALSE);
		#$this->db->set('modified_on', time(), FALSE);
		return $this->db->update('seller_banners');
	}
	
	function row_delete($id)
	{
	   $this->db->where('id', $id);
	   $this->db->delete('seller_banners'); 
	}
		

		function getblogpageBanner()
	{
	// 	 if($catid != '') $txt = ' AND seller_banners.cate = '.$catid.' '; else $txt = '';
	// 	 if($pids != ''){ 
	// 	 	$parentIds = explode(",", $pids);
	// 	 	$parentIds[] = $catid;
	// 	 	$parentIds = array_filter($parentIds);
			
	// 	 	foreach($parentIds as $val){
	// 	 		$s[] = "'".$val."'";
	// 	 	}
			
	// 	 	$txt .= ' OR seller_banners.sub_cate IN ('.implode(",",$s).') '; 
	// 	 }
	// 	 else $txt .= '';
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('seller_banners.status',1)
		  ->where('seller_banners.position',14)
		  ->where('seller_banners.payment_status',1)
		  ->where('seller_banners.views < master_banner_type.banner_hit')
		  ->order_by("seller_banners.modified_on","asc")
		 ->limit(10, 0);


		$query = $this->db->get();
		#echo $sql = $this->db->last_query();die();
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}

	function getblogpageBannerby_cat($id)
	{
	
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('seller_banners.status',1)
		  ->where('seller_banners.position',16)
		  ->where('seller_banners.cate',$id)
		  ->where('seller_banners.payment_status',1)
		  ->where('seller_banners.views < master_banner_type.banner_hit')
		  ->order_by("seller_banners.modified_on","asc")
		 ->limit(10, 0);


		$query = $this->db->get();
		#echo $sql = $this->db->last_query();die();
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}

	function getblogpageBannerby_user($id)
	{
	
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('seller_banners.status',1)
		  ->where('seller_banners.position',15)
		  ->where('seller_banners.uid',$id)
		  ->where('seller_banners.payment_status',1)
		  ->where('seller_banners.views < master_banner_type.banner_hit')
		  ->order_by("seller_banners.modified_on","asc")
		 ->limit(10, 0);


		$query = $this->db->get();
		#echo $sql = $this->db->last_query();die();
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
	
	function getblogpageBanner_by_uid($id)
	{
	
		$query = $this->db->select('seller_banners.*,master_banner_type.banner_hit')
         ->from('seller_banners')
		 ->join('master_banner_type', 'master_banner_type.id = seller_banners.position')
		  ->where('seller_banners.status',1)
		  ->where('seller_banners.position',16)
		  ->where('seller_banners.uid',$id)
		  ->where('seller_banners.payment_status',1)
		  ->where('seller_banners.views < master_banner_type.banner_hit')
		  ->order_by("seller_banners.modified_on","asc")
		 ->limit(10, 0);


		$query = $this->db->get();
		#echo $sql = $this->db->last_query();die();
		if ( $query->num_rows() > 0 ) 
			return $query->result_array();
		else
			return false;
	}
}