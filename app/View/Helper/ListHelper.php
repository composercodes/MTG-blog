<?Php
App::uses('Helper', 'View');
class ListHelper extends AppHelper {
 public $helpers = array('Html', 'Paginator', 'Javascript', 'Form', 'Session', 'Time', 'Mixed');
    function paging($prev = true, $next = true) {
        $paging = '<ul>';
        if ($prev && $this->Paginator->hasPrev()) {
            $paging .= $this->Html->tag('li', $this->Paginator->prev('<<' . __('prev', true), array('class' => 'Prev'), null, array('class' => 'disabled')));
        }
        $paging .= $this->Paginator->numbers(array('tag' => 'li', 'separator' => ''));
        if ($next && $this->Paginator->hasNext()) {
            $paging .= $this->Html->tag('li', $this->Paginator->next(__('next', true) . '>>', array('class' => 'Next'), null, array('class' => 'disabled')));
        }
        $paging .= '</ul>';
        return $this->Html->div('paging', $paging) . $this->Html->div('clear', '');
    }
    
    function filter($model, $filters, $form_options = array(), $extra = array()) {
        if (empty($filters))
            return false;
        $url_params = $this->params['url'];
        unset($url_params['url'], $url_params['page'], $url_params['sort'], $url_params['direction']);
        
        $session_key = "{$model}_Filter";
        $lastFilter = $this->Session->read($session_key);
        if ($lastFilter && empty($url_params)) {
            $url_params = $lastFilter;
        }

        $display = 'none';
        if (!empty($url_params))
            foreach ($url_params as $variable) {
                if (!empty($variable) || (isset($variable) && strlen($variable))) {
                    $display = 'block';
                }
            }
        $url_params['display'] =   $display ; 
        $url_params['from_date'] = empty($url_params['from_date']) ? '' : $url_params['from_date'];
        $url_params['to_date'] = empty($url_params['to_date']) ? '' : $url_params['to_date'];
        $url_params['paitent_id'] = empty($url_params['paitent_id']) ? '' : $url_params['paitent_id'];
        $url_params['user_id'] = empty($url_params['user_id']) ? '' : $url_params['user_id'];
        $url_params['day'] = empty($url_params['day']) ? '' : $url_params['day'];
        return $url_params;
        }
    
