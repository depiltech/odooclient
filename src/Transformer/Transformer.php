<?php namespace Odoo\Client\Transformer;

use PhpXmlRpc\Response as xmlrpcresp;
use PhpXmlRpc\Value as xmlrpcval;

class Transformer
{
    /**
     * Transform PhpXmlRpc object to associative array through recursivity
     * @param $value
     * @return array
     */
    public function toArray($value)
    {
        $return = array();

        $value = $value instanceof xmlrpcresp ? $value->value() : $value;

        foreach ($value as $key => $item)
        {
            $item = $item instanceof xmlrpcval ? $item->scalarval() : $item;

            if (is_array($item)) {
                $return[$key] = $this->toArray($item);
            } else {
                $return[$key] = $item;
            }
        }

        return $return;
    }
}
