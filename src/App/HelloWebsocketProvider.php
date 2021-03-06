<?php

namespace App;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use App\Topic\ChatTopic;

class HelloWebsocketProvider implements ServiceProviderInterface
{
    /**
     * {@InheritDoc}
     */
    public function register(Container $app)
    {
        $app->topic('chat', function ($topicPattern) {
            return new ChatTopic($topicPattern);
        });
    }
}
