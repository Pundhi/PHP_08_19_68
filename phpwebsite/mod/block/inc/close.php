<?php

/**
 * @author Matthew McNaney <mcnaney at gmail dot com>
 * @version $Id: close.php 7311 2010-03-10 13:21:15Z matt $
 */

Block::show();

if (Current_User::allow('block')) {
    $key = Key::getCurrent();
    if (Key::checkKey($key) && javascriptEnabled()) {
        $val['address'] = sprintf('index.php?module=block&action=js_block_edit&key_id=%s&authkey=%s',
        $key->id, Current_User::getAuthkey());
        $val['label'] = dgettext('block', 'Add block here');
        $val['width'] = 640;
        $val['height'] = 480;
        MiniAdmin::add('block', javascript('open_window', $val));
    }
}

?>