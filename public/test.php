<?php

class ParentA {
    protected $protectedProperty = 12;
    public $publicProperty = 13;
    protected static $protectedStaticProperty = 15;
    public static $publicStaticProperty = 16;
}

class A
{
    private $privateProperty = 1;
    protected $protectedProperty = 2;
    public $publicProperty = 3;
    private static $privateStaticProperty = 4;
    protected static $protectedStaticProperty = 5;
    public static $publicStaticProperty = 6;

    private function privateMethod($arg)
    {
        return $arg . $this->privateProperty;
    }

    protected function protectedMethod($arg)
    {
        return $arg . $this->protectedProperty;
    }

    public function publicMethod($arg)
    {
        return $arg . $this->publicProperty;
    }

    private static function privateStaticMethodSelf($arg)
    {
        return $arg . self::$privateStaticProperty;
    }

    protected static function protectedStaticMethod($arg)
    {
        return $arg . self::$protectedStaticProperty;
    }

    public static function publicStaticMethodSelf($arg)
    {
        return $arg . self::$publicStaticProperty;
    }

    public static function publicStaticMethodStatic($arg)
    {
        return $arg . static::$publicStaticProperty;
    }

    public static function publicStaticMethodParent($arg)
    {
        return $arg . parent::$publicStaticProperty;
    }

    public static function publicStaticMethodClass($arg)
    {
        return $arg . A::$publicStaticProperty;
    }

    public function main()
    {
        $result[] = $this->privateMethod(7);
        $result[] = $this->protectedMethod(8);
        $result[] = $this->publicMethod(9);
        $result[] = static::privateStaticMethodSelf(10);
        $result[] = static::protectedStaticMethod(11);
        $result[] = static::publicStaticMethodSelf(12);
        $result[] = static::publicStaticMethodStatic(13);
        $result[] = static::publicStaticMethodParent(14);
        $result[] = static::publicStaticMethodClass(15);
        return $result;
    }

    public function mix()
    {
        return $this->main();
    }
}

class ProxyA extends A
{

    private $privateProperty = 1;
    protected $protectedProperty = 2;
    public $publicProperty = 3;
    private static $privateStaticProperty = 4;
    protected static $protectedStaticProperty = 5;
    public static $publicStaticProperty = 6;

    private function privateMethod($arg)
    {
        return $this->__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . $this->privateProperty;
        });
    }

    protected function protectedMethod($arg)
    {
        return $this->__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . $this->protectedProperty;
        });
    }

    public function publicMethod($arg)
    {
        return $this->__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . $this->publicProperty;
        });
    }

    private static function privateStaticMethodSelf($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . self::$privateStaticProperty;
        });
    }

    protected static function protectedStaticMethod($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . self::$protectedStaticProperty;
        });
    }

    public static function publicStaticMethodSelf($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . self::$publicStaticProperty;
        });
    }

    public static function publicStaticMethodStatic($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . static::$publicStaticProperty;
        });
    }

    public static function publicStaticMethodParent($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . parent::$publicStaticProperty;
        });
    }

    public static function publicStaticMethodClass($arg)
    {
        return self::__proxyCall(__METHOD__, function () use ($arg) {
            return $arg . A::$publicStaticProperty;
        });
    }

    public function main()
    {
        return $this->__proxyCall(__METHOD__, function () {
            $result['71'] = $this->privateMethod(7);
            $result['82'] = $this->protectedMethod(8);
            $result['93'] = $this->publicMethod(9);
            $result['104'] = static::privateStaticMethodSelf(10);
            $result['115'] = static::protectedStaticMethod(11);
            $result['126'] = static::publicStaticMethodSelf(12);
            $result['136'] = static::publicStaticMethodStatic(13);
            $result['146'] = static::publicStaticMethodParent(14);
            $result['156'] = static::publicStaticMethodClass(15);
            return $result;
            return $result;
        });
    }

    public function mix()
    {
        return $this->__proxyCall(__METHOD__, function () {
            return $this->main();
        });
    }

    private function __proxyCall($method, $call)
    {
        echo $method . '.pre' . PHP_EOL;
        $result = $call();
        echo $method . '.after' . PHP_EOL;
        return $result;
    }

}

$instance = new ProxyA();
$result = $instance->main();
var_dump($result);
$result = $instance->mix();
var_dump($result);