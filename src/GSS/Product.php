<?php
/*
 * Single product class
 */

namespace GSS;

use Exception;

class Product {

    //Required fields names
    private static $required_fields_names = array('id','title','description','image_link','supplier_product_category',
        'brand','mpn');

    //Recommended fields names
    private static $recommended_fields_names = array('additional_image_link','product_page_url','product_spec_url','price',
        'minimum_order','unit','lead_time');

    //Product fields
    public $fields;

    //Take a relational array as input with an element for each field
    public function __construct($args){
        $tmp_field = array();

        try{
            //Assign required fields
            foreach(self::$required_fields_names as $required_field_name){
                if((isset($args[$required_field_name]))&&(!empty($args[$required_field_name]))){
                    $tmp_field[$required_field_name] = $args[$required_field_name];
                }
                else{
                    throw new Exception('Required field '.$required_field_name.' not present');
                }
            }

            //Assign recommended fields
            foreach(self::$recommended_fields_names as $recommended_field_name){
                if((isset($args[$recommended_field_name]))&&(!empty($args[$recommended_field_name]))){
                    $tmp_field[$recommended_field_name] = $args[$recommended_field_name];
                }
                else{
                    $tmp_field[$recommended_field_name] = '';
                }
            }

            $this->fields = array();
            $this->fields = $tmp_field;
        }
        catch(Exception $e){
            error_log($e->getMessage());
        }
    }

    //Put titles array
    public static function get_titles(){
        $titles = array_merge(self::$required_fields_names,self::$recommended_fields_names);
        return $titles;
    }

}