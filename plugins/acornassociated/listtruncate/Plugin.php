<?php

namespace AcornAssociated\ListTruncate;

use ApplicationException;
use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use Event;
use System\Classes\PluginBase;

/**
 * ListTruncate Plugin 
 * @author Jaber Rasul 
 * @package AcornAssociated
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
            'name'        => 'acornassociated.listtruncate::lang.acornassociated.plugin.name',
            'description' => 'acornassociated.listtruncate::lang.acornassociated.plugin.description',
            'author'      => 'acornassociated',
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
            'acornassociated-list-truncate' => [ListTruncateField::class, 'render'],
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
                if (data_get($listColumn, 'config.type') !== 'acornassociated-list-truncate') {
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
