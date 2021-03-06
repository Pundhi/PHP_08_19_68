<?php
/**
 * rolodex - phpwebsite module
 *
 * See docs/AUTHORS and docs/COPYRIGHT for relevant info.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @version $Id: RDX_Feature.php 7597 2010-04-27 14:11:55Z verdon $
 * @author Verdon Vaillancourt <verdonv at gmail dot com>
 */

class Rolodex_Feature {

    public $id             = 0;
    public $title          = null;
    public $description    = null;
    public $image_id       = 0;
    public $_error         = null;


    public function __construct($id=0)
    {
        if (!$id) {
            return;
        }

        $this->id = (int)$id;
        $this->init();
    }


    public function init()
    {
        $db = new PHPWS_DB('rolodex_feature');
        $result = $db->loadObject($this);
        if (PHPWS_Error::isError($result)) {
            $this->_error = & $result;
            $this->id = 0;
        } elseif (!$result) {
            $this->id = 0;
        }
    }


    public function setTitle($title)
    {
        $this->title = strip_tags($title);
    }


    public function setDescription($description)
    {
        $this->description = PHPWS_Text::parseInput($description);
    }


    public function setImage_id($image_id)
    {
        $this->image_id = $image_id;
    }



    public function getTitle($print=false)
    {
        if (empty($this->title)) {
            return null;
        }

        if ($print) {
            return PHPWS_Text::parseOutput($this->title);
        } else {
            return $this->title;
        }
    }


    public function getDescription($print=false)
    {
        if (empty($this->description)) {
            return null;
        }

        if ($print) {
            return PHPWS_Text::parseOutput($this->description);
        } else {
            return $this->description;
        }
    }


    public function getListDescription($length=60)
    {
        if (empty($this->description)) {
            return '';
        }
        return substr(ltrim(strip_tags(str_replace('<br />', ' ', $this->getDescription(true)))), 0, $length) . ' ...';
    }


    public function getQtyMembers()
    {
        $db = new PHPWS_DB('rolodex_feature_items');
        $db->addWhere('feature_id', $this->id);
        $num = $db->count();
        return $num;
    }


    public function getFile()
    {
        if (!$this->image_id) {
            return null;
        }
        return Cabinet::getTag($this->image_id);
    }


    public function delete()
    {
        if (!$this->id) {
            return;
        }

        $db = new PHPWS_DB('rolodex_feature');
        $db->addWhere('id', $this->id);
        PHPWS_Error::logIfError($db->delete());
        $db = new PHPWS_DB('rolodex_feature_items');
        $db->addWhere('feature_id', $this->id);
        PHPWS_Error::logIfError($db->delete());

    }


    public function rowTag()
    {
        $vars['feature'] = $this->id;

        if (Current_User::allow('rolodex', 'settings', null, null, true)){
            $vars['aop']  = 'edit_feature';
            $label = Icon::show('edit');
            $links[] = PHPWS_Text::secureLink($label, 'rolodex', $vars);

            $vars['aop'] = 'delete_feature';
            $js['ADDRESS'] = PHPWS_Text::linkAddress('rolodex', $vars, true);
            $js['QUESTION'] = sprintf(dgettext('rolodex', 'Are you sure you want to delete the feature %s?'), $this->getTitle());
            $js['LINK'] = Icon::show('delete');
            $links[] = javascript('confirm', $js);
        }

        $tpl['TITLE'] = $this->viewLink() . ' ('.$this->getQtyMembers().')';
        $tpl['DESCRIPTION'] = $this->getListDescription(120);
        if($links)
            $tpl['ACTION'] = implode(' ', $links);
        return $tpl;
    }


    public function featureLinks()
    {
        $links = array();
        if (Current_User::allow('rolodex', 'settings', null, null, true)) {
            $vars['feature'] = $this->id;
            $vars['aop']  = 'edit_feature';
            $links[] = PHPWS_Text::secureLink(dgettext('rolodex', 'Edit feature'), 'rolodex', $vars);
        }

        $links = array_merge($links, Rolodex::navLinks());

        if($links)
            return implode(' | ', $links);
    }


    public function save()
    {
        $db = new PHPWS_DB('rolodex_feature');
        $result = $db->saveObject($this);
        if (PHPWS_Error::isError($result)) {
            return $result;
        }

    }


    public function viewLink()
    {
//        return PHPWS_Text::rewriteLink($this->title, 'rolodex', $this->id);
        $vars['uop']  = 'view_feature';
        $vars['feature'] = $this->id;
        return PHPWS_Text::moduleLink(dgettext('rolodex', $this->title), 'rolodex', $vars);
    }


}

?>