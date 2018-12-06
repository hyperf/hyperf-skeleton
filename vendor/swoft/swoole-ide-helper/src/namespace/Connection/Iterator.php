<?php
namespace Swoole\Connection;

/**
 * @since 4.2.1
 */
class Iterator
{


    /**
     * @return mixed
     */
    public function rewind(){}

    /**
     * @return mixed
     */
    public function next(){}

    /**
     * @return mixed
     */
    public function current(){}

    /**
     * @return mixed
     */
    public function key(){}

    /**
     * @return mixed
     */
    public function valid(){}

    /**
     * @return mixed
     */
    public function count(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $fd [required]
     * @return mixed
     */
    public function offsetExists(int $fd){}

    /**
     * @param $fd [required]
     * @return mixed
     */
    public function offsetGet(int $fd){}

    /**
     * @param $fd [required]
     * @param $value [required]
     * @return mixed
     */
    public function offsetSet(int $fd, $value){}

    /**
     * @param $fd [required]
     * @return mixed
     */
    public function offsetUnset(int $fd){}


}
