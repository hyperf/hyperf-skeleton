<?php
require '../vendor/autoload.php';
class Node
{
    public $id = 1;

    public function __construct($id)
    {
        $this->id = $id;
    }
}

$arr = new ArrayObject([new Node(1), new Node(2), new Node(3)]);

$deepCopy = new \DeepCopy\DeepCopy(true);
$arr2 = $deepCopy->copy($arr);

foreach ($arr as $i => $node) {
    if ($i == 1) {
        $node->id = 5;
    }
}

var_dump($arr,$arr2);

go(function () {
    echo Co::getuid();
});