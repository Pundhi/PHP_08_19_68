<?php

/**
 * @version $Id: unregister.php 7311 2010-03-10 13:21:15Z matt $
 * @author Matthew McNaney <mcnaney at gmail dot com>
 */

function categories_unregister($module, &$content){
    PHPWS_Core::initModClass("categories", "Categories.php");

    Categories::removeModule($module);
}

?>