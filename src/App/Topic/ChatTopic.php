<?php

namespace App\Topic;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Ratchet\Wamp\WampConnection;
use Eole\Sandstone\Websocket\Topic;
use App\Event\HelloEvent;

class ChatTopic extends Topic implements EventSubscriberInterface
{
    /**
     * Broadcast message to each subscribing client.
     *
     * {@InheritDoc}
     */
    public function onPublish(WampConnection $conn, $topic, $event)
    {
        $this->broadcast([
            'message' => $event,
        ]);
    }

    /**
     * Subscribe to article.created event.
     *
     * {@InheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            HelloEvent::HELLO => 'onHello',
        ];
    }

    /**
     * Article created listener.
     *
     * @param HelloEvent $event
     */
    public function onHello(HelloEvent $event)
    {
        $this->broadcast([
            'message' => 'Someone called GET /api/hello. Hello '.$event->getName(),
        ]);
    }
}
