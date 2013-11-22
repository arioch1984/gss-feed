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
        $new_product = new Product($args);
        if((!empty($new_product->fields))&&($new_product->fields!=null)){
            $this->Products[] = $new_product;
            return $this->count();
        }
        else{
            return false;
        }
    }

    //Return products arrays or false if it has no items
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

    //Return products arrays or false if it has no items
    public function get_products_not_empty(){
        if($this->count()>0){
            $products = array();
            $key_with_empty_contents = array();
            foreach($this->Products as $index => $Product){
                $products[$index] = array();
                foreach($Product->fields as $key => $field){
                    if(!empty($field)){
                        if(!in_array($key,$key_with_empty_contents)){
                            $products[$index][$key] = $field;
                        }
                    }
                    else{
                        array_push($key_with_empty_contents,$key);
                    }
                }
            }
            return $products;
        }
        else{
            return false;
        }
    }

    //Return products arrays plus header titles or false if it has no items
    public function get_feed_not_empty(){
        if($this->count()>0){
            $feed = array();
            $key_with_empty_contents = array();
            foreach($this->Products as $index => $Product){
                $feed[$index] = array();
                foreach($Product->fields as $key => $field){
                    if(!empty($field)){
                        if(!in_array($key,$key_with_empty_contents)){
                            $feed[$index][$key] = $field;
                        }
                    }
                    else{
                        array_push($key_with_empty_contents,$key);
                    }
                }
            }
            $titles = Product::get_titles();
            $non_empty_titles = array();
            foreach($titles as $title){
                if(!in_array($title,$key_with_empty_contents)){
                    array_push($non_empty_titles,$title);
                }
            }
            array_unshift($feed,$non_empty_titles);

            return $feed;
        }
        else{
            return false;
        }
    }


}
?>