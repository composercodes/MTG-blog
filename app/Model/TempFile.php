<?php

App::uses('AppModel', 'Model');

/**
 * TempFile Model
 *
 */
class TempFile extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $folder = 'tmp/uploads/';
    public $allowedModels = array('Brand','Style','Testimonial' ,'TrackCategory', 'FabricCategory',
                                  'Fabric','Supplier','Lining','Tieback','Track','Socialmedia','News','CurtainTrim','GalleryImage');
    public $targetBehaviors = array('File', 'ImageFile', 'PDFFile');
    public $lifeTimeMinutes = 3;

    function cleanUp() {

        // cleanup old temp files, load their original behaviors to delete correct files ( thumbs.. etc.. )
        $data = $this->data;
        $to_clean = $this->find('list', array('conditions' => "TempFile.created < DATE_SUB('" . date('Y-m-d H:i:s') . "' , INTERVAL " . $this->lifeTimeMinutes . " MINUTE)", 'fields' => array('id', 'behavior')));
        foreach ($to_clean as $id => $behavior) {
            $this->Behaviors->attach(!empty($behavior) ? $behavior : 'File', array('name' => array('folder' => $this->folder)));
            $this->id = $id;
            $this->delete();
            $this->Behaviors->unload(!empty($behavior) ? $behavior : 'File');
        }


        // reset data to the original data to be saved 
        $this->create();
        $this->data = $data;
    }

    function beforeSave($options = array()) {
        $attached = $this->Behaviors->attached(); //get current attached behaviors

        $this->cleanUp();

        // if we have no attahced behaviors then there is no extra action..
        if (empty($attached))
            return true;

        $fname = reset($this->data[$this->name]);
        if (is_array($fname))
            $fname = reset($fname);
        $behavior = $this->data[$this->name]['behavior'];
        $uploaded_for = $this->data[$this->name]['uploaded_for'];
        $this->data = array($this->name => array('name' => $fname, 'hash' => $this->data[$this->name]['hash'], 'created' => $this->data[$this->name]['created'], 'behavior' => $behavior, 'uploaded_for' => $uploaded_for));
        return true;
    }

}
