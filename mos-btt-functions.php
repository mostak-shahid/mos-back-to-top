<?php
function mos_btt_admin_enqueue_scripts(){
	$page = @$_GET['page'];
	global $pagenow, $typenow;
	/*var_dump($pagenow); //options-general.php(If under settings)/edit.php(If under post type)
	var_dump($typenow); //post type(If under post type)
	var_dump($page); //mos_btt_settings(If under settings)*/
	
	if ($pagenow == 'options-general.php' AND $page == 'mos_btt_settings') {
		wp_enqueue_style( 'font-awesome.min', plugins_url( 'fonts/font-awesome-4.7.0/css/font-awesome.min.css', __FILE__ ) );
		wp_enqueue_style( 'mos-btt-admin', plugins_url( 'css/mos-btt-admin.css', __FILE__ ) );

		//wp_enqueue_media();

		wp_enqueue_script( 'jquery' );
		
		/*Editor*/
		//wp_enqueue_style( 'docs', plugins_url( 'plugins/CodeMirror/doc/docs.css', __FILE__ ) );
		wp_enqueue_style( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.css', __FILE__ ) );
		wp_enqueue_style( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.css', __FILE__ ) );

		wp_enqueue_script( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css', plugins_url( 'plugins/CodeMirror/mode/css/css.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript', plugins_url( 'plugins/CodeMirror/mode/javascript/javascript.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css-hint', plugins_url( 'plugins/CodeMirror/addon/hint/css-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript-hint', plugins_url( 'plugins/CodeMirror/addon/hint/javascript-hint.js', __FILE__ ), array('jquery') );
		/*Editor*/

		wp_enqueue_script( 'mos-btt-functions', plugins_url( 'js/mos-btt-functions.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'mos-btt-admin', plugins_url( 'js/mos-btt-admin.js', __FILE__ ), array('jquery') );
	}
}
add_action( 'admin_enqueue_scripts', 'mos_btt_admin_enqueue_scripts' );
function mos_btt_enqueue_scripts(){
	$mos_btt_option = get_option( 'mos_btt_options' );
	if ($mos_btt_option['jquery']) {
		wp_enqueue_script( 'jquery' );
	}
	if ($mos_btt_option['fontawesome']) {
		wp_enqueue_style( 'font-awesome.min', plugins_url( 'fonts/font-awesome-4.7.0/css/font-awesome.min.css', __FILE__ ) );
	}
	wp_enqueue_style( 'mos-btt', plugins_url( 'css/mos-btt.css', __FILE__ ) );
	wp_enqueue_script( 'mos-btt-functions', plugins_url( 'js/mos-btt-functions.js', __FILE__ ), array('jquery') );
	wp_enqueue_script( 'mos-btt', plugins_url( 'js/mos-btt.js', __FILE__ ), array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'mos_btt_enqueue_scripts' );
function mos_btt_ajax_scripts(){
	wp_enqueue_script( 'mos-btt-ajax', plugins_url( 'js/mos-btt-ajax.js', __FILE__ ), array('jquery') );
	$ajax_params = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce('mos_btt_verify'),
	);
	wp_localize_script( 'mos-btt-ajax', 'ajax_obj', $ajax_params );
}
add_action( 'wp_enqueue_scripts', 'mos_btt_ajax_scripts' );
add_action( 'admin_enqueue_scripts', 'mos_btt_ajax_scripts' );


add_action( 'wp_footer', 'mos_btt_fnc', 10 );
function mos_btt_fnc () {
	$mos_btt_option = get_option( 'mos_btt_options' );
	//var_dump($mos_btt_option);
	$text = ($mos_btt_option['mos_btt_text'])  ?$mos_btt_option['mos_btt_text']:'';	
	$icon = ($mos_btt_option['mos_btt_icon']) ? $mos_btt_option['mos_btt_icon']:'';	
	$orientation = ($mos_btt_option['mos_btt_orientation']) ? $mos_btt_option['mos_btt_orientation']:'';
	$orientation = str_replace("{{text}}",$text,$orientation);	
	$orientation = str_replace("{{icon}}",'<i class="'.$icon.'">i</i>',$orientation);
	var_dump($orientation);
	?>
	<a href="javascript:void(0)" class="scrollup" style="display: none;"><?php echo $orientation ?></a>
	<?php
}
function mos_btt_scripts() {
	$mos_btt_option = get_option( 'mos_btt_options' );
	if ($mos_btt_option['css']) {
		?>
		<style>
			<?php echo $mos_btt_option['css'] ?>
		</style>
		<?php
	}
	if ($mos_btt_option['js']) {
		?>
		<style>
			<?php echo $mos_btt_option['js'] ?>
		</style>
		<?php
	}
}
add_action( 'wp_footer', 'mos_btt_scripts', 100 );

