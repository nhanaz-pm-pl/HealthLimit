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
		if ($this->getHealthLimit() < 1) {
			$this->getServer()->getLogger()->warning("healthLimit is not a positive number! 2 is used instead.");
			unlink($this->getDataFolder() . "config.yml");
			$this->saveDefaultConfig();
			$this->getConfig()->reload();
		}
	}

	private function getHealthLimit() {
		return $this->getConfig()->get("healthLimit", 2);
	}

	private function setHealth(Player $player) {
		$player->setMaxHealth($this->getHealthLimit());
		$player->setHealth($player->getMaxHealth());
	}

	public function onPlayerJoin(PlayerJoinEvent $event): void {
		$this->setHealth($event->getPlayer());
	}

	public function onPlayerRespawn(PlayerRespawnEvent $event): void {
		$this->setHealth($event->getPlayer());
	}
}
