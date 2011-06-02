<?php

namespace Sf2gen\Component\PhpCoder;

class File extends Code {
    
    protected $classes = array();
    
    public function addClass(BasicClass $class){
        $this->classes[] = $class;
    }
    
    public function output() {
        
        $content = '';
        
        $content .= '<?' . self::$newline;
        
        $content .= $this->outputComment() . self::$newline;
        
        foreach($this->classes as $class)
            $content .= $class->output();
        
        return $content;
    }
    
}