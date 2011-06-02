<?php

namespace Sf2gen\Component\PhpCoder\Tag;

use Sf2gen\Component\PhpCoder\Code;

class Base extends Code{
    
    protected $into = "\t";
    protected $tag;
    protected $description = false;
    
    public function __construct($tag, $description) {
        $this->tag = $tag;
        $this->description = $description;
    }
    
    public function outputDescription(){
        return  ($this->description ? $this->into . $this->description : '');
    }
    
    public function output() {
        return '@' . $this->tag . $this->outputDescription();
    }    
    
    public static function implode($splitter, Array $tobeConverted) {
        foreach($tobeConverted as &$item)
            if(is_array($item))
                $item = self::implode($splitter, $item);
            
        return implode($splitter, $tobeConverted);
    }
}