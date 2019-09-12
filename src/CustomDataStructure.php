<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/3/19
 * Time: 10:47 AM
 */

namespace DedeGunawan\TelpSyncClient;


use DedeGunawan\UtilityClass\DataStructure;

class CustomDataStructure extends DataStructure
{

    function from_camel_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    public function __call($name, $arguments)
    {
        $underscore = $this->from_camel_case($name);
        $left = substr($underscore, 0, 3);
        if (in_array($left, ['set', 'get'])) {
            $real_property = substr($underscore, 4);
            array_unshift($arguments, $real_property);
            return call_user_func_array(array($this, 'setColumn'), $arguments);

        } else {
            return call_user_func_array(array($this, $name), $arguments);
        }

    }
}