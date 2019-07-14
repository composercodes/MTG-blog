<?php

App::uses('TempFile', 'Model');

class FileBehavior extends ModelBehavior {

    /**
     * @var array
     */
    protected $errors = array();
    protected $_files_to_delete = array();
    protected $_tempfiles_to_delete = array();
    protected static $_settings = array();
    private static $instances = array();

    /**
     * Defaults
     *
     * @var array
     * @access protected
     */
    protected static $_defaults = array(
        'file' => array(
            'file_name' => '{$rand}_{$file_name}', // {$rand}:random chars, {$file_name}: the original file name
            'extensions' => array('pdf', 'doc', 'zip', 'txt'),
            'folder' => 'files/uploads/',
            'required' => false,
            'delete_temp_file' => true,
            'delete_file_on_update' => true,
            'max_file_size' => '40 MB',
            'folder_prefix_field' => false,
            'allow_local_files' => true,
            'allowed_local_dirs' => array(
                '/tmp/uploads/',
                'tmp/uploads/',
            ),
        )
    );

    final function getInstance($classname) {
        return self::$instances[$classname];
    }

    final function setInstance($obj) {
        $classname = get_class($obj);
        self::$instances[$classname] = &$obj;
    }

    /**
     * Behaviour initialization
     * @param AppModel $model
     * @param array $config
     */
    function setup(Model $model, $config = array()) {

        $this->setInstance($this);
        if (is_array($config) && sizeof($config)) {
            foreach ($config as $field => $options) {
                $options['CLASS_NAME'] = get_class($this);
                if (is_array($options)) {
                    self::$_settings[$model->alias][$field] = array_merge(self::$_defaults['file'], $options);
                } elseif (!empty($options) && is_string($options))
                    self::$_settings[$model->alias][$options] = self::$_defaults['file'];
            }
        }elseif (!empty($config) && is_string($config)) {
            self::$_settings[$model->alias][$config] = self::$_defaults['file'];
            self::$_settings[$model->alias][$config]['CLASS_NAME'] = get_class($this);
        } else {
            self::$_settings[$model->alias]['file'] = self::$_defaults['file'];
            self::$_settings[$model->alias]['file']['CLASS_NAME'] = get_class($this);
        }
    }

    final function getInstanceDefaults($defaultField) {
        $thisdefaults = array();
        $defaults = array();

        $thisdefaults['image'] = array_merge(parent::$_defaults['file'], self::$_defaults['image']);

        if (!empty($config)) {
            foreach ($config as $confField => $conf) {
                $defaults[$confField] = array_merge($thisdefaults['image'], $config[$confField]);
            }
        } else {
            $defaults = $thisdefaults;
        }

        return $default;
    }

    private function is_dir_allowed(Model $model, $field, $filename) {
        return true;
        if (!self::$_settings[$model->alias][$field]['allow_local_files'])
            return false;

        while ($filename != '/' || (strlen($filename) == '3' && strpos($filename, '/') === false )) {
            $filename = dirname($filename);
            if (in_array($filename, self::$_settings[$model->alias][$field]['allowed_local_dirs']))
                return true;
        }
        return false;
    }

    private function _mime_content_type($filename) {
        if (function_exists('mime_content_type'))
            return mime_content_type($filename);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mime;
    }

    final function beforeValidate(Model $model, $options = array()) {
        $this->_files_to_delete = array();

        if ($model->name != 'TempFile') {
            //debug($model->data);	
            //	die('i got val!');
        }

        $ret = true;
        foreach (self::$_settings[$model->alias] as $field => $options) {
            $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

            if (!empty($model->data[$model->alias][$field]) && is_string($model->data[$model->alias][$field]) && !preg_match('/^[a-f0-9]{32}$/', $model->data[$model->alias][$field]) && (strpos($model->data[$model->alias][$field], '.') === false || strpos($model->data[$model->alias][$field], '/') !== false || strpos($model->data[$model->alias][$field], '\\') !== false)) { // drop illegal filename (has no extension or has a path) 
                unset($model->data[$model->alias][$field]);
            }

            if (!empty($model->data[$model->alias][$field]) && is_array($model->data[$model->alias][$field])) {
                if ($this->getInstance($classname)->_hasFile($model, $field)) {

                    if (!$this->getInstance($classname)->_uploadSuccess($model, $field)) {
                        $ret = false;
                    }
                    if (!$this->getInstance($classname)->_preMoveProcessing($model, $field))
                        $ret = false;
                }
            } elseif (empty($model->data[$model->alias][$field])) {
                unset($model->data[$model->alias][$field]);
            }
        }
        return $ret;
    }

