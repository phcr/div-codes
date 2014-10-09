<?php 
	class Validator
	{
		protected $_intputType;
		protected $_submitted;
		protected $_required;
		protected $_filterArgs;
		protected $_filtered;
		protected $_missing;
		protected $_errors;
		
		public function __construct($required = array(), $intputType = 'post')
		{
			if (!function_exists('filter_list')) {
				throw new Exception('The Validator class requires the Filter Functions in >= PHP 5.2 or PECL.');
			}
			if (!is_null($required) && !is_array($required)) {
				throw new Exception ('The names of required fields must be an array, even if only on field is required.');
			}
			$this->_required = $required;
			$this->setInputType($intputType);
			if ($this->_required) {
				$this->checkRequired();	
			}
			$this->_filterArgs = array();
			$this->_errors = array();
		}		
		protected function setInputType ($type)
		{
			switch (strtolower($type)) {
				case 'post':
					$this->_intputType = INPUT_POST;
					$this->_submitted = $_POST;
					break;
				case 'get':
					$this->_intputType = INPUT_GET;
					$this->_submitted = $_GET;
					break;
				default:
					throw new Exception('Invalid input type. Valid types are "post" and "get".');
					break;
			}
		}
		protected function checkRequired()
		{
			$OK = array();
			foreach ($this->_submitted as $name => $value) {
				$value = is_array($value) ? $value : trim($value);
				if (!emtpy($value)) {
					$OK[] = $name;
				}
			}
			$this->_missing = array_diff($this->_required, $OK);
		}
		
	}
		
		
		
	?>