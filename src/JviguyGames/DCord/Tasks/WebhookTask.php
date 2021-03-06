<?php

namespace JviguyGames\DCord\Tasks;

use JviguyGames\DCord\Message;
use JviguyGames\DCord\Webhook;
use pocketmine\scheduler\AsyncTask;

class WebhookTask extends AsyncTask
{

    /** @var Webhook */
    protected $webhook;
    /** @var Message */
    protected $message;

    public function __construct(Webhook $webhook, Message $message){
        $this->webhook = $webhook;
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function onRun()
    {
        $ch = curl_init($this->webhook->getURL());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->message));
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $this->setResult(curl_exec($ch));
        curl_close($ch);
    }
}