<?php
/* vim:set softtabstop=4 shiftwidth=4 expandtab: */
/**
 *
 * LICENSE: GNU General Public License, version 2 (GPLv2)
 * Copyright 2001 - 2014 Ampache.org
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
<?php UI::show_box_top($video->f_title . ' ' . T_('Details'), 'box box_video_details'); ?>
<div class="item_right_info">
<?php
Art::display('video', $video->id, $video->f_title, 7);
?>
</div>
<dl class="media_details">
<?php if (AmpConfig::get('ratings')) { ?>
    <?php $rowparity = UI::flip_class(); ?>
    <dt class="<?php echo $rowparity; ?>"><?php echo T_('Rating'); ?></dt>
    <dd class="<?php echo $rowparity; ?>">
        <div id="rating_<?php echo $video->id; ?>_video"><?php Rating::show($video->id,'video'); ?>
        </div>
    </dd>
<?php } ?>

<?php if (AmpConfig::get('userflags')) { ?>
    <?php $rowparity = UI::flip_class(); ?>
    <dt class="<?php echo $rowparity; ?>"><?php echo T_('Fav.'); ?></dt>
    <dd class="<?php echo $rowparity; ?>">
        <div id="userflag_<?php echo $video->id; ?>_video"><?php Userflag::show($video->id,'video'); ?>
        </div>
    </dd>
<?php } ?>
<?php $rowparity = UI::flip_class(); ?>
<dt class="<?php echo $rowparity; ?>"><?php echo T_('Action'); ?></dt>
    <dd class="<?php echo $rowparity; ?>">
        <?php if (AmpConfig::get('directplay')) { ?>
            <?php echo Ajax::button('?page=stream&action=directplay&playtype=video&video_id=' . $video->id, 'play', T_('Play'),'play_video_' . $video->id); ?>
            <?php if (Stream_Playlist::check_autoplay_append()) { ?>
                <?php echo Ajax::button('?page=stream&action=directplay&playtype=video&video_id=' . $video->id . '&append=true','play_add', T_('Play last'),'addplay_video_' . $video->id); ?>
            <?php } ?>
        <?php } ?>
        <?php echo Ajax::button('?action=basket&type=video&id=' . $video->id,'add', T_('Add to temporary playlist'),'add_video_' . $video->id); ?>
        <?php if (AmpConfig::get('sociable')) { ?>
            <a href="<?php echo AmpConfig::get('web_path'); ?>/shout.php?action=show_add_shout&type=video&id=<?php echo $video->id; ?>">
            <?php echo UI::get_icon('comment', T_('Post Shout')); ?>
            </a>
        <?php } ?>
        <?php if (AmpConfig::get('share')) { ?>
            <a href="<?php echo AmpConfig::get('web_path'); ?>/share.php?action=show_create&type=video&id=<?php echo $video->id; ?>"><?php echo UI::get_icon('share', T_('Share')); ?></a>
        <?php } ?>
        <?php if (Access::check_function('download')) { ?>
            <a href="<?php echo Video::play_url($video->id); ?>"><?php echo UI::get_icon('link', T_('Link')); ?></a>
            <a href="<?php echo AmpConfig::get('web_path'); ?>/stream.php?action=download&video_id=<?php echo $video->id; ?>"><?php echo UI::get_icon('download', T_('Download')); ?></a>
        <?php } ?>
        <?php if (Access::check('interface','50')) { ?>
            <a onclick="showEditDialog('video_row', '<?php echo $video->id ?>', '<?php echo 'edit_video_'.$video->id ?>', '<?php echo T_('Edit') ?>', '')">
                <?php echo UI::get_icon('edit', T_('Edit')); ?>
            </a>
        <?php } ?>
    </dd>
<?php
  $videoprops[gettext_noop('Title')]   = scrub_out($video->f_title);
  $videoprops[gettext_noop('Length')]  = scrub_out($video->f_time);
if (!strtolower(get_class($video)) != 'video') {
    require AmpConfig::get('prefix') . '/templates/show_partial_' . strtolower(get_class($video)) . '.inc.php';
}
  $videoprops[gettext_noop('Release Date')]   = scrub_out($video->f_release_date);
  $videoprops[gettext_noop('Codec')]   = scrub_out($video->f_codec);
  $videoprops[gettext_noop('Resolution')]   = scrub_out($video->f_resolution);
  if (Access::check('interface','75')) {
    $videoprops[gettext_noop('Filename')]   = scrub_out($video->file) . " " . $video->f_size;
  }
  if ($video->update_time) {
    $videoprops[gettext_noop('Last Updated')]   = date("d/m/Y H:i",$video->update_time);
  }
  $videoprops[gettext_noop('Added')]   = date("d/m/Y H:i",$video->addition_time);
  if (AmpConfig::get('show_played_times')) {
    $videoprops[gettext_noop('# Played')]   = scrub_out($video->object_cnt);
  }

    foreach ($videoprops as $key => $value) {
        if (trim($value)) {
              $rowparity = UI::flip_class();
              echo "<dt class=\"".$rowparity."\">" . T_($key) . "</dt><dd class=\"".$rowparity."\">" . $value . "</dd>";
        }
      }
?>
</dl>
<?php UI::show_box_bottom(); ?>
