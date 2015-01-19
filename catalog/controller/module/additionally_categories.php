<?php
class ControllerModuleAdditionallyCategories extends Controller {
	protected function index($setting) {
		$this->id = 'additionally_categories';
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->load->model('catalog/category');
		
		$category_ids = explode("_", $this->config->get('additionally_categories_category'));
		foreach ($category_ids as $cat_id) {
			$category_id = $cat_id;
			$category_info = $this->model_catalog_category->getCategory($category_id);
			
			if ($category_info) {
				$this->data['w_categories'][$category_id]['heading_title'] = $category_info['name'];
				$this->data['w_categories'][$category_id]['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
				$this->data['w_categories'][$category_id]['href'] = $this->url->link('product/category', 'path='.$category_id);
				
				$this->load->model('tool/image');
				
				if ($category_info['image']) {
					$image = $category_info['image'];
				} else {
					$image = '';
				}
				
				$this->data['w_categories'][$category_id]['thumb'] = $this->model_tool_image->resize($image, 300, 160);
				
				$this->load->model('catalog/additionally_categories');

				}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/additionally_categories.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/additionally_categories.tpl';
		} else {
			$this->template = 'default/template/module/additionally_categories.tpl';
		}
		$this->render();
	}
	}
}
?>