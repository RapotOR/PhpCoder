<?php

namespace Sf2gen\Component\PhpCoder\Code;

use Sf2gen\Component\PhpCoder\Code;

class ShortHandIf extends Code {
    
    protected $condition;
    protected $isTrue;
    protected $isFalse;
    
    public function __construct($condition, $isTrue, $isFalse) {
        $this->condition    = $condition;
        $this->isTrue       = $isTrue;
        $this->isFalse      = $isFalse;
    }
    
    public function getCode() {
        return '(' . $this->condition . ' ? ' . self::quote($this->isTrue) . ' : ' . self::quote($this->isFalse) . ' )';
    }
    
    public function output() {
        return $this->getCode();
    }
    
}