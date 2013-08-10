<?php
    class Zip
	{
		public $file_dir    = '/wp-content/themes/thesimplepresenter/';
		public $live_file   = 'http://localhost:8888/tag/';
		public $index       = 'index.html';
		public $jsonFile    = 'slides.json';
		public $current_tag;

		public function __construct($tag)
		{
            $this->current_tag = $tag;
		}

		public function setup_folder()
	    {
			$this->create_index();
			$this->create_zip(array($this->_index), $this->current_tag . '.zip', true);
		}

		private function create_zip($files = array(), $destination = '', $overwrite = false)
		{
            //if the zip file already exists and overwrite is false, return false
			if(file_exists($destination) && !$overwrite) { return false; }

			$valid_files = array();
			if(is_array($files)) {
				foreach($files as $file) {
					if(file_exists($file)) {
						$valid_files[] = $file;
					}
				}
			}

			if(count($valid_files)) {
                //create the archive
				$zipA = new ZipArchive();
				
				if($zipA->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
					return false;
				}

				foreach($valid_files as $file) {
					$zipA->addFile($file);
				}

				$zipA->close();

				//check to make sure the file exists
				return file_exists($destination);
			} else {
				return false;
			}
		}

		private function create_folder()
		{

		}

		private function create_index()
		{
			$content = file_get_contents($this->_file);
			$makeIndex = fopen($this->fileDir . $this->_index, 'w') or die('Cannot open file: '. $this->_index);
			file_put_contents($makeIndex, $content, LOCK_EX);
			fclose($makeIndex);
		}

	}
?>
