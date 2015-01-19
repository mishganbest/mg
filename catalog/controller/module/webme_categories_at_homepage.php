<?php
class ControllerModuleWebmeCategoriesAtHomepage extends Controller {
	protected function index($setting) {
		$this->id = 'webme_categories_at_homepage';
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->load->language('module/webme_categories_at_homepage');
		
		/* ===================================== */
		
		$this->load->model('catalog/category');
		
		$category_ids = explode("_", $this->config->get('webme_categories_at_homepage_category'));
		foreach ($category_ids as $cat_id) {
			$category_id = $cat_id;
			$category_info = $this->model_catalog_category->getCategory($category_id);
			
			if ($category_info) {
				$this->data['w_categories'][$category_id]['category_id'] = $category_info['category_id'];
				$this->data['w_categories'][$category_id]['heading_title'] = $category_info['name'];
				$this->data['w_categories'][$category_id]['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
				$this->data['w_categories'][$category_id]['href'] = $this->url->link('product/category', 'path='.$category_id);
				
				
				$this->load->model('tool/image');
				
				if ($category_info['image']) {
					$image = $category_info['image'];
				} else {
					$image = '';
				}
				
				$this->data['w_categories'][$category_id]['thumb'] = $this->model_tool_image->resize($image, $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
				
				$this->load->model('catalog/webme_categories_at_homepage');
				$this->load->model('catalog/product');
				$this->load->model('catalog/review');
				
				$product_total = $this->model_catalog_webme_categories_at_homepage->getTotalProductsByCategoryId($category_id);
				
				if ($product_total) {
					$this->data['w_categories'][$category_id]['button_add_to_cart'] = $this->language->get('button_add_to_cart');
					$this->data['w_categories'][$category_id]['products'] = array();
					
					$w_sort_order = explode("-", $this->config->get('webme_categories_at_homepage_sort_by'));
					$sort = $w_sort_order["0"];
					$order = $w_sort_order["1"];
					
					$wProdLimit = $this->config->get('webme_categories_at_homepage_limit');
					
					$data = array(
						'filter_category_id' => $category_id, 
						'sort'               => $sort,
						'order'              => $order,
						'start'              => 0,
						'limit'              => 4
					);
					if ($wProdLimit > 0) {
						if ($this->config->get('webme_categories_at_homepage_limit') > 0) {
							$data['limit'] = $this->config->get('webme_categories_at_homepage_limit');
						}
						$results = $this->model_catalog_product->getProducts($data);
					} else {
						$results = $this->model_catalog_product->getProducts($data);
					}
					
        			foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], 170, 170);
					} else {
						$image = $this->model_tool_image->resize('no_image.jpg', 170, 170);
					}
					
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = number_format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')),0,'',' ');
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					$special = number_format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')),0,'',' ');
				} else {
					$special = false;
				}
					
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}

				$option_prices = $this->model_catalog_product->getOptionPrice($result['product_id']);

				foreach ($option_prices as $option_price) {
					if ($option_price['minprice'] && !(float)$result['special']) {
						$minprice = number_format($option_price['minprice'],0,'',' ');
					} elseif ($option_price['minprice'] && (float)$result['special']) {
						$subtracting = $result['price'] - $result['special'];
						$option_result_price = $option_price['minprice'] - $subtracting;
						$minprice = number_format($option_result_price,0,'',' ');
					} else {
						$minprice = false;
					}
	
					if ($option_price['maxprice'] && !(float)$result['special']) {
						$maxprice = number_format($option_price['maxprice'],0,'',' ');
					} elseif ($option_price['maxprice'] && (float)$result['special']) {
						$subtracting = $result['price'] - $result['special'];
						$option_result_price = $option_price['maxprice'] - $subtracting;
						$maxprice = number_format($option_result_price,0,'',' ');
					} else {
						$maxprice = false;
					}
				}

					if ($category_id == '59' || $category_id == '60') {

					$this->data['w_categories'][59]['products'][] = array(
						'product_id' => $result['product_id'],
						'thumb'   	 => $image,
						'name'    	 => $result['name'],
						'price'   	 => $price,
						'minprice' 	=> $minprice,
						'maxprice' 	=> $maxprice,
						'special' 	 => $special,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
					);

					} else {
					
					$this->data['w_categories'][$category_id]['products'][] = array(
						'product_id' => $result['product_id'],
						'thumb'   	 => $image,
						'name'    	 => $result['name'],
						'price'   	 => $price,
						'minprice' 	=> $minprice,
						'maxprice' 	=> $maxprice,
						'special' 	 => $special,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
					);
					}
				}
				
				if (!$this->config->get('config_customer_price')) {
					$this->data['w_categories'][$category_id]['display_price'] = TRUE;
				} elseif ($this->customer->isLogged()) {
					$this->data['w_categories'][$category_id]['display_price'] = TRUE;
				} else {
					$this->data['w_categories'][$category_id]['display_price'] = FALSE;
				}
			}
		}
		/* ===================================== */
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/webme_categories_at_homepage.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/webme_categories_at_homepage.tpl';
		} else {
			$this->template = 'default/template/module/webme_categories_at_homepage.tpl';
		}
		$this->render();
	}
	}
}
?>