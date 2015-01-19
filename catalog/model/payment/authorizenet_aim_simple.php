<?php 
class ModelPaymentAuthorizeNetAimSimple extends Model {
    private $data;

    public function getMethod($address, $total) {
        $this->load->language('payment/authorizenet_aim_simple');
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('authorizenet_aim_simple_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
        
        if ($this->config->get('authorizenet_aim_simple_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('authorizenet_aim_simple_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }    
        
        $method_data = array();
    
        if ($status) {  
            $description = '';
            
            if ($this->config->get('authorizenet_aim_simple_show_in_methods')) {
                $description = '</label>'.$this->get_form().'<label>';
            }

            $method_data = array( 
                'code'        => 'authorizenet_aim_simple',
                'title'       => $this->language->get('text_title'),
                'sort_order'  => $this->config->get('authorizenet_aim_simple_sort_order'),
                'description' => $description
            );
        }

        return $method_data;
    }

    private function get_form() {
        $this->language->load('payment/authorizenet_aim_simple');

        $this->data = array();

        $this->data['simple_create_order'] = !empty($this->request->post['simple_create_order']);  
        $this->data['error_warning'] = '';

        $this->get_values();

        if ($this->request->server['REQUEST_METHOD'] == 'GET' || ($this->request->server['REQUEST_METHOD'] == 'POST' && !empty($this->request->post['payment_method']) && $this->request->post['payment_method'] == 'authorizenet_aim_simple')) {
            $this->validate();
        }

        $this->data['text_credit_card']     = $this->language->get('text_credit_card');
        $this->data['text_wait']            = $this->language->get('text_wait');
        
        $this->data['entry_cc_owner']       = $this->language->get('entry_cc_owner');
        $this->data['entry_cc_number']      = $this->language->get('entry_cc_number');
        $this->data['entry_cc_expire_date'] = $this->language->get('entry_cc_expire_date');
        $this->data['entry_cc_cvv2']        = $this->language->get('entry_cc_cvv2');
        
        $this->data['button_confirm']       = $this->language->get('button_confirm');
        
        $this->data['months'] = array();
        
        for ($i = 1; $i <= 12; $i++) {
            $this->data['months'][] = array(
                'text'  => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)), 
                'value' => sprintf('%02d', $i)
            );
        }
        
        $today = getdate();

        $this->data['year_expire'] = array();

        for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
            $this->data['year_expire'][] = array(
                'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)) 
            );
        }

        return $this->get_form_template();
    }

    private function get_values() {
        $this->get_value('cc_owner');
        $this->get_value('cc_number');
        $this->get_value('cc_expire_date_month');
        $this->get_value('cc_expire_date_year');
        $this->get_value('cc_cvv2');
    }

    private function get_value($name) {
        $this->data['simple_'.$name] = '';
        if (!empty($this->request->post['simple_'.$name])) {
            $this->data['simple_'.$name] = $this->request->post['simple_'.$name];
            $this->session->data['authorizenet_aim_simple'][$name] = $this->request->post['simple_'.$name];
        } elseif (!empty($this->session->data['authorizenet_aim_simple'][$name])) {
            //$this->data['simple_'.$name] = $this->session->data['authorizenet_aim_simple'][$name];
        }
    }

    private function validate() {
        $error = false;

        if (empty($this->data['simple_cc_cvv2'])) {
            $this->data['error_warning'] = $this->language->get('error_empty_cvv2');
            $error = true;
        }

        if (empty($this->data['simple_cc_expire_date_year'])) {
            $this->data['error_warning'] = $this->language->get('error_empty_year');
            $error = true;
        }

        if (empty($this->data['simple_cc_expire_date_month'])) {
            $this->data['error_warning'] = $this->language->get('error_empty_month');
            $error = true;
        }

        if (empty($this->data['simple_cc_number'])) {
            $this->data['error_warning'] = $this->language->get('error_empty_number');
            $error = true;
        }

        if (empty($this->data['simple_cc_owner'])) {
            $this->data['error_warning'] = $this->language->get('error_empty_owner');
            $error = true;
        }

        if ($error) {
            $this->simple->add_error('payment');
        }

        return !$error;
    }

    private function get_form_template() {
        $tpl = (($this->data['simple_create_order'] && $this->data['error_warning']) ? '<div class="simplecheckout-warning-block">'.$this->data['error_warning'].'</div>' : '').
            '<table class="form" style="margin:0px;" id="authorizenet_aim_simple_inputs">'.
            '<tr>'.
            '<td>'.$this->data['entry_cc_owner'].'</td>'.
            '<td><input type="text" onchange="customer_field_changed()" name="simple_cc_owner" value="'.$this->data['simple_cc_owner'].'" /></td>'.
            '</tr>'.
            '<tr>'.
            '<td>'.$this->data['entry_cc_number'].'</td>'.
            '<td><input type="text" onchange="customer_field_changed()" name="simple_cc_number" value="'.$this->data['simple_cc_number'].'" /></td>'.
            '</tr>'.
            '<tr>'.
            '<td>'.$this->data['entry_cc_expire_date'].'</td>'.
            '<td>'.
            '<select onchange="customer_field_changed()" name="simple_cc_expire_date_month">';
        
        foreach ($this->data['months'] as $month) {
            $tpl .= '<option value="'.$month['value'].'" '.($this->data['simple_cc_expire_date_month'] == $month['value'] ? ' selected="selected"' : '').'>'.$month['text'].'</option>';

        }
        
        $tpl .= '</select> / <select onchange="customer_field_changed()" name="simple_cc_expire_date_year">';
        
        foreach ($this->data['year_expire'] as $year) {
            $tpl .= '<option value="'.$year['value'].'" '.($this->data['simple_cc_expire_date_year'] == $year['value'] ? ' selected="selected"' : '').'>'.$year['text'].'</option>';
        }
        
        $tpl .= '</select>'.
            '</td>'.
            '</tr>'.
            '<tr>'.
            '<td>'.$this->data['entry_cc_cvv2'].'</td>'.
            '<td><input onchange="customer_field_changed()" type="text" name="simple_cc_cvv2" value="'.$this->data['simple_cc_cvv2'].'" size="3" /></td>'.
            '</tr>'.
            '</table>';

        $tpl .= '<script type="text/javascript">$(function(){';
        $tpl .= 'if ($("input[name=\'payment_method\']:checked").val() != "authorizenet_aim_simple") {$("#authorizenet_aim_simple_inputs").closest("tr").hide();}';
        $tpl .= '});</script>';

        return $tpl;
    }
}
?>