<?php

	class myObj
	{
		private $filter_object;
		private $filter_guid;
		private $filter_keyword;
		private $filter_category;
		private $filter_link;
		private $filter_switch; 

        /// <summary>
        ///  001                 
        /// </summary>
        /// <param name="jsonString"></param>
		public function __construct($filter_object = "", $filter_guid= "", $filter_keyword="", $filter_category=""  , $filter_link="", $filter_switch="", $filter_custom="" ) 
		{
			//echo  "-".$filter_object."-".$filter_category."--</br>";

			settype ( $this->guid , "string" );					
			settype ( $this->name , "string" );								
			settype ( $this->description , "string" );	
			settype ( $this->table_name , "string" );		
			settype ( $this->category_guid , "string" );
			settype ( $this->theme , "string" );
			settype ( $this->type_of_view , "string" );		
			
			settype ( $this->is_searchable , "bool" );			
			settype ( $this->has_categories , "bool" );					
			settype ( $this->is_expandable , "bool" );			
			settype ( $this->has_details , "bool" );				
			settype ( $this->has_files , "bool" );	
			settype ( $this->allow_view , "bool" );
			settype ( $this->allow_edit , "bool" );			
			settype ( $this->allow_copy , "bool" );
			settype ( $this->allow_delete , "bool" );	
			
			settype ( $this->applyOn , "array" );
			settype ( $this->fields_of_view , "string" );			
			settype ( $this->detailObjects , "array" );			
			settype ( $this->field_name , "array" );
			settype ( $this->field_desc , "array" );
			settype ( $this->field_indx, "array" );
			settype ( $this->field_type , "array" );
			settype ( $this->field_link , "array" );
			settype ( $this->field_liiD , "array" );
			settype ( $this->field_trns , "array" );
			settype ( $this->field_orde , "array" );
			settype ( $this->field_grou , "array" );
			
			settype ( $this->field_valu , "array" );
			
			settype ( $this->modificationdate , "string" );
		//	echo  "-category-".$filter_category."--</br>";
			try
			{
				$this->filter_object =$filter_object ;
				$this->filter_guid = $filter_guid;
				$this->filter_keyword = $filter_keyword;
				$this->filter_category = $filter_category;
				$this->filter_link = $filter_link;
				$this->filter_switch = $filter_switch;
				$this->filter_custom = $filter_custom;
				if(isset($this->filter_object) AND $this->filter_object <>"")
				{
					$this->GetObjectProperties() ;
					//$this->GetObjectdetails();
					$this->GetObjectFieldsProperties();
					$this->GetObjectValues( $filter_guid, $filter_keyword, $filter_category,  $filter_link, $filter_switch, $filter_custom);
				}
			}
			catch(Exception $e)
			{
				echo "Error 001";
			}
		}  /////__construct

		///<summary>
		/// Checks for new records
		///</summary>
		public function Refresh()
		{		
			try
			{
				if(isset($this->filter_object) AND $this->filter_object <>"")
				{
					$this->GetObjectValues();
				}
			}
			catch(Exception $e)
			{
				echo "Error 002";
			}
		}/////__Refresh

		///<summary>
		///
		///</summary>
		public function SaveMe( $obj)
		{
			$query = "";
			$ins_tmp_keys = "";
			$ins_tmp_values= "";
			$upd_tmp= "";
			try
			{			
				 $this->guid						= $obj->guid	;
				 $this->name					= $this->name	;		
				 $this->description 			= $obj->description	;
				 $this->table_name 		= $obj->table_name	;
				 $this->category_guid		= $obj->category_guid	;
				 $this->theme					= $obj->theme	;
				 $this->type_of_view 		= $obj->type_of_view	;
				
				 $this->is_searchable 	=	$obj->is_searchable	;
				 $this->has_categories 	=	$obj->has_categories	;		
				 $this->is_expandable 	=	$obj->is_expandable	;
				 $this->has_details 		=	$obj->has_details	;
				 $this->has_files				=	$obj->has_files	;
				 $this->allow_view			= $obj->allow_view	;
				 $this->allow_edit 			= $obj->allow_edit	;
				 $this->allow_copy			= $obj->allow_copy	;
				 $this->allow_delete 		= $obj->allow_delete	;
				/*
				 $this->applyOn				= array_reverse($obj->applyOn, false)	;
				 $this->fields_of_view 	=	 array_reverse($obj->fields_of_view, false)	;	
				 $this->detailObjects 		=	 array_reverse($obj->detailObjects, false)	;
				 $this->field_name			= array_reverse( $obj->field_name, false)	;
				 $this->field_desc			=  $obj->field_desc	;
				 $this->field_type				=  array_reverse($obj->field_type	, false);
				 $this->field_link				=  array_reverse($obj->field_link, false)	;
				 $this->field_liiD				= array_reverse( $obj->field_liiD, false)	;
				 $this->field_trns				=  array_reverse($obj->field_trns	, false);
				 $this->field_orde			=  array_reverse($obj->field_orde, false)	;
				 $this->field_grou			=  array_reverse($obj->field_grou, false)	;
				*/

				 $this->applyOn				= $obj->applyOn	;
				 $this->fields_of_view 	=	 $obj->fields_of_view		;
				 $this->detailObjects 		=	 $obj->detailObjects	;
				 $this->field_name			=  $obj->field_name	;
				 $this->field_desc			=  $obj->field_desc	;
				 $this->field_type				=  $obj->field_type	;
				 $this->field_link				=  $obj->field_link	;
				 $this->field_liiD				=  $obj->field_liiD	;
				 $this->field_trns				=  $obj->field_trns	;
				 $this->field_orde			=  $obj->field_orde	;
				 $this->field_grou			=  $obj->field_grou	;

				// $this->field_valu				= $obj->field_valu	;

				$this->field_valu = json_decode(json_encode($obj->field_valu), true);
				//$this->field_valu =array_reverse($this->field_valu, false)	;
				 $this->modificationdate = $obj->modificationdate	;

				 if(strpos($this->table_name, "view_")===0)
				 {
					$tbl_nm = substr($this->table_name,strpos($this->table_name, "_")+1);
				 }
				 else
				 {
						$tbl_nm = $this->table_name;
				 }
				 $k = 0;
				 //for($i=0; $i< sizeof($this->field_valu) ; $i++)  //sizeof($this->field_valu)
				 for($i=0; $i< 1 ; $i++)  //sizeof($this->field_valu)
				 {
					$ins_tmp_keys = $tbl_nm .".guid ";
					$ins_tmp_values = " '".$this->field_valu[$i]['guid']."' ";
					$upd_tmp = $tbl_nm.".guid = '".$this->field_valu[$i]['guid']."' ";
						
					for($j=0; $j< sizeof($this->field_name); $j++) 
					{
						if($this->field_desc[$j] <> "guid" AND $this->field_desc[$j] <> "modificationdate"  AND $this->field_type[$j] <> "INFO")
						{
							$ins_tmp_keys .= ", ".$this->field_desc[$j];
							$ins_tmp_values .= ", '".mysql_real_escape_string($this->field_valu[$i][$this->field_desc[$j]])."' ";
								
							$upd_tmp .= ", ".$this->field_desc[$j]." = '". mysql_real_escape_string($this->field_valu[$i][$this->field_desc[$j]])."' ";
						}
					}

					$query = "INSERT INTO ".$tbl_nm."(".$ins_tmp_keys.")  VALUES (".$ins_tmp_values.")   ON DUPLICATE KEY  UPDATE   ".$upd_tmp."  "; 
//echo $query;
					if( $this->ExecuteQueries($query ) ==1)
					{
						$result[$k]=  $this->field_valu[$i]->guid;
						$k++;
					}
				}

				//print_r($result);
				//return $result;
			}
			catch(Exception $e)
			{
				echo "Error 003";
			}
		}// saveMe

		///<summary>
		///	it returns an array with the guids of the records marked deleted   004
		///</summary>
		public function DeleteMe()
		{
			try
			{
				$j = 0;
				for($i=0; $i< sizeof($this->field_valu); $i++) // sizeof($this->field_valu)
				{
					$query =" UPDATE ".$this->table_name." SET deleted = 1 WHERE  ".$this->table_name.".guid = '". $this->field_valu[$i]->guid."' ";
					if($this->ExecuteQueries($query )==1)
					{
						$result[$j]=  $this->field_valu[$i]['guid'];
						$j++;
					}
				}  
				return $result; 
			}
			catch(Exception $e)
			{
				echo "Error 004";
			}
		}// deleteMe


		public function indexByName ($field_name="") 
		{			
			$result = -1;
			for($i=0; $i<  sizeof($this->field_desc); $i++)
			{
				if($this->field_desc [$i] ==  $field_name )
				{
					$result = $i;
				}
			}
			return $result; 
		}


		public function field_valu ($guid="") 
		{		
			$result = clone  $this;
			try
			{
				for($i=sizeof($this->field_valu)-1         ; $i>-1  ; $i--)
				{
					if(! ($this->field_valu[$i]->guid ==  $guid))
					{
						unset($result->field_valu[$i]);
					}
				}
				return $result; 
			}
			catch(Exception $e)
			{
				echo "Error 006";
			return $result; 
			}
		}



		public function crop ($filter_array="") 
		{			
			$result = clone  $this;
			try
			{
				for($i=sizeof($this->field_valu)-1         ; $i>-1  ; $i--)
				{
					for($y=0; $y<  sizeof($filter_array); $y++)
					{
						switch($filter_array[ "operator_defines_crop"][$y])
						{
							case ">=":
								if(! ($this->field_valu[$i]-> $filter_array[ "field_defines_crop"][$y] >= $filter_array[ "value_defines_crop"][$y] ))
								{
									unset($result->field_valu[$i]);
								}
									break;
							case "<" :
								if(! ($this->field_valu[$i]-> $filter_array[ "field_defines_crop"][$y] < $filter_array[ "value_defines_crop"][$y] ))
								{
									unset($result->field_valu[$i]);
								}
								break;
							case "==":
								if(! ($this->field_valu[$i]-> $filter_array[ "field_defines_crop"][$y] ==  $filter_array[ "value_defines_crop"][$y] ) OR  $this->field_valu[$i]-> $filter_array[ "field_defines_crop"][$y] =="")
								{
									//echo "--".$result->field_valu[$i]->$filter_array[ "field_defines_crop"][$y]."==".$filter_array[ "value_defines_crop"][$y]."--</br>";
									unset($result->field_valu[$i]);
								}
								else
							{
									//echo $i."--".$y."--".$result->field_valu[$i]->$filter_array[ "field_defines_crop"][$y]."==".$filter_array[ "value_defines_crop"][$y]."--</br>";
							}
								break;
							default:
						//unset($result->field_valu[$i]);
						//echo "--OBJECT DID NOT CROP--";

						}
/*

						if(! $this->field_valu[$i]-> $filter_array[ "field_defines_crop"][$y].$filter_array[ "operator_defines_crop"][$y]." '". $filter_array[ "value_defines_crop"][$y]."' "   )
						{
							unset($result->field_valu[$i]);
						}*/
					}
				}

//print_r($result);

			$result->field_valu = array_values($result->field_valu); 

			return $result; 
			}
			catch(Exception $e)
			{
				echo "Error 005";
			return $result; 
			}
		}





//----------------------------------------------------------------- private functions -------------------------------------------------------------------\\
		/// <summary>
        ///  001.000
        /// </summary>
		/// <param name="query">the query to be executed</param>
		private function ExecuteQueries($query = "") 
		{	
			try
			{
				include('../'.$_SESSION['my_client_domain'].'/Connections/InternalSiteDB.php');
				mysql_select_db($database_InternalSiteDB, $InternalSiteDB);
				mysql_query("SET NAMES utf8") or die(mysql_error());
				mysql_query("SET CHARACTER SET utf8") or die(mysql_error());	
			
				if(    strpos(trim($query), "SELECT")==0   )
				{
					$recordset = mysql_query($query, $InternalSiteDB) or die(mysql_error());
				}
				else
				{
					mysql_query($query, $InternalSiteDB) or die(mysql_error());
				}
				//echo $totalRows_Recordset = mysql_num_rows($recordset);	
				return $recordset;
			}
			catch(Exception $e)
			{
				return null;
			}
		}		
        /// <summary>
        ///  001.001                 
        /// </summary>
		private function GetObjectProperties() 
		{	
			try
			{
					//echo "</BR>--".$this->filter_object."-</BR>";
					//$this->filter_object = str_replace(PHP_EOL, '', $this->filter_object);


				$query =" 	SELECT guid, description, object, table_name, category_guid, applyOn, is_searchable,	has_categories,	
					is_expandable, has_details, has_files,	type_of_view, fields_of_view, theme, 	allow_view,	allow_edit, 
					allow_copy, allow_delete, 	modificationdate 
				FROM  `_objects` 
				WHERE `_objects`.`name`  = '".$this->filter_object."'  OR   `_objects`.`guid` ='".$this->filter_object."' ";
//echo "</BR>".$query;
				$recordset = $this->ExecuteQueries($query); 
				$totalRows_Recordset = mysql_num_rows($recordset);	
				
				if($totalRows_Recordset == 0)
				{
					echo "Error 001.001</BR>";
					echo $query_Recordset." <BR>";
					echo "System error on loading object.<BR>No records found on _objects having name like ".$this->filter_object." OR guid ".$this->filter_object." <BR>";
					echo $query_Recordset." <BR>";
				}
				if($totalRows_Recordset > 1)
				{
					echo "Error 001.001</BR>";
					echo $query_Recordset." <BR>";
					echo "System error on loading object<BR>More records found on _objects like ".$this->filter_object." OR ".$this->filter_object." <BR>";
					echo $query_Recordset." <BR>";
				}
				if($totalRows_Recordset == 1)
				{
					$tmp = mysql_fetch_array($recordset, MYSQL_BOTH) ;
					$this->guid = $tmp["guid"];
					$this->name = $tmp["object"];
					$this->description = $tmp["description"];
					$this->table_name = $tmp["table_name"];
					$this->category_guid = $tmp["category_guid"];
					$this->theme =$tmp["theme"];
					$this->type_of_view =$tmp["type_of_view"];
					$this->fields_of_view =$tmp["fields_of_view"];

					if($tmp["is_searchable"] ==1){$this->is_searchable =true;}else{$this->is_searchable =false;}
					if($tmp["has_categories"] ==1){$this->has_categories =true;}else{$this->has_categories =false;}
					if($tmp["is_expandable"] ==1){$this->is_expandable =true;}else{$this->is_expandable =false;}
					if($tmp["has_details"] ==1){$this->has_details =true;}else{$this->has_details =false;}
					if($tmp["has_files"] ==1){$this->has_files =true;}else{$this->has_files =false;}
				
					if($tmp["allow_view"] ==1){$this->allow_view =true;}else{$this->allow_view =false;}
					if($tmp["allow_edit"] ==1){$this->allow_edit =true;}else{$this->allow_edit =false;}
					if($tmp["allow_copy"] ==1){$this->allow_copy =true;}else{$this->allow_copy =false;}
					if($tmp["allow_delete"] ==1){$this->allow_delete =true;}else{$this->allow_delete =false;}

					$this->modificationdate  = $tmp["modificationdate"];			
				}
			}
			catch(Exception $e)
			{
				echo( "Error 001.001</br>".$e->getMessage().''.$e->getTraceAsString().'');
			}
		}
		
		/// <summary>
        ///  001.002
        /// </summary>
		private function GetObjectFieldsProperties()
		{
			try
			{							
				$query_Rcrdst_FLDS ="SELECT `field`,  fieldType, fieldLink, `fieldorder`, `fieldgroup`, descriptionGr FROM  _fielddescr 
				WHERE  `table` = '".$this->table_name."'   ";  
				//ORDER BY  `fieldorder`    ";
				$rcrdst_FLDS = $this->ExecuteQueries($query_Rcrdst_FLDS); 
				$totalRows_Rcrdst_FLDS = mysql_num_rows($rcrdst_FLDS);

				for($i=0; $i< $totalRows_Rcrdst_FLDS; $i++)
				{
					$tmp_FLDS = mysql_fetch_array($rcrdst_FLDS, MYSQL_BOTH) ;

					$this->field_name[$i] = $this->table_name.".".$tmp_FLDS["field"];	
					$this->field_desc[$i] = $tmp_FLDS["field"];	
					//$this->field_indx[ $i] = $i;	
					$this->field_type[ $i] = $tmp_FLDS["fieldType"];	
					$this->field_link[ $i] = $tmp_FLDS["fieldLink"];	
/*
					$this->field_name[$tmp_FLDS["field"]] = $this->table_name.".".$tmp_FLDS["field"];	
					$this->field_desc[$i] = $tmp_FLDS["field"];	
					$this->field_indx[ $tmp_FLDS["field"]] = $i;	
					$this->field_type[ $tmp_FLDS["field"]] = $tmp_FLDS["fieldType"];	
					$this->field_link[ $tmp_FLDS["field"]] = $tmp_FLDS["fieldLink"];	
*/
					//$this->field_liiD[ $tmp_FLDS["field"]] 
					//$this->applyOn[ $tmp_FLDS["field"]] 
					//$this->fields_of_view[ $tmp_FLDS["field"]] 
					//$this->detailObjects[ $tmp_FLDS["field"]] 

					$this->field_trns[  $i] = $tmp_FLDS["descriptionGr"];	
					$this->field_orde[   $i] = $tmp_FLDS["fieldorder"];	
					$this->field_grou[   $i] = $tmp_FLDS["fieldgroup"];	
				}
				//print_r	($this->field_desc);
			}
			catch(Exception $e)
			{
				echo $table_name;
				echo $functionCode;
				echo ' Error Message: ' .$e->getMessage();
			}
		}
		/// <summary>
        ///  001.003
        /// </summary>
		private function GetObjectValues($filter_guid= "", $filter_keyword="", $filter_category="", $filter_link="", $filter_switch=""  , $filter_custom="" )
		{
			for($i=1; $i< sizeof($this->field_desc); $i++)
			{
				$tmp .= ', '.$this->field_desc[$i];
			}

			//echo  "--".$filter_link."--</br>";
			$query = "SELECT ".$this->field_desc[0].$tmp." FROM ".$this->table_name. " ". $this->SearchString($filter_guid, $filter_keyword, $filter_category, $filter_link) ;
			$result = $this->ExecuteQueries($query);
			while ($entry = mysql_fetch_object($result))
			{
			   $a[] = $entry;
			}
			//echo  "</br>";
			//print_r($a);
			$this->field_valu = $a;
		}
		
		/*

		*/

		//----------------------------------------------------------------- CREATE QUERY functions -------------------------------------------------------------------\\

		private function SearchString($guid= "", $keyword="", $category=""  , $link="",  $switch="", $custom="" ) 
		{	
			
			$_SESSION['debug']=0;		
			if(2==1) //if($_SESSION['debug'])		 //
			{
				echo 'guid: '.$guid.' <br>
							keyword:'.$keyword.' <br>
							link:'.$link.' <br>
							category:'.$category.' <br>';
			}		


			$search_string_guid="";
			$search_string_link="";
			$search_string_keyword="";
			$search_string_category="";
			//$search_string_category=" OR category_guid = '".$this->category_guid."' ";
			$search_string = " WHERE 1=1 ";	


		for($i=0; $i< sizeof($this->field_name); $i++)
		{
			//echo $this->field_type[$i] ."-".$this->field_name[$i]."</br>";
			///GUID
			if((($this->field_type[$i] == "GUID") ) AND ($guid != ""))												//or($tmp["fieldType"] == "LINK")
			{
				 $search_string_guid .= " OR ".$this->field_name[$i]." = '".$guid."' ";
			}

			///LINK, MULTILINK
			if((($this->field_type[$i] == "LINK") OR ($this->field_type[$i] == "MULTILINK")) AND ($link != ""))
			{
				//if($tmp["field"]="*")
				{
					//$search_string_link .= " OR ".$tmp["name"]." = '".$link."' ";
				}
				//else
				{
					$search_string_link .= " OR ".$this->field_name[$i]." = '".$link."' ";
				}
			}

			///TEXT&LONGTEXT&INFO
			if((($this->field_type[$i] == "LONGTEXT") 
				OR ($this->field_type[$i] == "TEXT") 
				OR ($this->field_type[$i] == "INFO")
				OR ($this->field_type[$i] == "DATE")) AND ($keyword != ""))
			{
				$search_string_keyword .=" OR ".$this->field_name[$i]." = '".$keyword."' OR ".$this->field_name[$i]." LIKE '%".$keyword."%' OR ".$this->field_name[$i]." LIKE '".$keyword."%' OR ".$this->field_name[$i]." LIKE '%".$keyword."'";
			}					

			///CATEGORY, OBJECT
			if(($this->field_desc[$i] == "category_guid") AND ($this->category_guid!=""))
			{
				$search_string_category .=" OR ".$this->field_name[$i]." = '".$this->category_guid."' ";
			}	
			///CATEGORY, OBJECT
			if(($this->field_type[$i] == "CATEGORY_GUID"
			OR $this->field_type == "OBJECT_GUID") AND ($category!=""))
			{
				$search_string_category .=" OR ".$this->field_name[$i]." = '".$category."' ";
			}						
		}

		///BUILDING $search_string
		if($search_string_guid != "")
		{
			$search_string .= " AND (0=1 ".$search_string_guid." )";
		}
		if($search_string_link!="")
		{
			$search_string .= " AND (0=1 ".$search_string_link." )";
		}
		if($search_string_keyword!="")
		{
			$search_string .= " AND (0=1 ".$search_string_keyword." )";
		}
		if($search_string_category!="")
		{
			$search_string .= " AND (0=1 ".$search_string_category." )";
		}	 
		if($switch != "")
		{
			$search_string .= " ";
		}
		if($custom != "")
		{
			$search_string .= " AND ( ".$custom." )";
		}
		//echo $search_string;
		return $search_string;
		}
	}
?>				
