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
    //Return prodcuts number
    public function add_product($args)
    {
        $this->Products[] = new Product($args);
        return $this->count();
    }
}
?>