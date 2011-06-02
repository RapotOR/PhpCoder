Introduction
============

The PhpCoder component generates PHP code.

Use it
======

** Create a PHP5 class **

    $php = new Klass();
    $descr = new PhpDoc('Class generated
    By coder');
    $descr->addTag(new TagBase('version', '2.0.1'))
          ->addTag(new Annotation('SomeVendor\\Component\\Template', 
                                  false,
                                  array('BlogBundle:Annot:post'), 
                                  array(
                                    'vars' => array('post'),
                                  )
                                  )
                  )            
          ->addTag(new Annotation('SomeVendor\\Component\\Cache',
                                  'Cachee',
                                  array(), 
                                  array(
                                    'smaxage' => '15',
                                  )
                                  )
                  );            

    $php->setNamespace('Application\\Bundle\\AppBundle')
        ->setVisibility('public')
        ->setClassname('AppBundle')
        ->setExtendedClass('Symfony\\Component\\HttpKernel\\Bundle\\Bundle', true)
        ->setComment($descr)
        ;
        
** Add a function **

    $funcDescr = new PhpDoc();
    $collection = new AnnotationCollection('Sensio\\Component\\Routes');
    $collection->addAnnotation(new Annotation('Sensio\\Component\\Route', 
                                               false,
                                               array("/")
                                              )
                               )                    
               ->addAnnotation(new Annotation('Other\\Component\\Route',
                                               false,
                                               array("/homepage")
                                              )
                               );
    $funcDescr->addTag($collection);


    $input1 = new Input('var1');
    $input1->setDefaultValue(true);

    $func1 = new ClassFunction('indexAction');
    $func1->setVisibility('public')
          ->setComment($funcDescr)
          ->addCode( new ReturnValue(new ShortHandIf('$this->id','$this->id', '') ) )
          ;
    $func1->addInput($input1);                
    $php->addFunction($func1);
    $php->addProperty(new Property('id'));
    $php->addProperty(new Property('name'));

** Have my class into a tranditionnal file **

    $phpFile = new File();
    $phpFile->setComment(new PhpDoc('This file is part of the Symfony package.

    (c) Fabien Potencier <fabien@symfony.com>

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.'));
    $phpFile->addClass( $php );

    echo $phpFile->output();

Installation
============

  1. Add this bundle to your vendor/ dir:

        $ git submodule add git://github.com/RapotOR/PhpCoder.git vendor/bundles/Sf2gen/Component/PhpCoder

  2. Add the Sf2gen namespace to your autoloader:

        // app/autoload.php
        $loader->registerNamespaces(array(
            'Sf2gen' => __DIR__.'/../vendor/bundles',
            // other namespaces
        ));

  3. Use it