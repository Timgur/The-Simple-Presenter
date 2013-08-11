<?php
    class Zip
	{
		public $file_dir    = 'wp-content/themes/thesimplepresenter';
		public $live_file   = 'http://localhost:8888/pitch';
		public $index       = 'index.html';
		public $image_array = array();
		public $current_tag;

		private $_json_file  = 'slides.json';
		private $_zipA;

		public function __construct($tag)
		{
            $this->current_tag = $tag;
			$this->create_index();
			$this->update_images();
			$this->create_zip($this->current_tag . '.zip', true);
		}

		public function update_images()
		{
			$posts = json_decode(file_get_contents($this->file_dir . '/' . $this->_json_file));
            foreach ($posts as $post) {
				if(is_array($post->image_links)) {
					foreach($post->image_links as $image) {
						$this->image_array[] = $image;
					}
				} else {
					$this->image_array[] = $post->image_links;
				}
            }
		}

		private function create_zip($destination = '', $overwrite = false)
		{
            //if the zip file already exists and overwrite is false, return false
			if(file_exists($destination) && !$overwrite) { return false; }

			$this->_zipA = new ZipArchive();

			if($this->_zipA->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			$this->add_file($this->file_dir, $this->current_tag);
			$this->add_file($this->image_array, $this->current_tag . '/img/uploads');

			$this->_zipA->close();
		}

		private function add_file($src, $dest)
		{
			$item;
			if (is_array($src)) {
               $item = $src;
			} else {
               $item = scandir($src);
			}
			
			foreach ($item as $result) {
				if($result === '.'
				   or $result === '..'
				   or $result === 'jasmine'
				   or $result === 'sass'
				   or preg_match('/.php/', $result)) continue;
				
				if(is_dir($src . '/' . $result)) {
					$this->_zipA->addEmptyDir($dest . '/' . $result);
					$this->add_file($src . '/' . $result, $dest . '/' . $result);
				} else if(is_array($src)) {
					$image = substr(strrchr($result, "/"), 1);
                    $this->_zipA->addFromString($dest . '/' . $image, file_get_contents($result));
				} else {
					$this->_zipA->addFromString($dest . '/' .$result, file_get_contents($src . '/' . $result));
				}
			}
		}

		private function create_index()
		{
			$content = file_get_contents($this->live_file . '/' . $this->current_tag);
		    $replacedContent = str_replace('http://' . $_SERVER['HTTP_HOST'] . '/wp-content/themes/thesimplepresenter/', '', $content);
			$makeIndex = fopen($this->file_dir . '/' . $this->index, 'w') or die('Cannot open file: '. $this->file_dir . '/' . $this->index);
			fwrite($makeIndex, $replacedContent);
			fclose($makeIndex);
		}

	}
?>
