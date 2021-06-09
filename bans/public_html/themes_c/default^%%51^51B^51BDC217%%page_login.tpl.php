<?php /* Smarty version 2.6.31, created on 2020-09-03 02:34:23
         compiled from page_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sb_button', 'page_login.tpl', 29, false),)), $this); ?>
<table style="margin: 30px auto;">
	<tr>
		<td class="listtable_top"><b>Admin Login</b></td>
	</tr>
	<tr>
		<td class="listtable_1" style="padding: 15px;">
	        <div id="login-content">
				<?php if ($this->_tpl_vars['steamlogin_show'] == 1): ?>
					<div id="loginUsernameDiv">
						<label for="loginUsername">Username:</label><br />
						<input id="loginUsername" class="loginmedium" type="text" name="username"value="" />
					</div>
					<div id="loginUsername.msg" class="badentry"></div>
			
					<div id="loginPasswordDiv">
						<label for="loginPassword">Password:</label><br />
						<input id="loginPassword" class="loginmedium" type="password" name="password" value="" />
					</div>
					<div id="loginPassword.msg" class="badentry"></div>
			
					<div id="loginRememberMeDiv">
						<input id="loginRememberMe" type="checkbox" class="checkbox" name="remember" value="checked" vspace="5px" />    <span class="checkbox" style="cursor:pointer;" onclick="($('loginRememberMe').checked?$('loginRememberMe').checked=false:$('loginRememberMe').checked=true)">Remember me</span>
					</div>
				<?php endif; ?>
				<div id="loginSubmit">                    
					<center><a href="steamopenid.php"><img src="images/steamlogin.png"></a></center>
					<br>
					<?php if ($this->_tpl_vars['steamlogin_show'] == 1): ?>
						<?php echo smarty_function_sb_button(array('text' => 'Login','onclick' => $this->_tpl_vars['redir'],'class' => 'ok login','id' => 'alogin','style' => "width: 100%; text-transform: uppercase;",'submit' => false), $this);?>

					<?php endif; ?>
				</div>
				<?php if ($this->_tpl_vars['steamlogin_show'] == 1): ?>
					<div id="loginOtherlinks">
						<a href="index.php?p=lostpassword">Lost your password?</a>
					</div>
				<?php endif; ?>
	        </div>
        </td>
    </tr>
</table>
	
<script>
	$E('html').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'enter' ) <?php echo $this->_tpl_vars['redir']; ?>

	};$('loginRememberMeDiv').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'space' ) $('loginRememberMeDiv').checked = true;
	};$('button').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'space' ) <?php echo $this->_tpl_vars['redir']; ?>

	};
</script>