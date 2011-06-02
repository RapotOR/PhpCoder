<?php

namespace Sf2gen\Component\PhpCoder\Tag;

class Annotation extends Base {
    
    protected $parameters = array();
    protected $optionalParameters = array();
    
    public function __construct($tag, $alias = false, Array $parameters = array(), Array $optionalParameters = array()) {
        if($alias)
            $tag = $this->addUse($tag, $alias);        
        
        $this->tag = $tag;
        $this->into = '';
        
        $this->parameters = $parameters;
        $this->optionalParameters = $optionalParameters;
    }
    
    public function outputDescription() {
        
        if(!empty($this->parameters))
            $this->description .= '"' . self::implode('", "', $this->parameters) . '"';
                
        if(!empty($this->optionalParameters)){
            foreach($this->optionalParameters as $k => $v)
                if(is_array($v))
                    $this->description .= ', ' . $k . '={"' . implode('", "', $v) . '"}';
                else
                    $this->description .= ', ' . $k . '="' . $v . '"';
        }
        
        return '(' . ($this->description[0] == ',' ? substr($this->description, 2) : $this->description)  . ')';
    }
    
}