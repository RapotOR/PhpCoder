<?php

namespace Sf2gen\Component\PhpCoder;

class Code {
    
    public static $newline = "\n";
    
    public static $indent = "    ";
    
    protected $comment = false;
    protected $uses = array();
    
    public function __toString() {
        return $this->output();
    }
    
    public function setComment($comment){
        if (is_string($comment)){
            $comment = new Comment($comment);
        }elseif ($comment instanceof Comment){
            $this->addUses($comment->getUses());
        }else{
            // exception!
        }
        
        $this->comment = $comment;
        
        return $this;        
    }
    
    public function getUses() {
        return $this->uses;
    }
    
    public function addUses(Array $uses) { 
        $this->uses = array_merge($this->uses, $uses);
    }
    
    public function isUse($namespace) {
        $this->uses = array_merge($this->uses, $uses);
    }    
    
    public function addUse($use, $alias = false) {
        if(!self::isNamespace($use))
            return $use;
        
        if(!is_string($alias)){ // allow true for automatic aliasing
            $alias = self::getAlias($use);
        }        
        $this->uses[$use] = $alias;
        
        return $alias;
    }    
    
    public function outputComment() {
        return ($this->comment ? $this->comment->output() : '');
    }
    
    public static function isGlobalNamespace($namespace) {
        if ($namespace[0] = '\\')
            return true;
        
        return false;
    }
    
    public static function isNamespace($namespace) {
        return (strpos($namespace, '\\') !== false);
    }
    
    public static function getAlias($namespace) {
        $pos = strrpos($namespace, '\\');
        if($pos !== false)
            return substr($namespace, $pos + 1);
        
        return $namespace;
    }
    
    public static function indent($indent, $newline, $target) {
        return $indent . str_replace($newline, $newline . $indent, $target);
    }
    
    public static function quote($value) {
        switch(gettype($value)) {
            case 'string':
                if(empty($value) || $value[0] != '$')
                    $value = '"' . $value . '"';
            break;
            case 'boolean':
                $value = ($value ? 'true' : 'false');
            break;            
        }
        
        return $value;
    }    
}