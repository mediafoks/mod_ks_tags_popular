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
use Joomla\CMS\Factory;

// Подключаем Swiper
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();
$wa->useScript('swiper-element')
    ->useScript('swiper-element-media-detect')
    ->useScript('swiper-init');
// END Подключаем Swiper
?>
<div class="mod-tagspopular">
    <?php if (!count($list)) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
            <?php echo Text::_('MOD_KS_TAGS_POPULAR_NO_ITEMS_FOUND'); ?>
        </div>
    <?php else : ?>
        <swiper-container class="tagspopular swiper-mobile-auto" init="false">
            <?php foreach ($list as $item) : ?>
                <swiper-slide class="tagspopular__item">
                    <?php $images = json_decode($item->images); ?>
                    <?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
                        <a class="tagview" href="<?php echo Route::_(RouteHelper::getComponentTagRoute($item->tag_id . ':' . $item->alias, $item->language)); ?>">
                            <?php echo LayoutHelper::render('joomla.html.image', [
                                'src' => $images->image_intro,
                                'alt' => $item->title,
                                'class' => 'tagview__img',
                            ]); ?>
                            <div class="tagview__body">
                                <span class="tagview__title"><?= $item->title; ?></span>
                                <div class="hits">
                                    <svg class="ico" width="24" height="24" fill="hsl(0 0% 20%)">
                                        <use xlink:href="/images/icons.svg#article"></use>
                                    </svg>
                                    <?php if ($display_count) : ?>
                                        <span class="hits-value"><?= $item->count; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo Route::_(RouteHelper::getComponentTagRoute($item->tag_id . ':' . $item->alias, $item->language)); ?>">
                            <?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
                        <?php if ($display_count) : ?>
                            <span class="tag-count badge bg-info"><?php echo $item->count; ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </swiper-slide>
            <?php endforeach; ?>
        </swiper-container>
    <?php endif; ?>
</div>