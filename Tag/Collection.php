<?php

namespace Sf2gen\Component\PhpCoder\Tag;

class AnnotationCollection extends Annotation {
    
    protected $annotations = array();
    
    public function __construct($tag) {
        $this->tag = $tag;
        $this->into = '';
        
        $this->parameters = array();
        $this->optionalParameters = array();
    }
    
    public function addAnnotation(Annotation $annotation) {
        $this->annotations[] = $annotation;
    }
    
    public function getDescription() {
        $description = '';
        
        $description .= '"' . self::implode('", "', $this->parameters) . '"';
                
        if(!empty($this->optionalParameters)){
            foreach($this->optionalParameters as $k => $v)
                if(is_array($v))
                    $description .= ', ' . $k . '={"' . implode('", "', $v) . '"}';
                else
                    $description .= ', ' . $k . '="' . $v . '"';
        }
        
        return parent::getDescription();
    }
    
}