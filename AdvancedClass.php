<?php

namespace Sf2gen\Component\PhpCoder;

class AdvancedClass extends BasicClass {
    
    public function addGettersSetters($phpDoc = true) {
        foreach( array_keys($this->properties) as $k)
            $this->addGetterSetter($k, $phpDoc);
    }
    
    public function addGetterSetter($name, $phpDoc = true) {
        $this->addGetter($name, $phpDoc);
        $this->addSetter($name, $phpDoc);
    }
    
    public function addGetter($name, $phpDoc = true) {
        $getter = new ClassFunction('get' . ucwords($name));
        $getter->addCode(new Code\ReturnValue('$this->' . $name));
        if($phpDoc){
            $phpDocItem = new PhpDoc('Gets "'.$name.'" property');
            $phpDocItem->addTag(new Tag\Base('return', ($this->issetProperty($name) ? $this->getProperty($name)->getType() : 'variant') ));
            $getter->setComment($phpDocItem);
        }        
        $this->addFunction($getter);
        
        return $this;
    }
    
    public function addSetter($name, $phpDoc = true) {
        $setter = new ClassFunction('set' . ucwords($name));
        $setter->addInput(new Input($name));
        $setter->addCode(new Code\RawCode('$this->' . $name . ' = ' . $name . ';'));
        $setter->addCode(new Code\ReturnValue('$this'));
        if($phpDoc){
            $phpDocItem = new PhpDoc('Sets "'.$name.'" property');
            $phpDocItem->addTag(new Tag\Base('param', ($this->issetProperty($name) ? $this->getProperty($name)->getType() : 'variant') . ' $' . $name));
            $setter->setComment($phpDocItem);
        }
        
        $this->addFunction($setter);
        
        return $this;
    }
    
}