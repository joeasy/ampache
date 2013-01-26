<?php
/* vim:set tabstop=8 softtabstop=8 shiftwidth=8 noexpandtab: */
/**
 *
 * LICENSE: GNU General Public License, version 2 (GPLv2)
 * Copyright 2001 - 2013 Ampache.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 */
?>
<?php UI::show_box_top(T_('Editing existing User')); ?>
<?php Error::display('general'); ?>
<form name="update_user" enctype="multipart/form-data" method="post" action="<?php echo Config::get('web_path') . "/admin/users.php"; ?>">
<table class="tabledata" cellspacing="0" cellpadding="0">
<tr>
	<th colspan="2"><?php echo T_('User Properties'); ?></th>
</tr>
<tr>
	<td>
		<?php echo T_('Username'); ?>:
	</td>
	<td>
		<input type="text" name="username" size="30" maxlength="128" value="<?php echo scrub_out($client->username); ?>" />
		<?php Error::display('username'); ?>
	</td>
</tr>
<tr>
	<td><?php echo T_('Full Name'); ?>:</td>
	<td>
		<input type="text" name="fullname" size="30" value="<?php echo scrub_out($client->fullname); ?>" />
	</td>
</tr>
<tr>
	<td>
		<?php echo T_('E-mail'); ?>:
	</td>
	<td>
		<input type="text" name="email" size="30" value="<?php echo scrub_out($client->email); ?>" />
	</td>
</tr>
<tr>
	<td>
		<?php echo T_('Password'); ?> :
	</td>
	<td>
		<input type="password" name="password_1" size="30" value="" />
		<?php Error::display('password'); ?>
	</td>
</tr>
<tr>
	<td>
		<?php echo T_('Confirm Password'); ?>:
	</td>
	<td>
		<input type="password" name="password_2" size="30" value="" />
	</td>
</tr>
<tr>
	<td>
		<?php echo  T_('User Access Level'); ?>:
	</td>
	<td>
                <?php $var_name = "on_" . $client->access; ${$var_name} = 'selected="selected"'; ?>
                <select name="access">
                <option value="5" <?php echo $on_5; ?>><?php echo T_('Guest'); ?></option>
                <option value="25" <?php echo $on_25; ?>><?php echo T_('User'); ?></option>
                <option value="50" <?php echo $on_50; ?>><?php echo T_('Content Manager'); ?></option>
                <option value="75" <?php echo $on_75; ?>><?php echo T_('Catalog Manager'); ?></option>
                <option value="100" <?php echo $on_100; ?>><?php echo T_('Admin'); ?></option>
                </select>
	</td>
</tr>
<tr>
	<th colspan="2"><?php echo T_('Other Options'); ?></th>
</tr>
<tr>
	<td><?php echo T_('Config Preset'); ?></td>
	<td>
		<select name="preset">
			<option value=""></option>
			<option value="democratic"><?php echo T_('Democratic'); ?></option>
			<option value="localplay"><?php echo T_('Localplay'); ?></option>
			<option value="flash"><?php echo T_('Flash'); ?></option>
			<option value="stream"><?php echo T_('Stream'); ?></option>
		</select>
	</td>
</tr>
<tr>
	<td><?php echo T_('Prevent Preset Override'); ?></td>
	<td>
		<input type="checkbox" value="1" name="prevent_override" /><span class="information"> <?php echo T_('This Affects all non-Admin accounts'); ?></span>
	</td>
</tr>
<tr>
	<td><?php echo T_('Clear Stats'); ?></td>
	<td>
		<input type="checkbox" value="1" name="reset_stats" />
	</td>
</tr>
</table>
<div class="formValidation">
		<input type="hidden" name="action" value="update_user" />
		<input type="submit" value="<?php echo T_('Update User'); ?>" />
		<?php echo Core::form_register('edit_user'); ?>
		<input type="hidden" name="user_id" value="<?php echo $client->id; ?>" />
</div>
</form>
<?php UI::show_box_bottom(); ?>
