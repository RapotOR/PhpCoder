<?php

namespace Sf2gen\Component\PhpCoder\Tag;

class AnnotationCollection extends Annotation {
    
    protected $annotations = array();
    
    public function __construct($tag, $alias = false) {
        if($alias)
            $tag = $this->addUse($tag, $alias); 
             
        $this->tag = $tag;
        $this->into = '';
        
        $this->parameters = array();
        $this->optionalParameters = array();
    }
    
    public function addAnnotation(Annotation $annotation) {
        $this->addUses( $annotation->getUses() );
        $this->annotations[] = $annotation;
        
        return $this;
    }
    
    public function outputDescription() {
        $this->description = '';
        
        if(!empty($this->annotations)){
            $this->description .= '{' . self::$newline;
            foreach($this->annotations as $annotation)
                $this->description .= self::$indent . $annotation->output() . self::$newline;
            $this->description .= '}';
        }
        
        return parent::outputDescription();
    }
    
}