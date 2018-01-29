<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 11.12.17
 */

namespace XPat\CrudBundle\Classes;


class HashMap implements \Iterator
{
    private $items = [];

    private $position = 0;

    private $keys = [];

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function put($key,$value){
        if(!isset($this->items[$key])){
            $this->keys[] = $key;
        }
        $this->items[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key){
        if(isset($this->items[$key])){
            return $this->items[$key];
        }
        return null;
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        if(isset($this->items[$key])) {
            unset($this->items[$key]);
            foreach ($this->keys as $index => $value){
                if($value == $key){
                    unset($this->keys[$index]);
                }
            }
        }
    }


    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
       return $this->items[$this->keys[$this->position]];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->keys[$this->position];
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->keys = array_values($this->keys);
        $this->position = 0;
    }
}