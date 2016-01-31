<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @descripcion: Helper used to upload files
 * @author: Abner Tellez
 */

	function create_thumbnail($source_image, $width, $height,$new_image){
		
		$CI =& get_instance();				
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;	
        $config['new_image'] = $new_image;	
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		
		$image_size = getimagesize ($source_image);
		
		if($image_size[0] > $image_size[1]){
			$config['master_dim'] = 'width';	
		}else{
			$config['master_dim'] = 'height';
		}
		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config); 
		$CI->image_lib->resize(); 
		
	}
 
/* End of file pro_image.php */
/* Location: ./application/helpers/pro_image.php */