    function filter_form($model, $filters, $form_options = array(), $extra = array()) {
        if (empty($filters))
            return false;
        $url_params = $this->params['url'];
        unset($url_params['url'], $url_params['page'], $url_params['sort'], $url_params['direction']);

        $session_key = "{$model}_Filter";
        $lastFilter = $this->Session->read($session_key);
        if ($lastFilter && empty($url_params)) {
            $url_params = $lastFilter;
        }

        $display = 'none';
        if (!empty($url_params))
            foreach ($url_params as $variable) {
                if (!empty($variable) || (isset($variable) && strlen($variable))) {
                    $display = 'block';
                }
            }


        $hasDate = false;
        $defaults = array('action' => 'index', 'type' => 'get', 'id' => 'filterform', 'style' => "display:$display", 'inputDefaults' => array('required' => false));
        $extra_defaults = array('input_class' => 'INPUT', 'submit_class' => 'Submit', 'div_class' => 'FormExtended', 'div_id' => 'filter', 'toggle_class' => 'Filter_Me filter-ico');
        $extra = array_merge($extra_defaults, $extra);
        $prefix = (empty($this->params['prefix'])) ? false : $this->params['prefix'];
        if ($prefix)
            $defaults[$prefix] = true;
        $form_options = array_merge($defaults, $form_options);
        $output = $this->Html->link(__('<i class="fa fa-filter"></i> بحث متقدم ', true), "javascript:$('#{$form_options['id']}').slideToggle('fast');void(0);", array('class' =>'btn btn-success '. $extra['toggle_class'],'escape'=>false));

        $output .= $this->Form->create($model, $form_options);
        foreach ($filters as $field => $filter) {
            if (is_numeric($field)) {
                $div_id = 'Div' . $model . Inflector::slug($filter);
                $value = empty($url_params[$filter]) && !(isset($url_params[$filter]) && strlen($url_params[$filter])) ? '' : strval($url_params[$filter]);
                $output .= $this->Form->input($filter, array('class' => $extra['input_class'], 'value' => $value, 'selected' => $value, 'empty' => __('[Any ' . Inflector::humanize($filter) . ']', true), 'div' => array('id' => $div_id)));
            } elseif (is_string($filter)) {
                $div_id = 'Div' . $model . Inflector::slug($field);
                $value = empty($url_params[$field]) && !(isset($url_params[$field]) && strval($url_params[$field]) === '0') ? '' : strval($url_params[$field]);

                $output .= $this->Form->input($field, array('class' => $extra['input_class'], 'value' => $value, 'selected' => $value, 'empty' => __('[Any ' . Inflector::humanize($field) . ']', true), 'div' => array('id' => $div_id)));
            } else {
                if (!empty($filter['type']) && $filter['type'] == 'number_range') {
                    $from_div_id = "Div{$model}{$field}From";
                    $to_div_id = "Div$model{$field}To";
                    $from = empty($filter['from']) ? $field . ' from' : $filter['from'];
                    $to = empty($filter['to']) ? $field . ' to' : $filter['to'];
                    $from_value = empty($url_params[$field . '_from']) && !(isset($url_params[$from]) && strval($url_params[$field . '_from']) === '0') ? '' : strval($url_params[$field . '_from']);
                    $to_value = empty($url_params[$field . '_to']) && !(isset($url_params[$to]) && strval($url_params[$field . '_to']) === '0') ? '' : strval($url_params[$field . '_to']);
                    $output .= $this->Form->input($field . '_from', array('label' => $from, 'class' => $extra['input_class'], 'value' => $from_value, 'selected' => $from_value, 'div' => array('id' => $from_div_id)));
                    $output .=$this->Form->input($field . '_to', array('label' => $to, 'class' => $extra['input_class'], 'value' => $to_value, 'selected' => $to_value, 'div' => array('id' => $to_div_id)));
                } elseif (!empty($filter['type']) && strtolower($filter['type']) == 'date_range') {
                    $from_div_id = "{$model}{$field}From";
                    $to_div_id = "{$model}{$field}To";
                    $from = empty($filter['from']) ? $field . ' from' : $filter['from'];
                    $to = empty($filter['to']) ? $field . ' to' : $filter['to'];
                    $from_value = empty($url_params[$field . '_from']) ? '' : $url_params[$field . '_from'];
                    $to_value = empty($url_params[$field . '_to']) ? '' : $url_params[$field . '_to'];
                    $output .= $this->Form->input($field . '_from', array('label' => $from, 'class' => $extra['input_class'] . ' hasDate', 'id' => "{$field}From", 'value' => $from_value, 'selected' => $from_value, 'div' => array('id' => $from_div_id)));
                    $output .= $this->Form->input($field . '_to', array('label' => $to, 'class' => $extra['input_class'] . ' hasDate', 'id' => "{$field}To", 'value' => $to_value, 'selected' => $to_value, 'div' => array('id' => $to_div_id)));
                    $hasDate = true;
                } else {
                    $value = empty($url_params[$field]) && !(isset($url_params[$field]) && strval($url_params[$field]) === '0') ? '' : strval($url_params[$field]);
                    $label = empty($filter['title']) ? '' : $filter['title'];


                    $output .= $this->Form->input($field, array('label' => $label, 'class' => $extra['input_class'], 'value' => $value, 'selected' => $value, 'empty' => __('[Any ' . Inflector::humanize($field) . ']', true)));
                }
            }
        }
        $output .= $this->Html->div('FilterAction filter-action', $this->Form->submit(__('Filter', true), array('class' => 'btn btn-default btn-xs', 'div' => false)) . $this->Form->input(__('Clear', true), array('label' => false, 'div' => false, 'value' => 'Clear', 'class' => 'btn btn-primary btn-sm', 'id' => 'FilterClear', 'type' => 'reset',)));
        $output .= $this->Form->end();

        $output .= $this->Html->div('clear', '');
        $clearUrl = Router::url(array('action' => 'reset_filter', 'admin' => false, 'prefix' => false));

        $script = <<<CODEBLOCK
$('#FilterClear').click(function(){ $.ajax({url : '$clearUrl', success: function(data, status){window.location = "$this->here"; }});});
CODEBLOCK;
        if ($hasDate) {
            $output .= $this->Html->script('jquery.datepick');
            $this->Html->css('jquery.datepick', null, array('inline' => false));
            $script .= '$(".hasDate").datepick({dateFormat: "dd-mm-yy"});';
        }
        $output .= $this->Html->scriptBlock('$(function(){' . $script . '});');
        return $this->Html->div($extra['div_class'], $output, array('id' => $extra['div_id']));
    }
    
    


}?>