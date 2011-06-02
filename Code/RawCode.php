<?php

namespace Sf2gen\Component\PhpCoder\Code;

use Sf2gen\Component\PhpCoder\Code;

class RawCode extends Code {
    
    protected $code;
    
    public function __construct($code) {
        $this->code = $code;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    public function output() {
        return $this->getCode();
    }
    
}