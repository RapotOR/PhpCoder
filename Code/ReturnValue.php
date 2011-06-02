<?php

namespace Sf2gen\Component\PhpCoder\Code;

class ReturnValue extends RawCode {
    
    public function getCode() {
        return 'return '.$this->code.';';
    }
    
}