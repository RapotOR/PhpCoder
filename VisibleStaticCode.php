<?php

namespace Sf2gen\Component\PhpCoder;

class VisibleStaticCode extends Code {
    
    protected $visibility = 0; // public by default
    protected $isStatic = false;    
    
    protected $visibilityValues = array('public', 'protected', 'private');
    
    public function setVisibility($visibility){
        $values = array_flip($this->visibilityValues);
        if(isset($values[ $visibility ]))
            $this->visibility = $values[ $visibility ];
        else
            $this->visibility = false;
        
        return $this;
    }
    
    public function getVisibility() {
        return ($this->visibility !== false && isset($this->visibilityValues[ $this->visibility ]) ? $this->visibilityValues[ $this->visibility ] . ' ' : '' );
    }
    
    public function getStatic() {
        return ($this->isStatic ? 'static ' : '');
    }
    
    public function setStatic($static) {
        $this->isStatic = (bool)$static;
    }    
    
}