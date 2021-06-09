<?php /* Smarty version 2.6.31, created on 2020-09-02 23:08:19
         compiled from page_header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['header_title'] != ""): ?><?php echo $this->_tpl_vars['header_title']; ?>
<?php else: ?>SourceBans<?php endif; ?></title>
<link rel="Shortcut Icon" href="themes/<?php echo $this->_tpl_vars['theme_name']; ?>
/images/favicon.ico" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="./scripts/sourcebans.js"></script>
<link href="themes/<?php echo $this->_tpl_vars['theme_name']; ?>
/css/css.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./scripts/mootools.js"></script>
<script type="text/javascript" src="./scripts/contextMenoo.js"></script>


<?php echo $this->_tpl_vars['tiny_mce_js']; ?>

<?php echo $this->_tpl_vars['xajax_functions']; ?>



</head>
<body>


    <div style="background-color: #375a7f;">
	<div id="header">
		<div id="head-logo">
    		<a href="https://pancakes.tf/" title="Return to Pancakes.TF">
    			<img src="images/<?php echo $this->_tpl_vars['header_logo']; ?>
" border="0" alt="PancakesTF Logo" style="margin-bottom: -3px;"/>
    		</a>
		</div>
	</div>
	</div>
	<div id="tabsWrapper">
		<div id="mainwrapper">
            <div id="tabs">
	            <?php if ($this->_tpl_vars['logged_in']): ?>
	                <div style="float: right;">
	         	        <ul>
	         	        	<li>
	         	        		<a style="background-color: #B8383B;" href='index.php?p=logout'>Logout</a>
	         	        	</li>
	         	        </ul>
	         	    </div>
	         	    <div class="user">Ayyy, <a href='index.php?p=account'><?php echo $this->_tpl_vars['username']; ?>
</a> is here!</div>
	                <?php else: ?>
	                <div style="float: right;">
	                    <ul>
	                    	<li>
	          	                <a style="background-color: #3498DB;" href='https://pancakes.tf/'>Return to Pancakes.TF</a>
	          	            </li>
	          	        </ul>
	          	    </div>
	            <?php endif; ?>
                <ul>