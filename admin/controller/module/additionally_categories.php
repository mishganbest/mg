<?php
class ControllerModuleAdditionallyCategories extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/additionally_categories');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		$this->data['success'] = "";
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->request->post['additionally_categories_category'] = implode("_", $this->request->post['additionally_categories_category']);
			$this->model_setting_setting->editSetting('additionally_categories', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			$this->data['success'] = $this->language->get('text_success');
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token']);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_left'] = $this->language->get('text_left');
		$this->data['text_right'] = $this->language->get('text_right');
		$this->data['text_home'] = $this->language->get('text_home');
		
		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['entry_no_limit'] = $this->language->get('entry_no_limit');
		$this->data['entry_limit_default'] = $this->language->get('entry_limit_default');
		
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['entry_category'] = $this->language->get('entry_category');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);
		$this->data['breadcrumbs'][] = array(
			'href'      => HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'],
			'text'      => $this->language->get('text_modules'),
			'separator' => ' :: '
		);
		$this->data['breadcrumbs'][] = array(
			'href'      => HTTPS_SERVER . 'index.php?route=module/additionally_categories&token=' . $this->session->data['token'],
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=module/additionally_categories&token=' . $this->session->data['token'];
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['additionally_categories_status'])) {
			$this->data['additionally_categories_status'] = $this->request->post['additionally_categories_status'];
		} else {
			$this->data['additionally_categories_status'] = $this->config->get('additionally_categories_status');
		}
		
		$this->data['positions'] = array();
		
		$this->data['positions'][] = array(
			'position' => 'left',
			'title'    => $this->language->get('text_left')
		);
		
		$this->data['positions'][] = array(
			'position' => 'right',
			'title'    => $this->language->get('text_right')
		);
		
		$this->data['positions'][] = array(
			'position' => 'home',
			'title'    => $this->language->get('text_home')
		);
		
		if (isset($this->request->post['additionally_categories_position'])) {
			$this->data['additionally_categories_position'] = $this->request->post['additionally_categories_position'];
		} else {
			$this->data['additionally_categories_position'] = $this->config->get('additionally_categories_position');
		}
		
		if (isset($this->request->post['additionally_categories_sort_order'])) {
			$this->data['additionally_categories_sort_order'] = $this->request->post['additionally_categories_sort_order'];
		} else {
			$this->data['additionally_categories_sort_order'] = $this->config->get('additionally_categories_sort_order');
		}
		
		$this->data['additionally_categories_category'] = array();
		if (isset($this->request->post['additionally_categories_category'])) {
			$this->data['additionally_categories_category'] = explode("_", $this->request->post['additionally_categories_category']);
		} else {
			$this->data['additionally_categories_category'] = explode("_", $this->config->get('additionally_categories_category'));
		}
		
		if (isset($this->request->post['additionally_categories_limit'])) {
			$this->data['additionally_categories_limit'] = $this->request->post['additionally_categories_limit'];
		} else {
			$this->data['additionally_categories_limit'] = $this->config->get('additionally_categories_limit');
		}

		$this->data['modules'] = array();
		
		if (isset($this->request->post['additionally_categories_module'])) {
			$this->data['modules'] = $this->request->post['additionally_categories_module'];
		} elseif ($this->config->get('additionally_categories_module')) { 
			$this->data['modules'] = $this->config->get('additionally_categories_module');
		}
		
		$this->load->model('design/layout');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		
		$this->template = 'module/additionally_categories.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/additionally_categories')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>