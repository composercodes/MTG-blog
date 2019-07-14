<?php
App::uses('AppModel', 'Model');

class Post extends AppModel {

    public $actsAs = array(
        'ImageFile' => array(
            'img' => array('width' => ''  , 'height' => ""
               ,'thumbs' => array(
                    array('prefix' => 'thumb1_', 'width' => 280, 'height' => 204),
                    //array('prefix' => 'thumb2_', 'width' => 130, 'height' => 110)

               )
                )
        )
    );


}
