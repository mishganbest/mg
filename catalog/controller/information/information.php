<?php 
class ControllerInformationInformation extends Controller {
	public function index() {  
    	$this->language->load('information/information');
		
		$this->load->model('catalog/information');
		
		$this->data['breadcrumbs'] = array();
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);
		
		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}
		
		$information_info = $this->model_catalog_information->getInformation($information_id);
   		
		if ($information_info) {
			if ($information_info['seo_title']) {
				$this->document->setTitle($information_info['seo_title']);
			} else {
				$this->document->setTitle($information_info['title']);
			}
			$this->document->setDescription($information_info['meta_description']);
			$this->document->setKeywords($information_info['meta_keyword']);
			
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $information_info['title'],
				'href'      => $this->url->link('information/information', 'information_id=' .  $information_id),      		
        		'separator' => $this->language->get('text_separator')
      		);		
						
			if ($information_info['seo_h1']) {
				$this->data['heading_title'] = $information_info['seo_h1'];
			} else {
				$this->data['heading_title'] = $information_info['title'];
			}
      		
      		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_send'] = $this->language->get('button_send');
			
		$this->data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');

		$this->data['text_wait'] = $this->language->get('text_wait');
		$this->data['text_reload'] = $this->language->get('text_reload');
		$this->data['text_contact'] = $this->language->get('text_contact');
	    	$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_patronymic'] = $this->language->get('entry_patronymic');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
	    	$this->data['entry_email'] = $this->language->get('entry_email');
	    	$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_website'] = $this->language->get('entry_website');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_address'] = $this->language->get('entry_address');
		$this->data['entry_inn'] = $this->language->get('entry_inn');
		$this->data['entry_comment'] = $this->language->get('entry_comment');

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['patronymic'])) {
			$this->data['patronymic'] = $this->request->post['patronymic'];
		} else {
			$this->data['patronymic'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = '';
		}
		
		if (isset($this->request->post['company'])) {
			$this->data['company'] = $this->request->post['company'];
		} else {
			$this->data['company'] = '';
		}

		if (isset($this->request->post['website'])) {
			$this->data['website'] = $this->request->post['website'];
		} else {
			$this->data['website'] = '';
		}

		if (isset($this->request->post['city'])) {
			$this->data['city'] = $this->request->post['city'];
		} else {
			$this->data['city'] = '';
		}

		if (isset($this->request->post['address'])) {
			$this->data['address'] = $this->request->post['address'];
		} else {
			$this->data['address'] = '';
		}

		if (isset($this->request->post['inn'])) {
			$this->data['inn'] = $this->request->post['inn'];
		} else {
			$this->data['inn'] = '';
		}

		if (isset($this->request->post['comment'])) {
			$this->data['comment'] = $this->request->post['comment'];
		} else {
			$this->data['comment'] = '';
		}

			$this->data['action'] = $this->url->link('information/information');
      		
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/information.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/information.tpl';
			} else {
				$this->template = 'default/template/information/information.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
	  		$this->response->setOutput($this->render());
    	} else {
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/information', 'information_id=' . $information_id),
        		'separator' => $this->language->get('text_separator')
      		);
				
	  		$this->document->setTitle($this->language->get('text_error'));
			
      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
					
	  		$this->response->setOutput($this->render());
    	}
  	}
	
	public function info() {
		$this->load->model('catalog/information');
		
		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}      
		
		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {
			$output  = '<html dir="ltr" lang="en">' . "\n";
			$output .= '<head>' . "\n";
			$output .= '  <title>' . $information_info['title'] . '</title>' . "\n";
			$output .= '  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$output .= '  <meta name="robots" content="noindex">' . "\n";
			$output .= '</head>' . "\n";
			$output .= '<body>' . "\n";
			$output .= '  <h1>' . $information_info['title'] . '</h1>' . "\n";
			$output .= html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
			$output .= '  </body>' . "\n";
			$output .= '</html>' . "\n";			

			$this->response->setOutput($output);
		}
	}

		public function validate() {

		$this->language->load('information/information');
		
		$json = array();
		
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			if ((utf8_strlen($this->request->post['lastname']) < 3) || (utf8_strlen($this->request->post['lastname']) > 20)) {
		      		$json['error'] = $this->language->get('error_lastname');
		    	}

		    	if ((utf8_strlen($this->request->post['firstname']) < 2) || (utf8_strlen($this->request->post['firstname']) > 15)) {
		      		$json['error'] = $this->language->get('error_firstname');
		    	}

			if ((utf8_strlen($this->request->post['telephone']) < 4) || (utf8_strlen($this->request->post['telephone']) > 15)) {
		      		$json['error'] = $this->language->get('error_telephone');
		    	}
		
		    	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
		      		$json['error'] = $this->language->get('error_email');
		    	}
		
		    	if ((utf8_strlen($this->request->post['company']) < 3) || (utf8_strlen($this->request->post['company']) > 30)) {
		      		$json['error'] = $this->language->get('error_company');
		    	}

			if ((utf8_strlen($this->request->post['city']) < 3) || (utf8_strlen($this->request->post['city']) > 20)) {
		      		$json['error'] = $this->language->get('error_city');
		    	}

			if ((utf8_strlen($this->request->post['address']) < 5) || (utf8_strlen($this->request->post['address']) > 50)) {
		      		$json['error'] = $this->language->get('error_address');
		    	}

			if ((utf8_strlen($this->request->post['inn']) < 5) || (utf8_strlen($this->request->post['inn']) > 30)) {
		      		$json['error'] = $this->language->get('error_inn');
		    	}
		
		if (!isset($json['error'])) {

	  		$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email'));
	  		$mail->setFrom($this->request->post['email']);
	  		$mail->setSender($this->request->post['firstname']);
	  		$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['firstname']), ENT_QUOTES, 'UTF-8'));

			$text = '';
			$text .= $this->language->get('text_title_page'). "\n\n";
			$text .= $this->language->get('entry_lastname') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['lastname'])) . "\n";
			$text .= $this->language->get('entry_firstname') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['firstname'])) . "\n";
			if (!empty($this->request->post['patronymic'])) {
			$text .= $this->language->get('entry_patronymic') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['patronymic'])) . "\n";
			}
			$text .= $this->language->get('entry_city') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['city'])) . "\n";
			$text .= $this->language->get('entry_company') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['company'])) . "\n";
			if (!empty($this->request->post['website'])) {
			$text .= $this->language->get('entry_website') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['website'])) . "\n";
			}
			$text .= $this->language->get('entry_email') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['email'])) . "\n";
			$text .= $this->language->get('entry_telephone') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['telephone'])) . "\n";
			$text .= $this->language->get('entry_address') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['address'])) . "\n";
			$text .= $this->language->get('entry_inn') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['inn'])) . "\n";
			if (!empty($this->request->post['comment'])) {
			$text .= $this->language->get('entry_comment') . " ";
			$text .= strip_tags(html_entity_decode($this->request->post['comment'])) . "\n";
			}

	  		$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
      			$mail->send();

			
			/* Send SMS */

			$phone = $this->request->post['telephone'];
				
			if ($this->config->get('sendsms')) {
				$text_sms = 'Оптовик: '.$phone.'';
				$options = array(
					'to' => $this->config->get('config_sms_to'),
					'copy' => $this->config->get('config_sms_copy'),
					'from' => $this->config->get('config_sms_from'),
					'username' => $this->config->get('config_sms_gate_username'),
					'password' => $this->config->get('config_sms_gate_password'),
					'message' => $text_sms
				);
				$this->load->library('sms');

				$sms = new Sms($this->config->get('config_sms_gatename'), $options);
				$sms->send();
			}
						
			/* Send SMS */

			$json['success'] = $this->language->get('text_success');
		}	  
  	}
	$this->response->setOutput(json_encode($json));
}

}
?>