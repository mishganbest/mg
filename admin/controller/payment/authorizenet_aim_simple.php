<?php 
class ControllerPaymentAuthorizenetAimSimple extends Controller {
    private $error = array(); 

    public function index() {
        $this->load->language('payment/authorizenet_aim_simple');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
            
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('authorizenet_aim_simple', $this->request->post);                
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title']         = $this->language->get('heading_title');
        
        $this->data['text_enabled']          = $this->language->get('text_enabled');
        $this->data['text_disabled']         = $this->language->get('text_disabled');
        $this->data['text_all_zones']        = $this->language->get('text_all_zones');
        $this->data['text_test']             = $this->language->get('text_test');
        $this->data['text_live']             = $this->language->get('text_live');
        $this->data['text_authorization']    = $this->language->get('text_authorization');
        $this->data['text_capture']          = $this->language->get('text_capture');        
        $this->data['text_yes']              = $this->language->get('text_yes');        
        $this->data['text_no']               = $this->language->get('text_no');        
        $this->data['text_show']             = $this->language->get('text_show');        
        
        $this->data['entry_login']           = $this->language->get('entry_login');
        $this->data['entry_key']             = $this->language->get('entry_key');
        $this->data['entry_hash']            = $this->language->get('entry_hash');
        $this->data['entry_server']          = $this->language->get('entry_server');
        $this->data['entry_mode']            = $this->language->get('entry_mode');
        $this->data['entry_method']          = $this->language->get('entry_method');
        $this->data['entry_total']           = $this->language->get('entry_total');    
        $this->data['entry_order_status']    = $this->language->get('entry_order_status');        
        $this->data['entry_geo_zone']        = $this->language->get('entry_geo_zone');
        $this->data['entry_status']          = $this->language->get('entry_status');
        $this->data['entry_sort_order']      = $this->language->get('entry_sort_order');
        $this->data['entry_show_in_methods'] = $this->language->get('entry_show_in_methods');
        
        $this->data['button_save']           = $this->language->get('button_save');
        $this->data['button_cancel']         = $this->language->get('button_cancel');

        $this->data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
        $this->data['error_login'] = isset($this->error['login']) ? $this->error['login'] : '';
        $this->data['error_key'] = isset($this->error['key']) ? $this->error['key'] : '';
        
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_payment'),
            'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('payment/authorizenet_aim_simple', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
                
        $this->data['action'] = $this->url->link('payment/authorizenet_aim_simple', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->get_value('authorizenet_aim_simple_login');
        $this->get_value('authorizenet_aim_simple_key');
        $this->get_value('authorizenet_aim_simple_hash');
        $this->get_value('authorizenet_aim_simple_server');
        $this->get_value('authorizenet_aim_simple_mode');
        $this->get_value('authorizenet_aim_simple_method');
        $this->get_value('authorizenet_aim_simple_total');
        $this->get_value('authorizenet_aim_simple_order_status_id');
        $this->get_value('authorizenet_aim_simple_geo_zone_id');
        $this->get_value('authorizenet_aim_simple_status');
        $this->get_value('authorizenet_aim_simple_sort_order');
        $this->get_value('authorizenet_aim_simple_show_in_methods');
        
        $this->load->model('localisation/order_status');
        
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        
        $this->load->model('localisation/geo_zone');
                                        
        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
        
        $this->template = 'payment/authorizenet_aim_simple.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
                
        $this->response->setOutput($this->render());
    }

    private function get_value($name) {
        if (isset($this->request->post[$name])) {
            $this->data[$name] = $this->request->post[$name];
        } else {
            $this->data[$name] = $this->config->get($name);
        }
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'payment/authorizenet_aim_simple')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->request->post['authorizenet_aim_simple_login']) {
            $this->error['login'] = $this->language->get('error_login');
        }

        if (!$this->request->post['authorizenet_aim_simple_key']) {
            $this->error['key'] = $this->language->get('error_key');
        }
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }    
    }
}
?>