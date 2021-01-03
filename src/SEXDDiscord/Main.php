<?php

namespace SEXDDiscord;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\{PlayerJoinEvent,PlayerQuitEvent, PlayerDeathEvent, PlayerChatEvent};
use JviguyGames\DCord\{Webhook, Message};
use JviguyGames\DCord\Embeds\{EmbedAuthor, EmbedColor, Embed};

class Main extends PluginBase implements Listener{

    public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("Loading");
    $this->wb = new Webhook("your server url");
    }


    public function Join(PlayerJoinEvent $event){
    $this->em = new Embed();
    $this->msg = new Message();
    ###########################
    $date = date("m-d");
    $time = getdate()['hours'].":".getdate()['minutes'].":".getdate()['seconds'];
    $this->em->SetColor(new EmbedColor(104,102,255));
    $this->em->setDescription("[".$date.",".$time."] > ".$event->getPlayer()->getName()."加入遊戲"."(目前共".count($this->getServer()->getOnlinePlayers())."人上線)");
    $this->msg->addEmbed($this->em);
    $this->msg->setUsername("[伺服器線上訊息]");
    $this->wb->SendAsync($this->msg);
    }

    public function Quit(PlayerQuitEvent $event){
    $this->em = new Embed();
    $this->msg = new Message();
    $m = count($this->getServer()->getOnlinePlayers()) - 1;
    $date = date("m-d");
    $time = getdate()['hours'].":".getdate()['minutes'].":".getdate()['seconds'];
    $this->em->SetColor(new EmbedColor(255,0,255));
    $this->em->setDescription("[".$date.",".$time."] > ".$event->getPlayer()->getName()."離開遊戲"."(目前共".$m."人上線)");
    $this->msg->addEmbed($this->em);
    $this->msg->setUsername("[伺服器線上訊息]");
    $this->wb->SendAsync($this->msg);
    }

    public function Chat(PlayerChatEvent $event){
    $this->em = new Embed();
    $this->msg = new Message();
    ###########################
    $msg = $event->getMessage();
    $date = date("m-d");
    $time = getdate()['hours'].":".getdate()['minutes'].":".getdate()['seconds'];
    $this->em->SetColor(new EmbedColor(104,102,255));
    $this->em->setDescription("[".$date.",".$time." | 聊天] > ".$event->getPlayer()->getName().": ".$msg."");
    $this->msg->addEmbed($this->em);
    $this->msg->setUsername("[伺服器線上訊息]");
    $this->wb->SendAsync($this->msg);
    }

    public function onDisable(){
    }
}