<?php
class ControllerModuleAuthorizeNetAimSimple extends Controller {
    protected function index($setting) {
        $payment_method = $this->simple->payment_method;
        
        if (!$this->config->get('authorizenet_aim_simple_status') || empty($payment_method['code']) || (!empty($payment_method['code']) && $payment_method['code'] != 'authorizenet_aim_simple')) {
            return;
        }

        $this->language->load('payment/authorizenet_aim_simple');

        $this->data['simple_create_order'] = !empty($this->request->post['simple_create_order']);  
        $this->data['error_warning'] = '';

        $this->get_values();
        $this->validate();

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

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/authorizenet_aim_simple.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/authorizenet_aim_simple.tpl';
        } else {
            $this->template = 'default/template/module/authorizenet_aim_simple.tpl';
        }    
        
        $this->render();        
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
            $this->simple->add_error('authorizenet_aim_simple');
        }

        return !$error;
    }
}
?>