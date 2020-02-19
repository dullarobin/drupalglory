<?php

namespace Drupal\nsCrud\Plugin\Block;

use Drupal\Core\Block\BlockBase;


    /**
     * Provides a 'MymoduleExampleBlock' block.
     *
     * @Block(
     *   id = "nsCrud_block",
     *   admin_label = @Translation("CRUD block"),
     *   category = @Translation("Custom block")
     * )
    */
    class MyBlock extends BlockBase {

     /**
      * {@inheritdoc}
     */
     public function build() {

       $form = \Drupal::formBuilder()->getForm('Drupal\nsCrud\Form\DataForm');

       return $form;
     }
   }