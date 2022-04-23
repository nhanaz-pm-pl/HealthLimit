<?php

declare(strict_types=1);

namespace NhanAZ\HealthLimit;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerRespawnEvent;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->cfg = $this->getConfig();
	}

	private function setHealth(Player $player) {
		$player->setMaxHealth($this->cfg->get("HealthLimit"));
		$player->setHealth($player->getMaxHealth());
	}

	public function onPlayerJoin(PlayerJoinEvent $event): void {
		$this->setHealth($event->getPlayer());
	}

	public function onPlayerRespawn(PlayerRespawnEvent $event): void {
		$this->setHealth($event->getPlayer());
	}
}
