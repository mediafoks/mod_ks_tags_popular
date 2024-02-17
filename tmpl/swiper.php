<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_ks_tags_popular
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Tags\Site\Helper\RouteHelper;
use Joomla\CMS\Layout\LayoutHelper;
?>
<div class="mod-tagspopular swiper swiper-slider">
    <?php if (!count($list)) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
            <?php echo Text::_('MOD_KS_TAGS_POPULAR_NO_ITEMS_FOUND'); ?>
        </div>
    <?php else : ?>
        <ul class="tagspopular swiper-wrapper">
            <?php foreach ($list as $item) : ?>
                <li class="tagspopular__item swiper-slide">
                    <?php $images = json_decode($item->images); ?>
                    <?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
                        <a class="tagview" href="<?php echo Route::_(RouteHelper::getComponentTagRoute($item->tag_id . ':' . $item->alias, $item->language)); ?>">
                            <?php echo LayoutHelper::render('joomla.html.image', [
                                'src' => $images->image_intro,
                                'alt' => $item->title,
                                'class' => 'tagview__img',
                            ]); ?>
                            <?php if ($display_count) : ?>
                                <div class="hits">
                                    <span class="hits-value"><?= $item->count; ?></span>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo Route::_(RouteHelper::getComponentTagRoute($item->tag_id . ':' . $item->alias, $item->language)); ?>">
                            <?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
                        <?php if ($display_count) : ?>
                            <span class="tag-count badge bg-info"><?php echo $item->count; ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>