<?php 
Namespace Model;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Currency MOdle
*
* @author   Kamaro  Lambert
* @access	public

*/
Use \Gas\Core;
Use \Gas\ORM;

Class Locations_model extends ORM
{
	public $table       ="locations";
	public $primary_key ="location_id";
	
	function _init()
	{
	    self::$fields = array(
	    		 'location_id'               => ORM::field('auto[30]'),
                 'name'                      => ORM::field('string'),
                 'address'                   => ORM::field('string'),
                 'phone'                     => ORM::field('string'),
                 'fax'                       => ORM::field('string'),
                 'email'                     => ORM::field('email[40]'),
                 'receive_stock_alert'       => ORM::field('string'),
                 'stock_alert_email'         => ORM::field('string'),
                 'return_policy'             => ORM::field('string'),
                 'timezone'                  => ORM::field('string'),
                 'default_tax_1_rate'        => ORM::field('string'),
                 'default_tax_1_name'        => ORM::field('string'),
                 'default_tax_2_rate'        => ORM::field('string'),
                 'default_tax_2_name'        => ORM::field('string'),
                 'default_tax_3_rate'        => ORM::field('string'),
                 'default_tax_3_name'        => ORM::field('string'),
                 'default_tax_4_rate'        => ORM::field('string'),
                 'default_tax_4_name'        => ORM::field('string'),
                 'default_tax_5_rate'        => ORM::field('string'),
                 'default_tax_5_name'        => ORM::field('string'),
                 'deleted'                   => ORM::field('string'),
	    		);	
	    $this->ts_fields = array('Date');
	    

	}
}