<?php

namespace App\Common;
/**
 * Configure class for storing and reading global values   
*/
class Configure
{
    /**
     * Config data
     * @var array
    */
    protected static $_configData = [];
    /**
     * Initilize the configure instance. Resets all exisiting items.
    */
    public static function init()
    {
        $_configData = [];
    }
    
    /**
     * Read and return key value. Return null if key does not exist.
     * Support multilayer keys, split by dot.
     * @param string $key dot seperated multilayer key
     * @return value inserted. If key refer to array then the key value array is returned.
    */
    public static function read($key)
    {
        
        if(empty($key))
            return null;
        
        $keyArr = explode('.',$key);
        $tmpData = self::$_configData;
        foreach($keyArr as $currenKey)
        {
            
               if(isset($tmpData[$currenKey]))
               {
                    $tmpData = $tmpData[$currenKey];
                
               }
               else
               {
                    return null;
               }   
        }
        return $tmpData;
    }
    
    /**
     * Write a value or array.
     * @param string $key dot seperated multilayer key
     * @param value stored value
     * @return boolean of success
    */
    public static function write($key,$value)
    {
        if(empty($key))
            return false;
        $keyArr = explode('.',$key);
        
        $storageItem = &self::$_configData;
        
        foreach($keyArr as $currentKey)
        {
            if(!isset($storageItem[$currentKey]))
            {
                $storageItem[$currentKey] = [];
            }
            $storageItem = &$storageItem[$currentKey];
        }
        $storageItem = $value;
        return true;
    }
    /**
     *Check for key existence
     *@param string $key dot seperated multilayer key
     *@param boolean 
    */
    public static function check($key)
    {
        if(empty($key))
            return false;
        $keyArr = explode('.',$key);
        $tmpData = self::$_configData;
        foreach($keyArr as $currentKey)
        {
            if(isset($tmpData[$keyArr]))
            {
                $tmpData = $tmpData[$keyArr];
            }
            else
            {
                return false;;
            }
        }
        return true;
    }
}

?>