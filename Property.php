<?php

namespace Sf2gen\Component\PhpCoder;

class Property extends VisibleStaticCode {
    
    protected $varName      = false;
    protected $type         = false;
    protected $defaultValue = false;
    
    public function __construct($varName) {
        $this->varName = $varName;
    }
    
    public function getType() {
        return ($this->type ? $this->type : 'variant');
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function getVarName() {
        return $this->varName;
    }
    
    public function getDefaultValue() {
        return ($this->defaultValue ? ' = ' . self::quote($this->defaultValue) : '');
    }
    
    public function setDefaultValue($defaultValue) {
        $this->defaultValue = $defaultValue;
    }
    
    public function getDollar() {
        return '$';
    }
    
    public function getEndOfLine() {
        return ';';
    }    
    
    public function output() {
        
        return $this->getVisibility()
            .   $this->getStatic()
            .   $this->getDollar() . $this->getVarName()
            .   $this->getDefaultValue()
            .   $this->getEndOfLine()
        ;
    }
    
}