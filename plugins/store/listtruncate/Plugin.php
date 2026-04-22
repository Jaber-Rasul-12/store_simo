<?php

namespace Store\ListTruncate;

use ApplicationException;
use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use Event;
use System\Classes\PluginBase;

/**
 * ListTruncate Plugin 
 * @author Jaber Rasul 
 * @package Store
 */

class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'store.listtruncate::lang.store.plugin.name',
            'description' => 'store.listtruncate::lang.store.plugin.description',
            'author'      => 'store',
            'icon'        => 'icon-toggle-on',
        ];
    }

    /**
     * Register custom list type
     *
     * @return array
     */
    public function registerListColumnTypes()
    {
        return [
            'store-list-truncate' => [ListTruncateField::class, 'render'],
        ];
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        Event::listen('backend.list.extendColumns', function ($widget) {
            /** @var \Backend\Widgets\Lists $widget */
            /** @var \Backend\Classes\ListColumn $listColumn */
            foreach ($widget->getColumns() as $name => $listColumn) {
                if (data_get($listColumn, 'config.type') !== 'store-list-truncate') {
                    continue;
                }

                $widget->addColumns([
                    $name => array_merge($listColumn->config, [
                        'clickable' => false,
                    ]),
                ]);
            }
        });
    }
}
