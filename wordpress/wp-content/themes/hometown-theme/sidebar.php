<?php 
	if(is_page_template('template-dsidxpress.php')) {
		dynamic_sidebar('dsidxpress'); 
	} else {
		dynamic_sidebar('page'); 
	}
?>