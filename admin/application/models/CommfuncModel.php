<?php

class CommfuncModel extends CI_Model
{
	function __Construct()
	{
		parent::__Construct();
		
    }
	
	
	function pagination($total_rec, $current_page=0, $perPage, $url_name)
	{
		$pagination = "" ;
		// if total records are less than per page record then dont show pagination
		if($total_rec<= $perPage)
		{
			return ;
		}
		//Reteieve Current Page number 
		if($current_page<0 || $current_page==0)
		{
			$p = 1 ;
		}
		else
		{
			$p = $current_page ;
		}
		//	Calculate Total Pages
		$total_pages = (int)($total_rec/$perPage) ;
		if( ($total_rec%$perPage) > 0 )
		{
			$total_pages++ ;
		}
		
		//	To show pagination
		if($total_pages >= 1)
		{
			$pagination .= '<div class="pagination">';
			//	FIRST & PRIV LINKS
			if($p>1)
			{
				$pagination .= "<a href='".$url_name."/1'>".lang("FIRST")."</a>&nbsp;" ;
				$pagination .= "<a href='".$url_name."/". ($p-1) ."'>".lang("PREV")."</a>&nbsp;" ;	
			}
			
			// Middle links..
			if( ($p%BEFORE_AFTER_NO) == 0)
			{
				if( ($total_pages - $p) > BEFORE_AFTER_NO)
				{
					$start = $p-BEFORE_AFTER_NO ? $p-BEFORE_AFTER_NO:1 ;
				}
				
				else
				{
					$start = $total_pages - TOTAL_PAGINATION_NO;
					if($start <= 0)
					{
						$start = 1 ;
					}	
				}	
				
				$end = $p+BEFORE_AFTER_NO ;
			}
			else
			{	
				if($p > 9)
				{
					if( ($total_pages - $p) > BEFORE_AFTER_NO)
					{
						$start = $p - BEFORE_AFTER_NO ;
					}
					else
					{
						$start = $total_pages - TOTAL_PAGINATION_NO;
					}		
				$end = $p + BEFORE_AFTER_NO ;
				}
				else
				{	 
				$start = 1 ;
				
				$end = TOTAL_PAGINATION_NO;
				
				}	
			}	
			for($i=$start; $i<=$end && $i<=$total_pages;$i++)
			{
				if($i==$p)
				{
					$pagination .= '<span><a class="active">'.$i.'</a></span> ' ;
				}
				
				else
				{	
					$pagination .= "<a href='".$url_name."/". $i ."'>$i</a>&nbsp;" ;
				}	
			}
			//	NEXT & LAST links
			if($p>=1 && $p<$total_pages)
			{
				$pagination .= "<a href='".$url_name ."/". ($p+1) ."'>".lang("NEXT")."</a>&nbsp;" ;
				$pagination .= "<a href='".$url_name ."/$total_pages'>".lang("LAST")."</a>&nbsp;" ;
			}
		}	//	if($total_pages>1) end.
		
		$pagination .='</div>' ;
		return ($pagination) ;
	}
}
?>