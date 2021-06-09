<?php /* Smarty version 2.6.31, created on 2020-09-04 13:37:51
         compiled from page_lostpassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sb_button', 'page_lostpassword.tpl', 27, false),)), $this); ?>
<div id="lostpassword"> 
	<div id="login-content">

		<div id="msg-red" style="display:none;">
			<i><img src="./images/warning.png" alt="Warning" /></i>
			<b>Error</b>
			<br />
			The email address you supplied is not registered on the system.</i>
		</div>
		<div id="msg-blue" style="display:none;">
			<i><img src="./images/info.png" alt="Warning" /></i>
			<b>Information</b>
			<br />
			Please check your email inbox (and spam) for a link which will help you reset your password.</i>
		</div>

	  	<h4>
	  		Please type your email address in the box below to have your password reset. 
	  	</h4><br />
	  	
  		<div id="loginPasswordDiv">
	    	<label for="email">Your E-Mail Address:</label><br />
	   		<input id="email" class="loginmedium" type="text" name="password" value="" />
		</div>
		
		<div id="loginSubmit">
			<?php echo smarty_function_sb_button(array('text' => 'Ok','onclick' => "xajax_LostPassword($('email').value);",'class' => 'ok','id' => 'alogin','submit' => false), $this);?>

		</div>
		
	</div>
</div>