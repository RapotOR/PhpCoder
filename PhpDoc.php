<?php

namespace Sf2gen\Component\PhpCoder;

class PhpDoc extends Comment {
    
    protected $tags = array();
    
    public function __construct($content = false) {
        parent::__construct($content);
        $this->before   = '/**';        
        $this->into     = ' * ';
        $this->after    = ' */';
        $this->allowOneLine = false;        
    }
    
    public function addTag(Tag\Base $tag) {
        $this->addUses( $tag->getUses() );
        $this->tags[] = $tag;
        
        return $this;
    }
    
    public function output() {
        if(!empty($this->tags)){
            foreach($this->tags as $tag)
                $this->afterContent .= self::$newline . $tag->output();
        }
        return parent::output();
    }    
    
}