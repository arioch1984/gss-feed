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

    public static function world()
    {
        return 'Hello World, Composer!';
    }
}
?>