    final function beforeSave(Model $model, $options = array()) {


        $ret = true;

        if (method_exists($model, 'beforeBehaviorSave')) {
            if (!$model->beforeBehaviorSave()) {
                return false;
            }
        }

        foreach (self::$_settings[$model->alias] as $field => $options) {
            $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];
            $delete_temp_file = self::$_settings[$model->alias][$field]['delete_temp_file'];
            if (!empty($model->data[$model->alias][$field]) && is_string($model->data[$model->alias][$field]) && preg_match('/^[a-f0-9]{32}$/', $model->data[$model->alias][$field])) { //hash
                $tmpmodel = new TempFile;
                $file = $tmpmodel->findByHash($model->data[$model->alias][$field]);
                if (!empty($file) && file_exists($tmpmodel->folder . $file['TempFile']['name']) && $this->is_dir_allowed($model, $field, $tmpmodel->folder . $file['TempFile']['name'])) {
                    $model->data[$model->alias][$field] = array(
                        'name' => $file['TempFile']['name'],
                        'tmp_name' => $tmpmodel->folder . $file['TempFile']['name'],
                        'size' => filesize($tmpmodel->folder . $file['TempFile']['name']),
                        'error' => 0,
                    );
                    if ($delete_temp_file)
                        $this->_tempfiles_to_delete[$file['TempFile']['id']] = $file['TempFile']['behavior'];
                } else {
                    $model->data[$model->alias][$field] = array(
                        'name' => '',
                        'tmp_name' => '',
                        'type' => '',
                        'size' => 0,
                        'error' => UPLOAD_ERR_NO_FILE,
                    );
                    $ret = false;
                    $model->validationErrors[$field] = __('Invalid file signature, file ignored. Please re-upload the file', true);
                }
            } elseif (!empty($model->data[$model->alias][$field]) && is_string($model->data[$model->alias][$field]) && (strpos($model->data[$model->alias][$field], '.') === false || strpos($model->data[$model->alias][$field], '/') !== false || strpos($model->data[$model->alias][$field], '\\') !== false)) { // drop illegal filename (has no extension or has a path) 
                unset($model->data[$model->alias][$field]);
            }

            if (!empty($model->data[$model->alias][$field]) && is_array($model->data[$model->alias][$field])) {
                if ($this->getInstance($classname)->_hasFile($model, $field)) {


                    if (!$this->getInstance($classname)->_upload_file($model, $field)) {
                        $ret = false;
                    }
                }
                if ($ret && !empty($model->data[$model->alias]['id'])) {
                    //Get the current file name stored in the db to remove
                    $model->id = $model->data[$model->alias]['id'];
                    $old_file_name = $model->field($field);

                    if ($old_file_name != $model->data[$model->alias][$field] && $options['delete_file_on_update'] && $old_file_name) {
                        $this->_files_to_delete[$field][] = str_replace($model->data[$model->alias][$field], $old_file_name, $this->getInstance($classname)->getFileAbsolutePath($model, $field, $model->data));
                        if (!empty($options['create_thumbs']) && !empty($options['thumbs'])) {
                            foreach ($options['thumbs'] as $thumb) {
                                $this->_files_to_delete[$field][] = str_replace($model->data[$model->alias][$field], $old_file_name, $this->getInstance($classname)->getFileAbsolutePath($model, $field, $model->data, $thumb['prefix']));
                            }
                        }
                    }
                }
            } elseif (empty($model->data[$model->alias][$field])) {
                unset($model->data[$model->alias][$field]);
            }
        }
        return $ret;
    }

    final function afterSave(Model $model, $created, $options = array()) {

        if (!$created) {
            foreach ($this->_files_to_delete as $field => $filenames) {
                foreach ($filenames as $filename) {
                    if (file_exists($filename))
                        @unlink($filename);
                }
            }
        }


        $tmpmodel = new TempFile;
        foreach ($this->_tempfiles_to_delete as $id => $behavior) {
            $tmpmodel->Behaviors->attach(!empty($behavior) ? $behavior : 'File', array('name' => array('folder' => $tmpmodel->folder)));
            $tmpmodel->id = $id;
            $tmpmodel->delete();
        }
        $tmpmodel->cleanUp();

        return true;
    }

    final function beforeDelete(Model $model, $cascade = true) {
        $model->read();
        foreach (self::$_settings[$model->alias] as $field => $options) {
            $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];
            if (!empty($model->data[$model->alias][$field]) && $options['delete_file_on_update']) {
                $this->_files_to_delete[$field][] = $this->getInstance($classname)->getFileAbsolutePath($model, $field, $model->data);

                if (!empty($options['create_thumbs']) && !empty($options['thumbs'])) {
                    foreach ($options['thumbs'] as $thumb) {
                        $this->_files_to_delete[$field][] = $this->getInstance($classname)->getFileAbsolutePath($model, $field, $model->data, $thumb['prefix']);
                    }
                }
            }
        }
        return true;
    }

    final function afterDelete(Model $model) {
        foreach ($this->_files_to_delete as $field => $filenames) {
            foreach ($filenames as $filename) {
                if (file_exists($filename))
                    @unlink($filename);
            }
        }
        return true;
    }

    final function afterFind(Model $model, $results, $primary = false) {

        foreach ($results as $key => $val) {
            foreach (self::$_settings[$model->alias] as $field => $options) {
                $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];
                if (isset($val[$model->alias][$field]) && $val[$model->alias][$field]) {
                    $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $val);
                    if (!empty($val[$model->alias][$field])) {
                        $results[$key][$model->alias][$field . '_full_path'] = Router::url('/' . $prefix_folder . $options['folder'] . $val[$model->alias][$field]);
                        if (file_exists($this->getFileAbsolutePath($model, $field, $val))) {
                            $results[$key][$model->alias][$field . '_size'] = filesize($this->getFileAbsolutePath($model, $field, $val)) or $results[$key][$model->alias][$field . '_size'] = 'N/A';
                        } else {
                            $results[$key][$model->alias][$field . '_size'] = 0;
                        }

                        $results[$key][$model->alias][$field . '_size_human'] = $this->_bytesToHumanReadable($results[$key][$model->alias][$field . '_size']);
                    } elseif ($options['default']) {
                        $results[$key][$Model->name][$field . '_full_path'] = Router::url($options['default']);
                    }
                    if (!empty($options['create_thumbs']) && !empty($options['thumbs'])) {
                        foreach ($options['thumbs'] as $thumb) {
                            if (!empty($val[$model->alias][$field])) {
                                $results[$key][$model->alias][$field . '_' . $thumb['prefix'] . 'full_path'] = Router::url('/' . $prefix_folder . $options['folder'] . $thumb['prefix'] . $val[$model->alias][$field]);
                            } elseif ($thumb['default']) {
                                $results[$key][$Model->name][$field . '_' . $thumb . 'full_path'] = Router::url($thumb['default']);
                            }
                        }
                    }
                }
            }
        }
        return $results;
    }

    public function afterFindAssociated($model, $results, $primary = false) {
        foreach ($results as &$result) {
            if (!array_key_exists($model->alias, $result)) {
                $result = array($model->alias => $result);
            }
        }
        $results = $this->afterFind($model, $results, $primary);
        return $primary ? $results : Hash::extract($results, '{n}.' . $model->alias);
    }

    /**
     * delete the file and the thumb of the image
     * @param string $field
     * @param string $file_name
     * @return boolean true on deleting file, false on error
     */
    function deleteFile(Model $model, $field, $id) {
        $model->id = $id;
        $data = $model->read();
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        $ret = @unlink($this->getInstance($classname)->getFileAbsolutePath($model, $field, $data));
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        if (!empty($options['create_thumbs']) && !empty($options['thumbs'])) {
            foreach ($options['thumbs'] as $thumb) {
                $ret = $ret && @unlink($this->getInstance($classname)->getFileAbsolutePath($model, $field, $data, $thumb['prefix']));
            }
        }

        return $ret;
    }

    /**
     * Get the file absolute path
     * @param string $field
     * @param string $file_name
     *
     * @return string full file path
     */
    function getFileAbsolutePath(Model $model, $field, $data, $prefix = '') {
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $data);
        return WWW_ROOT . $prefix_folder . str_replace('/', DS, self::$_settings[$model->alias][$field]['folder']) . $prefix . $data[$model->alias][$field];
    }

    function _hasFile(Model $model, $field) {
        $file = $model->data[$model->alias][$field];

        if ($file['error'] == UPLOAD_ERR_NO_FILE) {
            if (!empty($model->data[$model->alias]['id'])) { //edit
                $bnr = $model->findById($model->data[$model->alias]['id']);
                $model->data[$model->alias][$field] = $bnr[$model->alias][$field];
            } else { //add
                if (self::$_settings[$model->alias][$field]['required']) {
                    $model->validationErrors[$field] = __('No file selected. This field is required', true);
                } else {
                    $model->data[$model->alias][$field] = '';
                }
            }
            return false;
        } else {
            return true;
        }
    }

    function _uploadSuccess(Model $model, $field) {
        $file = $model->data[$model->alias][$field];
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        if (!$this->getInstance($classname)->_hasFile($model, $field))
            return false;

        $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $model->data);

        $folder = WWW_ROOT . DS . $prefix_folder . self::$_settings[$model->alias][$field]['folder'] . DS;

        ini_set('upload_max_filesize', self::$_settings[$model->alias][$field]['max_file_size']);
        ini_set('post_max_size', self::$_settings[$model->alias][$field]['max_file_size']);
        switch ($file['error']) {
            CASE UPLOAD_ERR_INI_SIZE:
                $model->validationErrors[$field] = __('File size is too large', true);
                return false;
                break;
            CASE UPLOAD_ERR_FORM_SIZE:
                $model->validationErrors[$field] = __('File size is too large', true);
                return false;
                break;
            CASE UPLOAD_ERR_NO_TMP_DIR:
                $model->validationErrors[$field] = __('Cannot write to temp directory', true);
                return false;
                break;
            CASE UPLOAD_ERR_CANT_WRITE:
                $model->validationErrors[$field] = __('Cannot write to temp directory', true);
                return false;
                break;
            CASE UPLOAD_ERR_PARTIAL:
                $model->validationErrors[$field] = __('File could not be uploaded', true);
                return false;
                break;
        }

        return true;
    }

    function _preMoveProcessing(Model $model, $field) {
        $file = $model->data[$model->alias][$field];
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $model->data);

        $folder = WWW_ROOT . DS . $prefix_folder . self::$_settings[$model->alias][$field]['folder'] . DS;

        $ext = $this->getInstance($classname)->__get_extension($file['name']);
        $exts = array_map('strtolower', self::$_settings[$model->alias][$field]['extensions']);
        if (!in_array($ext, $exts)) {
            $model->validationErrors[$field] = __(sprintf('Invalid file type, types allowed %s', implode(',', self::$_settings[$model->alias][$field]['extensions'])), true);
            return false;
        }

        if ($file['size'] > $this->getInstance($classname)->_sizeStringToBytes(self::$_settings[$model->alias][$field]['max_file_size'])) {
            $model->validationErrors[$field] = __(sprintf('Too large file, Maximum size is %s', $this->getInstance($classname)->_bytesToHumanReadable($this->getInstance($classname)->_sizeStringToBytes(self::$_settings[$model->alias][$field]['max_file_size']))), true);
            return false;
        }

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if (!is_writable($folder)) {
            $model->validationErrors[$field] = __('Destination folder is not writeable, or does not exist!', true);
            return false;
        }

        return true;
    }

    function _prepareFilename(Model $model, $field) {
        $file = $model->data[$model->alias][$field];

        $uniqid = substr(uniqid(), 8);
        $filename = str_replace('{$rand}', $uniqid, self::$_settings[$model->alias][$field]['file_name']);
        $base_name = substr($file['name'], 0, strrpos($file['name'], '.'));
        $base_name = substr($base_name, 0, 100);
        $ext = substr($file['name'], strrpos($file['name'], '.'));
        $fname = Inflector::slug($base_name) . $ext;
        $filename = str_replace('{$file_name}', $fname, $filename);

        return $filename;
    }

    function _postMoveProcessing(Model $model, $field, $filename) {
        return true;
    }

    function _sizeStringToBytes($sizeStr) {
        $units = array('Bytes', 'KB', 'MB', 'GB', 'TB');

        for ($i = 1; $i <= 4; $i++)
            if (stripos($sizeStr, $units[$i]))
                return ceil(floatval($sizeStr * pow(1024, $i)));

        return ceil(intval($sizeStr));
    }

    function _bytesToHumanReadable($size) {
        $units = array('Bytes', 'KB', 'MB', 'GB', 'TB');

        for ($i = 4; $i >= 0; $i--)
            if ($size > pow(1024, $i))
                return round($size / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    /**
     * 	Uploads a file to defined folder. On failure it assigns validation error message to the field
     * @param Model $model The model to apply changes on
     * @param string   $field The name of the field to get file data from
     * @return boolean true on success uploading, false if failed for any reason
     */
    function _upload_file(Model $model, $field) {

        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        if (!$this->getInstance($classname)->_uploadSuccess($model, $field))
            return false;

        if (!$this->getInstance($classname)->_preMoveProcessing($model, $field))
            return false;



        $file = $model->data[$model->alias][$field];

        $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $model->data);

        $folder = WWW_ROOT . DS . $prefix_folder . self::$_settings[$model->alias][$field]['folder'] . DS;

        $filename = $this->getInstance($classname)->_prepareFileName($model, $field);

        if (move_uploaded_file($file['tmp_name'], $folder . $filename)) {
            $model->data[$model->alias][$field] = $filename;
            chmod($folder . $filename, 0666);
            $this->getInstance($classname)->_postMoveProcessing($model, $field, $filename);

            return true;
        } elseif (self::$_settings[$model->alias][$field]['allow_local_files'] && copy($file['tmp_name'], $folder . $filename)) {

            $model->data[$model->alias][$field] = $filename;
            chmod($folder . $filename, 0666);
            $this->getInstance($classname)->_postMoveProcessing($model, $field, $filename);
            return true;
        } else {
            $model->validationErrors[$field] = __('Error while saving uploaded file', true);
            return false;
        }
    }

    /**
     * 	returns the extensions of a given file
     * @param string $name name of the file to get extension for
     * @return string the extension fo rthat file name
     */
    function __get_extension($name) {
        $pos = strrpos($name, '.');
        if ($pos !== false) {
            return strtolower(substr($name, $pos + 1));
        }
        return '';
    }

    function getFileSettings(Model $model, $field = false, $param = false) {
        if (!$field && !$param)
            return self::$_settings[$model->alias];
        else if (!$param)
            return self::$_settings[$model->alias][$field];
        else
            return self::$_settings[$model->alias][$field][$param];
    }

    function setFileSettings(Model $model, $field, $param, $value) {
        self::$_settings[$model->alias][$field][$param] = $value;
    }

    function __get_prefix_folder(Model $model, $field, $data) {
        $folder_prefix = '';
        if (self::$_settings[$model->alias][$field]['folder_prefix_field'] && isset($data[$model->alias][self::$_settings[$model->alias][$field]['folder_prefix_field']]) && !empty($data[$model->alias][self::$_settings[$model->alias][$field]['folder_prefix_field']])) {
            $prefix = preg_replace('/_id$/', '', self::$_settings[$model->alias][$field]['folder_prefix_field']);
            $prefix = Inflector::classify($prefix);
            $folder_prefix = strtolower($prefix) . '_' . $data[$model->alias][self::$_settings[$model->alias][$field]['folder_prefix_field']] . '/';
        }


        return $folder_prefix;
    }

}

?>