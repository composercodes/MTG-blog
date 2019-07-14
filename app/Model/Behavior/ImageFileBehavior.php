<?php

App::uses('FileBehavior', 'Model/Behavior');

class ImageFileBehavior extends FileBehavior {

    protected static $_defaults = array(
        'image' => array(
            'resize' => true, // true/false only, set thumbs in the 'create_thumbs' and  'thumbs' array
            'width' => '640',
            'height' => '480',
            'default' => false,
            'create_thumbs' => true,
            'thumbs' => array(
                array('prefix' => 'thumb1_', 'width' => '320', 'height' => '240', 'default' => false),
                array('prefix' => 'thumb2_', 'width' => '160', 'height' => '120', 'default' => false),
            ),
            'file_name' => '{$rand}_{$file_name}', // {$rand}:random chars, {$file_name}: the original file name
            'extensions' => array('jpg', 'png', 'gif'),
            'folder' => 'img/uploads/',
            'aspect_required' => false,
            'aspect_tolerance' => '0.05',
            'crop' => false,
            'required' => false,
            'delete_file_on_update' => true,
            'max_file_size' => '2 MB',
            'folder_prefix_field' => false
        )
    );

    /**
     * Behaviour initialization
     * @param AppModel $model
     * @param array $config
     */
    function setup(Model $model, $config = array()) {
        //if($model->alias == 'TicketCommentFile') throw new Exception('ee');
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
        parent::setup($model, $defaults);
    }

    function _preMoveProcessing(Model $model, $field) {
        if (!parent::_preMoveProcessing($model, $field))
            return false;

        $image = $model->data[$model->alias][$field];

        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        $spec = $this->getInstance($classname)->__get_image_dimensions($image['tmp_name']);
        if (empty($spec['width']) && empty($spec['height'])) {
            $model->validationErrors[$field] = __('Not a valid image!');
            return false;
        }
        if (self::$_settings[$model->alias][$field]['aspect_required'] && self::$_settings[$model->alias][$field]['width'] && self::$_settings[$model->alias][$field]['height']) {
            $spec_aspect = self::$_settings[$model->alias][$field]['width'] / self::$_settings[$model->alias][$field]['height'];
            $image_aspect = $spec['width'] / $spec['height'];
            if (!($image_aspect >= $spec_aspect - self::$_settings[$model->alias][$field]['aspect_tolerance'] && $image_aspect <= $spec_aspect + self::$_settings[$model->alias][$field]['aspect_tolerance'])) {
                $model->validationErrors[$field] = __('Image with size %d x %d is required, or the same aspect', self::$_settings[$model->alias][$field]['width'], self::$_settings[$model->alias][$field]['height']);
                return false;
            }
        }

        return true;
    }

    function _postMoveProcessing(Model $model, $field, $filename) {
        $classname = self::$_settings[$model->alias][$field]['CLASS_NAME'];

        if (!parent::_postMoveProcessing($model, $field, $filename))
            return false;

//die('ist ' . self::$_settings[$model->alias][$field]['width']);
        $prefix_folder = $this->getInstance($classname)->__get_prefix_folder($model, $field, $model->data);

        $folder = WWW_ROOT . DS . $prefix_folder . self::$_settings[$model->alias][$field]['folder'] . DS;

        if (!empty(self::$_settings[$model->alias][$field]['resize']) && self::$_settings[$model->alias][$field]['resize'] && (self::$_settings[$model->alias][$field]['width'] >= 0 || self::$_settings[$model->alias][$field]['height'] >= 0)) {
            if (self::$_settings[$model->alias][$field]['width'] == 0 && self::$_settings[$model->alias][$field]['height'] == 0) {
                $width = 0;
                $height = 0;
            } else {
                $width = self::$_settings[$model->alias][$field]['width'] > 0 ? self::$_settings[$model->alias][$field]['width'] : 10000;
                $height = self::$_settings[$model->alias][$field]['height'] > 0 ? self::$_settings[$model->alias][$field]['height'] : 10000;
            }

            $this->getInstance($classname)->smart_resize_image("$folder/$filename", $width, $height, true, 'file', "$folder/$filename", self::$_settings[$model->alias][$field]['crop']);
        }
        if (self::$_settings[$model->alias][$field]['create_thumbs']) {
            foreach (self::$_settings[$model->alias][$field]['thumbs'] as $thumb) {
                if (($thumb['width'] > 0 || $thumb['height'] > 0)) {
                    $width = $thumb['width'] > 0 ? $thumb['width'] : 10000;
                    $height = $thumb['height'] > 0 ? $thumb['height'] : 10000;
                    $this->getInstance($classname)->smart_resize_image("$folder/$filename", $width, $height, true, 'file', "$folder/{$thumb['prefix']}$filename", self::$_settings[$model->alias][$field]['crop']);
                }
            }
        }

        return true;
    }

    /**
     *
     * @param string $name image file path
     * @return array an associative array with keys 'width', 'height' which has the image width and height respectively
     */
    function __get_image_dimensions($name) {
        $spec = getimagesize($name);
        $width = $spec[0];
        $height = $spec[1];
        return compact('width', 'height');
    }

    function smartResizeImage($file, $width = 0, $height = 0, $proportional = true, $output = 'file', $file_name = false, $crop = false) {
        $params = func_get_args();
        array_shift($params);
        call_user_func_array(array($this, 'smart_resize_image'), $params);
    }

    function smart_resize_image($file, $width = 0, $height = 0, $proportional = true, $output = 'file', $file_name = false, $crop = false) {

        if ($height == 0 && $width == 0)
            return true;

        if ($height <= 0 && $width <= 0) {
            return false;
        }

        $info = getimagesize($file);
        $image = '';


        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;



        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
                break;
        }

        if ($proportional == 1) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        } else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }

        $image_resized = imagecreatetruecolor($final_width, $final_height);

        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {

                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {

                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }


        if ($crop) {
            $orig_aspect = $width_old / $height_old;
            $new_aspect = $width / $height;
            if ($orig_aspect != $new_aspect) {
                $w_ratio = $width_old / $width;
                $h_ratio = $height_old / $height;

                $mid_w = $width;
                $mid_h = $height;

                if ($h_ratio < $w_ratio) {
                    $mid_w = $width_old * $height / $height_old;
                } else {
                    $mid_h = $height_old * $width / $width_old;
                }





                $image_mid = imagecreatetruecolor($mid_w, $mid_h);
                imagecopyresampled($image_mid, $image, 0, 0, 0, 0, $mid_w, $mid_h, $width_old, $height_old);


                $image_resized = imagecreatetruecolor($width, $height);
                $crop_w = abs($mid_w - $width) / 2;
                $crop_h = abs($mid_h - $height) / 2;

                imagecopy($image_resized, $image_mid, 0, 0, $crop_w, $crop_h, $width, $height);
            } else {
                $image_resized = $image;
            }
        } else {

            imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
        }

        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = ($file_name ? $file_name : $file);
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

        switch ($info[2]) {
            case IMAGETYPE_GIF:
                imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output, 100);
                break;
            case IMAGETYPE_PNG:
                imagepng($image_resized, $output);
                break;
            default:
                return false;
                break;
        }

        return true;
    }

}

?>