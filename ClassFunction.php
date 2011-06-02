<?php

namespace Sf2gen\Component\PhpCoder;

class ClassFunction extends VisibleStaticCode {
    
    protected $functionName;
    
    protected $inputs = array();
    protected $codes = array();
    
    public function __construct($name) {
        $this->visibility = 0; // public
        $this->functionName = $name;
    }
    
    public function getFunctionName() {
        return $this->functionName;
    }
    
    public function addInput(Input $input) {
        $this->inputs[ $input->getVarName() ] = $input;
        
        return $this;
    }
    
    public function addCode(Code $code) {
        $this->codes[] = $code;
        
        return $this;
    }
    
    public function output() {
        $function = '';
        
        $function .= $this->outputComment();
        
        $function .= $this->getVisibility()
                  . $this->getStatic()
                  . 'function '
                  . $this->getFunctionName()
                  . '('
        ;
        
        if(!empty($this->inputs)){
            $inputs = array();
            foreach($this->inputs as $input)
                $inputs[] = $input->output();
            $function .= implode(', ', $inputs);
        }
        
        $function .= '){ ';
        
        if(!empty($this->codes)){
            $codes = self::$newline;
            foreach($this->codes as $code)
                $codes .= self::indent( self::$indent, self::$newline, $code->output()) . self::$newline;           
            $function .= $codes;
        }
        
        $function .= '}';
        
        return $function;
    }
    
}