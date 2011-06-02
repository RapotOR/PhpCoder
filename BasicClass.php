<?php

namespace Sf2gen\Component\PhpCoder;

class BasicClass extends VisibleStaticCode {
    
    protected $classNamespace = false;
    protected $classname;
    protected $classType = false;
    protected $extendedClass = false;
    protected $interfaces = false;
    
    protected $properties = array();
    protected $functions = array();
    
    protected $classTypes = array('abstract', 'final');
    
    public function setNamespace($namespace){
        $this->classNamespace = $namespace;
        $this->isStatic = false;
        $this->visibility = false;
        
        return $this;        
    }
    
    public function setStatic($static) { 
        //not possible to change static on CLASS
        return $this; 
    }
    
    public function setExtendedClass($extendedClass, $alias = false){
        if($alias)
            $extendedClass = $this->addUse($extendedClass, $alias);
        
        $this->extendedClass = $extendedClass;
        
        return $this;
    }
    
    public function addInterface($interface, $alias = false) {
        if($alias)
            $interface = $this->addUse($interface, $alias);
        
        $this->interfaces[] = $interface;
        
        return $this;
    }
    
    public function addFunction(ClassFunction $function) {
        if($function->getFunctionName()){
            $this->functions[$function->getFunctionName()] = $function;
        }
        
        return $this;
    }
    
    public function addProperty(Property $property) {
        if($property->getVarName()){
            $this->properties[$property->getVarName()] = $property;
        }
        
        return $this;
    }
    
    public function issetProperty($name){
        return (isset($this->properties[$name]));
    }    
    
    public function getProperty($name){
        return (isset($this->properties[$name]) ? $this->properties[$name] : false);
    }    
    
    public function setClassname($classname){
        $this->classname = $classname;
        
        return $this;
    }
    
    public function getClassType(){
        return ($this->classType ? $this->classTypes[ $this->classType ] . ' ' : '');
    }    
    
    public function setClassType($classType){
        $values = array_flip($this->classTypes);
        if(isset($values[ $classType ]))
            $this->classType = $values[ $classType ];
        else
            $this->classType = false;
        
        return $this;
    }
    
    public function output() {
        
        $content = '';
        
        $content .= ($this->classNamespace !== false ? 'namespace ' . $this->classNamespace . ';' . self::$newline : '' );
        
        $content .= self::$newline;
        
        if(!empty($this->uses)){
            foreach($this->uses as $k => $v)
                $content .= 'use ' . $k . ( ($v && (self::getAlias($k) != $v)) ? ' as ' . $v : '') . ';' . self::$newline;
            
            $content .= self::$newline;
        }
        $content .= $this->outputComment();
        
        $content .= $this->getClassType()
                  . 'class '
                  . $this->classname . ' '
                  ;
        
        $content .=  ($this->extendedClass !== false ? 'extends ' . $this->extendedClass . ' ' : '' );
        
        if(!empty($this->interfaces)){
            $content .= 'implements ' . implode(', ', $this->interfaces) . ' ';     
        }
        
        $content .= '{';
        
        if(!empty($this->properties) || !empty($this->functions)){
            $content .= self::$newline;
            
            foreach($this->properties as $property)
                $content .= self::$newline . self::$indent . $property->output() . self::$newline;            
            
            foreach($this->functions as $function)
                $content .= self::$newline . self::indent( self::$indent, self::$newline, $function->output()) . self::$newline;
        }
        
        $content .= '}' . self::$newline;
        
        return $content;
    }
    
}