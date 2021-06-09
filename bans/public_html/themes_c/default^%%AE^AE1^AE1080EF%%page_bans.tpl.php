<?php /* Smarty version 2.6.31, created on 2020-09-02 23:08:19
         compiled from page_bans.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'help_icon', 'page_bans.tpl', 5, false),array('function', 'sb_button', 'page_bans.tpl', 23, false),array('modifier', 'htmlspecialchars', 'page_bans.tpl', 57, false),array('modifier', 'escape', 'page_bans.tpl', 88, false),array('modifier', 'stripslashes', 'page_bans.tpl', 88, false),array('modifier', 'count', 'page_bans.tpl', 96, false),)), $this); ?>
<?php if ($this->_tpl_vars['comment']): ?>
<h3><?php echo $this->_tpl_vars['commenttype']; ?>
 Comment</h3>
<table width="90%" align="center" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
  <tr>
	<td valign="top"><div class="rowdesc"><?php echo smarty_function_help_icon(array('title' => 'Comment Text','message' => "Type the text you would like to say."), $this);?>
Comment</div></td>
  </tr>
  <tr>
	<td><div align="left">
		<textarea rows="10" cols="60" class="submit-fields" style="width:500px;" id="commenttext" name="commenttext"><?php echo $this->_tpl_vars['commenttext']; ?>
</textarea>
	  </div>
		<div id="commenttext.msg" class="badentry"></div></td>
  </tr>
  <tr>
	<td>
		<input type="hidden" name="bid" id="bid" value="<?php echo $this->_tpl_vars['comment']; ?>
">
		<input type="hidden" name="ctype" id="ctype" value="<?php echo $this->_tpl_vars['ctype']; ?>
">
		<?php if ($this->_tpl_vars['cid'] != ""): ?>
			<input type="hidden" name="cid" id="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
		<?php else: ?>
			<input type="hidden" name="cid" id="cid" value="-1">
		<?php endif; ?>
		<input type="hidden" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
		<?php echo smarty_function_sb_button(array('text' => ($this->_tpl_vars['commenttype'])." Comment",'onclick' => "ProcessComment();",'class' => 'ok','id' => 'acom','submit' => false), $this);?>
&nbsp;
		<?php echo smarty_function_sb_button(array('text' => 'Back','onclick' => "history.go(-1)",'class' => 'cancel','id' => 'aback'), $this);?>

	</td>
  </tr>
  <?php $_from = ($this->_tpl_vars['othercomments']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['com']):
?>
  <tr>
	<td colspan='3'>
		<hr>
	</td>
  </tr>
  <tr>
	<td>
		<b><?php echo $this->_tpl_vars['com']['comname']; ?>
</b></td><td align="right"><b><?php echo $this->_tpl_vars['com']['added']; ?>
</b>
	</td>
  </tr>
  <tr>
	<td colspan='2'>
		<?php echo $this->_tpl_vars['com']['commenttxt']; ?>

	</td>
  </tr>
  <?php if ($this->_tpl_vars['com']['editname'] != ''): ?>
  <tr>
	<td colspan='3'>
		<span style='font-size:6pt;color:grey;'>last edit <?php echo $this->_tpl_vars['com']['edittime']; ?>
 by <?php echo $this->_tpl_vars['com']['editname']; ?>
</span>
	</td>
  </tr>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<h3 align="left">Banlist Overview - <i>Total Bans: <?php echo $this->_tpl_vars['total_bans']; ?>
</i></h3>
<br />
<?php  require (TEMPLATES_PATH . "/admin.bans.search.php"); ?>
<br />
<div id="banlist-nav"><a href="index.php?p=banlist&hideinactive=<?php if ($this->_tpl_vars['hidetext'] == 'Hide'): ?>true<?php else: ?>false<?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['searchlink'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" title="<?php echo $this->_tpl_vars['hidetext']; ?>
 inactive"><?php echo $this->_tpl_vars['hidetext']; ?>
 inactive</a> | <i>Total Bans: <?php echo $this->_tpl_vars['total_bans']; ?>
</i></div>
<div id="banlist">
	<table width="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
		<tr>
			<?php if ($this->_tpl_vars['view_bans']): ?>
			<td height="16" class="listtable_1" style="padding:0px;width:3px;" align="center"><div class="ok" style="height:16px;width:16px;cursor:pointer;" title="Select All" name="tickswitch" id="tickswitch" onclick="TickSelectAll()"></div></td>
			<?php endif; ?>
			<td width="5%" height="16" class="listtable_top" align="center"><b></b></td>
			<td width="20%" height="16" class="listtable_top" align="center"><b>Date</b></td>
			<td height="16" class="listtable_top"><b>Player</b></td>
			<?php if (! $this->_tpl_vars['hideadminname']): ?>
			<td width="20%" height="16" class="listtable_top"><b>Banned By</b></td>
			<?php endif; ?>
			<td width="35%" height="16" class="listtable_top" align="center"><b>Length</b></td>
		</tr>
		<?php $_from = $this->_tpl_vars['ban_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['banlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['banlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ban']):
        $this->_foreach['banlist']['iteration']++;
?>
			<tr class="opener tbl_out" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'"
			<?php if ($this->_tpl_vars['ban']['server_id'] != 0): ?>
				onclick="xajax_ServerHostPlayers(<?php echo $this->_tpl_vars['ban']['server_id']; ?>
, 'id', 'host_<?php echo $this->_tpl_vars['ban']['ban_id']; ?>
');"
			<?php endif; ?>
			>
		<?php if ($this->_tpl_vars['view_bans']): ?>
		<td height="16" align="center" class="listtable_1" style="padding:0px;width:3px;"><input type="checkbox" name="chkb_<?php echo ($this->_foreach['banlist']['iteration']-1); ?>
" id="chkb_<?php echo ($this->_foreach['banlist']['iteration']-1); ?>
" value="<?php echo $this->_tpl_vars['ban']['ban_id']; ?>
"></td>
        <?php endif; ?>
		<td height="16" align="center" class="listtable_1"><?php echo $this->_tpl_vars['ban']['mod_icon']; ?>
</td>
        <td height="16" align="center" class="listtable_1"><?php echo $this->_tpl_vars['ban']['ban_date']; ?>
</td>
        <td height="16" class="listtable_1">
		  <div style="float:left;">
          <?php if (empty ( $this->_tpl_vars['ban']['player'] )): ?>
            <i><font color="#677882">no nickname present</font></i>
          <?php else: ?>
            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ban']['player'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

          <?php endif; ?>
		  </div>
		  <?php if ($this->_tpl_vars['ban']['demo_available']): ?>
		  <div style="float:right;">
		  <img src="images/demo.png" alt="Demo" title="Demo available" style="height:14px;width:14px;" />
		  </div>
		  <?php endif; ?>
		  <?php if ($this->_tpl_vars['view_comments'] && $this->_tpl_vars['ban']['commentdata'] != 'None' && count($this->_tpl_vars['ban']['commentdata']) > 0): ?>
		  <div style="float:right;">
		  <?php echo count($this->_tpl_vars['ban']['commentdata']); ?>
 <img src="images/details.png" alt="Comments" title="Comments" style="height:12px;width:12px;" />
		  </div>
		  <?php endif; ?>
        </td>
		<?php if (! $this->_tpl_vars['hideadminname']): ?>
        <td height="16" class="listtable_1">
        <?php if (! empty ( $this->_tpl_vars['ban']['admin'] )): ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['ban']['admin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

        <?php else: ?>
            <i><font color="#677882">Admin deleted</font></i>
        <?php endif; ?>
        </td>
		<?php endif; ?>
        <td width="20%" height="16" align="center" class="<?php echo $this->_tpl_vars['ban']['class']; ?>
"><?php echo $this->_tpl_vars['ban']['banlength']; ?>
</td>
			</tr>
			<!-- ###############[ Start Sliding Panel ]################## -->
			<tr>
        <td colspan="7" align="center">
          <div class="opener">
						<table width="100%" cellspacing="0" cellpadding="0" class="listtable">
              <tr>
                <td height="16" align="left" class="listtable_top" colspan="3">
									<b>Ban Details</b>
								</td>
              </tr>
              <tr align="left">
                <td width="30%" height="16" class="listtable_1">Player</td>
                <td height="16" class="listtable_1">
                  <?php if (empty ( $this->_tpl_vars['ban']['player'] )): ?>
                    <i><font color="#677882">no nickname present</font></i>
                  <?php else: ?>
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ban']['player'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                  <?php endif; ?>
                </td>
                <!-- ###############[ Start Admin Controls ]################## -->
                <?php if ($this->_tpl_vars['view_bans']): ?>
                <td width="30%" rowspan="<?php if ($this->_tpl_vars['ban']['unbanned']): ?>15<?php else: ?>13<?php endif; ?>" class="listtable_2 opener">
                  <div class="ban-edit">
                    <ul>
					  <?php if ($this->_tpl_vars['ban']['unbanned'] && $this->_tpl_vars['ban']['reban_link'] != false): ?>
					  <li><?php echo $this->_tpl_vars['ban']['reban_link']; ?>
</li>
					  <?php endif; ?>
					  <li><?php echo $this->_tpl_vars['ban']['blockcomm_link']; ?>
</li>
                      <li><?php echo $this->_tpl_vars['ban']['demo_link']; ?>
</li>
                      <li><?php echo $this->_tpl_vars['ban']['addcomment']; ?>
</li>
					  <?php if ($this->_tpl_vars['ban']['type'] == 0): ?>
					  <?php if ($this->_tpl_vars['groupban']): ?>
					  <li><?php echo $this->_tpl_vars['ban']['groups_link']; ?>
</li>
					  <?php endif; ?>
					  <?php if ($this->_tpl_vars['friendsban']): ?>
					  <li><?php echo $this->_tpl_vars['ban']['friend_ban_link']; ?>
</li>
					  <?php endif; ?>
					  <?php endif; ?>
                      <?php if (( $this->_tpl_vars['ban']['view_edit'] && ! $this->_tpl_vars['ban']['unbanned'] )): ?>
                      <li><?php echo $this->_tpl_vars['ban']['edit_link']; ?>
</li>
                      <?php endif; ?>
                      <?php if (( $this->_tpl_vars['ban']['unbanned'] == false && $this->_tpl_vars['ban']['view_unban'] )): ?>
                      <li><?php echo $this->_tpl_vars['ban']['unban_link']; ?>
</li>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['ban']['view_delete']): ?>
                      <li><?php echo $this->_tpl_vars['ban']['delete_link']; ?>
</li>
                      <?php endif; ?>
                    </ul>
                  </div>
                </td>
                <?php else: ?>
                <td width="30%" rowspan="<?php if ($this->_tpl_vars['ban']['unbanned']): ?>13<?php else: ?>11<?php endif; ?>" class="listtable_2 opener">
                  <div class="ban-edit">
                    <ul>
                      <li><?php echo $this->_tpl_vars['ban']['demo_link']; ?>
</li>
                    </ul>
                  </div>
                </td>
                <?php endif; ?>
                <!-- ###############[ End Admin Controls ]##################### -->
              </tr>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Steam ID</td>
                <td height="16" class="listtable_1">
                  <?php if (empty ( $this->_tpl_vars['ban']['steamid'] )): ?>
                    <i><font color="#677882">No Steam ID present</font></i>
                  <?php else: ?>
                    <?php echo $this->_tpl_vars['ban']['steamid']; ?>

                  <?php endif; ?>
                </td>
              </tr>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Steam3 ID</td>
                <td height="16" class="listtable_1">
                  <?php if (empty ( $this->_tpl_vars['ban']['steamid'] )): ?>
                    <i><font color="#677882">No Steam3 ID present</font></i>
                  <?php else: ?>
                    <a href="http://steamcommunity.com/profiles/<?php echo $this->_tpl_vars['ban']['steamid3']; ?>
" target="_blank"><?php echo $this->_tpl_vars['ban']['steamid3']; ?>
</a>
                  <?php endif; ?>
                </td>
              </tr>
              <?php if ($this->_tpl_vars['ban']['type'] == 0): ?>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Steam Community</td>
                <td height="16" class="listtable_1"><a href="http://steamcommunity.com/profiles/<?php echo $this->_tpl_vars['ban']['communityid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['ban']['communityid']; ?>
</a></td>
              </tr>
              <?php endif; ?>
              <?php if (! $this->_tpl_vars['hideplayerips']): ?>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">IP address</td>
                <td height="16" class="listtable_1">
                  <?php if ($this->_tpl_vars['ban']['ip'] == 'none'): ?>
                    <i><font color="#677882">no IP address present</font></i>
                  <?php else: ?>
                    <?php echo $this->_tpl_vars['ban']['ip']; ?>

                  <?php endif; ?>
                </td>
              </tr>
              <?php endif; ?>
              <tr align="left">
								<td width="20%" height="16" class="listtable_1">Invoked on</td>
								<td height="16" class="listtable_1"><?php echo $this->_tpl_vars['ban']['ban_date']; ?>
</td>
					        </tr>
					        <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Banlength</td>
					            <td height="16" class="listtable_1"><?php echo $this->_tpl_vars['ban']['banlength']; ?>
</td>
					        </tr>
							<?php if ($this->_tpl_vars['ban']['unbanned']): ?>
							<tr align="left">
					            <td width="20%" height="16" class="listtable_1">Unban reason</td>
					            <td height="16" class="listtable_1">
								<?php if ($this->_tpl_vars['ban']['ureason'] == ""): ?>
									<i><font color="#677882">no reason present</font></i>
								<?php else: ?>
									<?php echo $this->_tpl_vars['ban']['ureason']; ?>

								<?php endif; ?>
								</td>
					        </tr>
							 <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Unbanned by Admin</td>
					            <td height="16" class="listtable_1">
                                    <?php if (! empty ( $this->_tpl_vars['ban']['removedby'] )): ?>
										<?php echo ((is_array($_tmp=$this->_tpl_vars['ban']['removedby'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

									<?php else: ?>
										<i><font color="#677882">Admin deleted.</font></i>
									<?php endif; ?>
                                </td>
					        </tr>
							<?php endif; ?>
					        <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Expires on</td>
					            <td height="16" class="listtable_1">
					            	<?php if ($this->_tpl_vars['ban']['expires'] == 'never'): ?>
		     							<i><font color="#677882">Not applicable.</font></i>
		     						<?php else: ?>
		     							<?php echo $this->_tpl_vars['ban']['expires']; ?>

		     						<?php endif; ?>
		     					</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Reason</td>
								<td height="16" class="listtable_1"><?php echo ((is_array($_tmp=$this->_tpl_vars['ban']['reason'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
							</tr>
							<?php if (! $this->_tpl_vars['hideadminname']): ?>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Banned by Admin</td>
								<td height="16" class="listtable_1">
									<?php if (! empty ( $this->_tpl_vars['ban']['admin'] )): ?>
										<?php echo ((is_array($_tmp=$this->_tpl_vars['ban']['admin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

									<?php else: ?>
										<i><font color="#677882">Admin deleted.</font></i>
									<?php endif; ?>
								</td>
							</tr>
							<?php endif; ?>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Banned from</td>
								<td height="16" class="listtable_1" <?php if ($this->_tpl_vars['ban']['server_id'] != 0): ?> id="host_<?php echo $this->_tpl_vars['ban']['ban_id']; ?>
"<?php endif; ?>>
									<?php if ($this->_tpl_vars['ban']['server_id'] == 0): ?>
										Web Ban
									<?php else: ?>
										Please Wait...
                                    <?php endif; ?>
								</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Total Bans</td>
								<td height="16" class="listtable_1"><?php echo $this->_tpl_vars['ban']['prevoff_link']; ?>
</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Blocked (<?php echo $this->_tpl_vars['ban']['blockcount']; ?>
)</td>
								<td height="16" class="listtable_1">
								<?php if ($this->_tpl_vars['ban']['banlog'] == ""): ?>
									<i><font color="#677882">never</font></i>
								<?php else: ?>
									<?php echo $this->_tpl_vars['ban']['banlog']; ?>

								<?php endif; ?>
								</td>
							</tr>
							<?php if ($this->_tpl_vars['view_comments']): ?>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Comments</td>
								<td height="60" class="listtable_1" colspan="2">
								<?php if ($this->_tpl_vars['ban']['commentdata'] != 'None'): ?>
								<table width="100%" border="0">
									<?php $_from = $this->_tpl_vars['ban']['commentdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['commenta']):
?>
									 <?php if ($this->_tpl_vars['commenta']['morecom']): ?>
									  <tr>
										<td colspan='3'>
											<hr>
										</td>
									  </tr>
									 <?php endif; ?>
									  <tr>
										<td>
											<?php if (! empty ( $this->_tpl_vars['commenta']['comname'] )): ?>
                                                <b><?php echo ((is_array($_tmp=$this->_tpl_vars['commenta']['comname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</b>
                                            <?php else: ?>
                                                <i><font color="#677882">Admin deleted</font></i>
                                            <?php endif; ?>
										</td>
										<td align="right">
											<b><?php echo $this->_tpl_vars['commenta']['added']; ?>
</b>
										</td>
										<?php if ($this->_tpl_vars['commenta']['editcomlink'] != ""): ?>
										<td align="right">
											<?php echo $this->_tpl_vars['commenta']['editcomlink']; ?>
 <?php echo $this->_tpl_vars['commenta']['delcomlink']; ?>

										</td>
										<?php endif; ?>
									  </tr>
									  <tr>
										<td colspan='3'>
											<?php echo $this->_tpl_vars['commenta']['commenttxt']; ?>

										</td>
									  </tr>
									  <?php if (! empty ( $this->_tpl_vars['commenta']['edittime'] )): ?>
									  <tr>
										<td colspan='3'>
											<span style="font-size:6pt;color:grey;">last edit <?php echo $this->_tpl_vars['commenta']['edittime']; ?>
 by <?php if (! empty ( $this->_tpl_vars['commenta']['editname'] )): ?><?php echo $this->_tpl_vars['commenta']['editname']; ?>
<?php else: ?><i><font color="#677882">Admin deleted</font></i><?php endif; ?></span>
										</td>
									  </tr>
									  <?php endif; ?>
									  <?php endforeach; endif; unset($_from); ?>
								</table>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['ban']['commentdata'] == 'None'): ?>
									<?php echo $this->_tpl_vars['ban']['commentdata']; ?>

								<?php endif; ?>
								</td>
							</tr>
							<?php endif; ?>
						</table>
					</div>
          		</td>
          	</tr>
          	<!-- ###############[ End Sliding Panel ]################## -->
		<?php endforeach; endif; unset($_from); ?>
	</table>
	<div id="banlist-nav">
        <?php echo $this->_tpl_vars['ban_nav']; ?>

    </div>
	<?php if ($this->_tpl_vars['general_unban'] || $this->_tpl_vars['can_delete']): ?>
	&nbsp;&nbsp;L&nbsp;&nbsp;<a href="#" onclick="TickSelectAll();return false;" title="Select All" name="tickswitchlink" id="tickswitchlink">Select All</a>&nbsp;&nbsp;|&nbsp;
	<select name="bulk_action" id="bulk_action" onchange="BulkEdit(this,'<?php echo $this->_tpl_vars['admin_postkey']; ?>
');">
		<option value="-1">Action</option>
		<?php if ($this->_tpl_vars['general_unban']): ?>
		<option value="U">Unban</option>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['can_delete']): ?>
		<option value="D">Delete</option>
		<?php endif; ?>
	</select>
	<hr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['can_export']): ?>
		<a href="./exportbans.php?type=steam" title="Export Permanent SteamID Bans">Export Permanent SteamID Bans</a>&nbsp;&nbsp;|&nbsp;
		<a href="./exportbans.php?type=ip" title="Export Permanent IP Bans">Export Permanent IP Bans</a>
	<?php endif; ?>
</div>
<?php echo '
<script type="text/javascript">window.addEvent(\'domready\', function(){
InitAccordion(\'tr.opener\', \'div.opener\', \'mainwrapper\');
'; ?>

<?php if ($this->_tpl_vars['view_bans']): ?>
$('tickswitch').value=0;
<?php endif; ?>
<?php echo '
});
</script>
'; ?>

<?php endif; ?>