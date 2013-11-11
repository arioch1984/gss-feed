<?php
/*
 * Feed structure class
 */

namespace GSS;

use GSS\Product;

class Feed
{
    private $Products;

    public function __construct(){
        $this->Products = array();
    }

    //Return prodcuts number
    public function count(){
        return count($this->Products);
    }

    //Add single product to the feed
    //Return prodcuts number or false if product won't be added
    public function add_product($args)
    {
        $pre_insert_count = $this->count();
        $this->Products[] = new Product($args);
        $post_insert_count = $this->count();
        if($pre_insert_count >= $post_insert_count){
            return false;
        }
        else{
            return $this->count();
        }
    }

    //Return products array or false if it has no items
    //$type => return as array of arrays or array of objects
    public function get_products($type = 'objects'){
        if($this->count()>0){
            if($type == 'arrays'){
                $products = array();
                foreach($this->Products as $Product){
                    $products[] = $Product->fields;
                }
                return $products;
            }
            else{
                return $this->Products;
            }
        }
        else{
            return false;
        }
    }
}
?>