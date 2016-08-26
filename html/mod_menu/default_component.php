<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$linkClass = 'nav-link';

$attributes = array();

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}

$attributes['class'] = $linkClass;
if (in_array($item->id, $path))
{
	$attributes['class'] .= ' active';
}
if ($item->anchor_css)
{
	$attributes['class'] .= ' ' . $item->anchor_css;
}
if ($item->deeper)
{
	$attributes['class'] .= ' dropdown-toggle';
	$attributes['id'] = 'dropdownMenu'.$item->id;
	$attributes['data-toggle'] = 'dropdown';
	$attributes['aria-haspopup'] = 'true';
	$attributes['aria-expanded'] = 'false';
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

$linktype = $item->title;

if ($item->menu_image)
{
	$linktype = JHtml::_('image', $item->menu_image, $item->title);

	if ($item->params->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink)), $linktype, $attributes);
