<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Db' ) ){
	class WA_Db {
		private $lastRowID;

		function __construct(){}

		/**
		 * 
		 * throw error
		 */
		private function throwError($message,$code=-1){
			throw new Exception($message);
		}

		//------------------------------------------------------------
		// validate for errors
		private function checkForErrors($prefix = ""){
			global $wpdb;
			
			if($wpdb->last_error !== ''){
				$query = $wpdb->last_query;
				$message = $wpdb->last_error;
				
				if($prefix) $message = $prefix.' - <b>'.$message.'</b>';
				if($query) $message .=  '<br>---<br> Query: ' . $query;
				
				$this->throwError($message);
			}
		}

		/**
		 * 
		 * get data array from the database
		 * 
		 */
		public function fetch( $params ){
			extract( $params );
			global $wpdb;
			$tableName = $wpdb->prefix . $tableName;
			
			if( isset( $join ) ){  
				$_join = array();
				foreach( $join as $item ){
					$tableNameJoin = $wpdb->prefix . $item['tableName'];
					array_push( $_join, " JOIN {$tableNameJoin} ON {$item['on']}" );
				}
			}

			$query = "select $select from $tableName";
			if( isset( $join ) ) $query .= ( $_join )? implode( " ", $_join ) : "";
			if( isset( $where ) ) $query .= " where $where";
			if( isset( $orderField ) ) $query .= " order by $orderField";
			if( isset( $groupByField ) ) $query .= " group by $groupByField";
			if( isset( $sqlAddon ) ) $query .= " ".$sqlAddon;
			if( isset( $limit ) ) $query .= " LIMIT " . $limit['start'] . ", " . $limit['count'];
			
			$response = $wpdb->get_results( $query, ARRAY_A );
			
			$this->checkForErrors("fetch");
			
			return($response);
		}

		/**
		 * 
		 * insert variables to some table
		 */
		public function insert( $params ){
			extract( $params );
			global $wpdb;
			$tableName = $wpdb->prefix . $tableName;
			
			$wpdb->insert($tableName, $arrItems);
			$this->checkForErrors("Insert query error");
			
			$this->lastRowID = $wpdb->insert_id;
			
			return($this->lastRowID);
		}

		/**
		 * 
		 * get last insert id
		 */
		public function getLastInsertID(){
			global $wpdb;
			
			$this->lastRowID = $wpdb->insert_id;
			return($this->lastRowID);			
		}
	}
}
?>