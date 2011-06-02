<?php

namespace Sf2gen\Component\PhpCoder;

class Input extends Property {
    
    protected $byRef = false;
    
    public function __construct($varName) {
        $this->visibility = false;
        $this->isStatic = false;
        parent::__construct($varName);
    }
    
    public function setVisibility($visibility) {
        //removing possibility to set visible
        return $this;
    }
    
    public function setStatic($static) {
        //removing possibility to set static
        return $this;
    }
    
    public function getByReference() {
        return ($this->byRef ? '&' : '');
    }
    
    public function setByReference($byRef) {
        $this->byRef = (bool)$byRef;
        
        return $this;
    }
    
    public function getDollar() {
        return $this->getByReference() . '$';
    }
    
    public function getEndOfLine() {
        return '';
    }    
    
}