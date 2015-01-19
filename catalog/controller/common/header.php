<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle();
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = $this->config->get('config_ssl');
		} else {
			$this->data['base'] = $this->config->get('config_url');
		}
		
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}
				
		$this->language->load('common/header');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = HTTPS_IMAGE;
		} else {
			$server = HTTP_IMAGE;
		}	
				
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		$this->data['name'] = $this->config->get('config_name');
				
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . $this->config->get('config_logo');

		} else {
			$this->data['logo'] = '';
		}
		
		$this->data['text_home'] = $this->language->get('text_home');
                $this->data['text_logotype'] = $this->language->get('text_logotype');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
    	$this->data['text_search'] = $this->language->get('text_search');
          
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
		$this->data['text_account'] = $this->language->get('text_account');
    	$this->data['text_checkout'] = $this->language->get('text_checkout');
				
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');


	// URL Detect
		$full_url = $this->request->server['REQUEST_URI'];
 
		$url_detect_1 = 'utm_source=marketplace&amp;utm_medium=pulscen';
 
		$detect1 = strpos($full_url, $url_detect_1);
		if ($detect1 == true) {
			$this->session->data['url_detect'] = '8 (383) 207-55-34';
		}

		$url_detect_2 = 'utm_source=marketplace&amp;utm_medium=blizko&amp;utm_source=blizkoru_id12694548';
 
		$detect2 = strpos($full_url, $url_detect_2);
		if ($detect2 == true) {
			$this->session->data['url_detect'] = '8 (383) 207-56-39';
		}

		$url_detect_3 = '_openstat=dGVzdDsxOzE7';
 
		$detect3 = strpos($full_url, $url_detect_3);
		if ($detect3 == true) {
			$this->session->data['url_detect'] = '8 (383) 207-56-73';
		}

		$url_detect_4 = 'utm_source=marketplace&amp;utm_medium=begun';
 
		$detect4 = strpos($full_url, $url_detect_4);
		if ($detect4 == true) {
			$this->session->data['url_detect'] = '8 (383) 207-56-15';
		}

		$url_detect_5 = 'yclid';
 
		$detect5 = strpos($full_url, $url_detect_5);
		if ($detect5 == true) {
			$this->session->data['url_detect'] = '8 (383) 207-56-73';
		}
	// URL Detect

		
		if (isset($this->request->get['filter_name'])) {
			$this->data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$this->data['filter_name'] = '';
		}
		
		
		$module_data = array();
		
		$this->load->model('setting/extension');
		
		$extensions = $this->model_setting_extension->getExtensions('module');		
		
		foreach ($extensions as $extension) {
			$modules = $this->config->get($extension['code'] . '_module');
			
			if ($modules) {
				foreach ($modules as $module) {
					if ($extension['code'] == 'recall' && $module['status']) {
						$module_data[] = array(
							'code'       => $extension['code'],
							'setting'    => $module
						);				
					}
				}
			}
		}
		
		$this->data['modules'] = array();
		
		foreach ($module_data as $module) {
			$module = $this->getChild('module/' . $module['code'], $module['setting']);
			
			if ($module) {
				$this->data['modules'][] = $module;
			}
		}
		
		if ($this->config->get('config_geo')) {
	        $this->load->model('module/geo');
		$city = $this->model_module_geo->smarty_function_get_city();
		$this->data['city'] = $city;
		} else {
		$this->data['city'] = 'Новосибирск';
		$city = 'Новосибирск';
		}
		
		$this->load->model('catalog/article');
					
		$articles = $this->model_catalog_article->getArticles(0);
		
		foreach ($articles as $article) {
			
			$children = $this->model_catalog_article->getArticles($article['article_id']);
			
			foreach ($children as $child) {
					
					
					if ($city == $child['city'] && $article['article_id'] == 1) {
					
					
					$this->data['delivery_href'] = $this->url->link('information/article', 'id=1_' . $child['article_id']);
					}
					
					if ($city == $child['city'] && $article['article_id'] == 2) {
					
					
					$this->data['contact_href'] = $this->url->link('information/article', 'id=2_' . $child['article_id']);
					
					} 
					
			}			
	}
		
		
		// Menu
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {
			if ($category['top']) {
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					$product_total = $this->model_catalog_product->getTotalProducts($data);

					if ($child['image']) {
						$thumb = $this->model_tool_image->resize($child['image'], 60, 60);
					} else {
						$thumb = $this->model_tool_image->resize('no_image.jpg', 60, 60);
					}

					if ($product_total == 1) {

					$oneproduct = $this->model_catalog_product->getOneProduct($child['category_id']);

					$children_data[] = array(
						'image'  => $thumb,
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'href'        => $this->url->link('product/product', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '&product_id=' . $oneproduct)	
					);

					} else {
									
					$children_data[] = array(
						'image'  => $thumb,
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
					);
					}						
				}
				
				// Level 1
				$this->data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'active'   => in_array($category['category_id'], $parts),
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
		
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
		
    	$this->render();
	} 	
}

?>
