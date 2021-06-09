<?php /* Smarty version 2.6.31, created on 2020-09-02 23:09:44
         compiled from page_servers.tpl */ ?>
<div>
<?php if ($this->_tpl_vars['IN_SERVERS_PAGE'] && $this->_tpl_vars['access_bans']): ?><div style="text-align:right; width:100%;"><small>Hint: Rightclick on a player to open a context menu with options to kick, ban or contact the player directly.</small></div><?php endif; ?>
			<table cellspacing="0" cellpadding="0" align="center" class="sortable listtable">
			<thead>
			  <tr>
				<td width="2%" height="16" class="listtable_top">MOD</td>
				<td width="2%" height="16" class="listtable_top">OS</td>
				<td width="2%" height="16" class="listtable_top">VAC</td>
				<td height="16" class="listtable_top" align="center"><b>Hostname</b></td>
				<td width="10%" height="16" class="listtable_top"><b>Players</b></td>
				<td width="25%" height="16" class="listtable_top"><b>Map</b></td>
			  </tr>
			 </thead>
			 <tbody>
			<?php $_from = $this->_tpl_vars['server_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['server']):
?>
				  <tr id="opener_<?php echo $this->_tpl_vars['server']['sid']; ?>
" class="opener tbl_out" style="cursor:pointer;" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'"<?php if (! $this->_tpl_vars['IN_SERVERS_PAGE']): ?> onclick="<?php echo $this->_tpl_vars['server']['evOnClick']; ?>
"<?php endif; ?>>
		            <td height="16" align="center" class="listtable_1"><img height="16px" width="16px" src="images/games/<?php echo $this->_tpl_vars['server']['icon']; ?>
" border="0" /></td>
		            <td height="16" align="center" class="listtable_1" id="os_<?php echo $this->_tpl_vars['server']['sid']; ?>
"></td>
		            <td height="16" align="center" class="listtable_1" id="vac_<?php echo $this->_tpl_vars['server']['sid']; ?>
"></td>
		            <td height="16" class="listtable_1" id="host_<?php echo $this->_tpl_vars['server']['sid']; ?>
"><i>Querying Server Data...</i></td>
		            <td height="16" class="listtable_1" id="players_<?php echo $this->_tpl_vars['server']['sid']; ?>
">N/A</td>
		            <td height="16" class="listtable_1" id="map_<?php echo $this->_tpl_vars['server']['sid']; ?>
">N/A</td>
		          </tr>
				  <tr>
		          	<td colspan="7" align="center">

		       			<?php if ($this->_tpl_vars['IN_SERVERS_PAGE']): ?>
			       			<div class="opener">
								<div id="serverwindow_<?php echo $this->_tpl_vars['server']['sid']; ?>
">
				       				<div id="sinfo_<?php echo $this->_tpl_vars['server']['sid']; ?>
">
				       				 <table width="100%" border="0" class="listtable">
										  <tr>
										    <td class="listtable_1" valign="top">
											    <table width="100%" border="0" class="listtable" id="playerlist_<?php echo $this->_tpl_vars['server']['sid']; ?>
" name="playerlist_<?php echo $this->_tpl_vars['server']['sid']; ?>
">
											    </table>
										    </td>
										    <td width="355px" class="listtable_2 opener" valign="top" style="padding-right: 0px; padding-left: 13px; padding-top: 12px;">
										    	<img id="mapimg_<?php echo $this->_tpl_vars['server']['sid']; ?>
" style="border-radius: 6px; padding-left: 1px;" width='340' src='images/maps/nomap.jpg'>
										    	<br />
										    	<br />
										    	<div align='center'>
										    		<p style="font-size: 13px;"><?php echo $this->_tpl_vars['server']['ip']; ?>
:<?php echo $this->_tpl_vars['server']['port']; ?>
</p>
										    		<input type='submit' onclick="document.location = 'steam://connect/<?php echo $this->_tpl_vars['server']['ip']; ?>
:<?php echo $this->_tpl_vars['server']['port']; ?>
'" name='button' class='btn game' style='margin:0px;' id='button' value='Join game' />
													<input type='button' onclick="ShowBox('Reloading..','<b>Refreshing the Serverdata...</b><br><i>Please Wait!</i>', 'blue', '', false);document.getElementById('dialog-control').setStyle('display', 'none');xajax_RefreshServer(<?php echo $this->_tpl_vars['server']['sid']; ?>
);" name='button' class='btn refresh' style='margin:0;' id='button' value='Refresh' />
										    	</div>
										    	<br />
										    </td>
										</tr>
									</table>
								  </div>
								  <div id="noplayer_<?php echo $this->_tpl_vars['server']['sid']; ?>
" name="noplayer_<?php echo $this->_tpl_vars['server']['sid']; ?>
" style="display:none;"><br />
									<h2 style="color: #333;">No players in the server</h2><br />
									<div align='center'>
										<p style="font-size: 13px;"><?php echo $this->_tpl_vars['server']['ip']; ?>
:<?php echo $this->_tpl_vars['server']['port']; ?>
</p>
										<input type='submit' onclick="document.location = 'steam://connect/<?php echo $this->_tpl_vars['server']['ip']; ?>
:<?php echo $this->_tpl_vars['server']['port']; ?>
'" name='button' class='btn game' style='margin:0;' id='button' value='Join game' />
										<input type='button' onclick="ShowBox('Reloading..','<b>Refreshing the Serverdata...</b><br><i>Please Wait!</i>', 'blue', '', false);document.getElementById('dialog-control').setStyle('display', 'none');xajax_RefreshServer(<?php echo $this->_tpl_vars['server']['sid']; ?>
);" name='button' class='btn refresh' style='margin:0;' id='button' value='Refresh' /><br /><br />
									</div>
								  </div>
							  </div>
							</div>
						<?php endif; ?>

						</td>
					</tr>
				<?php endforeach; endif; unset($_from); ?>
				</tbody>
				</table>
	</div>


<?php if ($this->_tpl_vars['IN_SERVERS_PAGE']): ?>
	<script type="text/javascript">
		InitAccordion('tr.opener', 'div.opener', 'mainwrapper');
	</script>
<?php endif; ?>