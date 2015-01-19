<?php
class ControllerModuleLatest extends Controller {
	protected function index($setting) {
		$this->language->load('module/latest');
		
      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
				
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image');
		
		$this->data['products'] = array();
		
		$data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProducts($data);

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = false;
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
			
			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'price'   	 => $price,
				'minprice' => $minprice,
				'maxprice' => $maxprice,
				'special' 	 => $special,
				'rating'     => $rating,
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/latest.tpl';
		} else {
			$this->template = 'default/template/module/latest.tpl';
		}

		$this->render();
	}
}
?>