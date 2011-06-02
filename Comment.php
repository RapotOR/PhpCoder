<?php

namespace Sf2gen\Component\PhpCoder;

class Comment extends Code {
    
    protected $single  = '//';
    protected $before  = '/*';
    protected $after   = '*/';
    protected $into    = '  ';

    protected $content = false;
    protected $afterContent = false;
    protected $allowOneLine = true;
    
    public function __construct($content = false) {
        $this->setContent($content);
    }    
    
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function output() {
        if($this->allowOneLine 
            && $this->afterContent === false 
            && strpos($this->content, self::$newline) === FALSE
        )
            return $this->single . $this->content . self::$newline;
        
        return $this->before 
                . self::$newline 
                // call indentation function with $this->into (because into is not specially the normal indentation
                . self::indent($this->into, 
                               self::$newline,
                               $this->content . ($this->afterContent ? 
                                            ( $this->content ? self::$newline : '' ) // return only if content exists
                                            . $this->afterContent 
                                        : '') 
                              ) 
                . self::$newline
                . $this->after  
                . self::$newline;
    }
    
}