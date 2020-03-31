<?php

/*
 * InfoAPI
 *
 * Copyright (C) 2019-2020 SOFe
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace SOFe\InfoAPI;

use pocketmine\level\Level;

class LevelInfo extends Info{
	/** @var Level */
	private $level;

	public function __construct(Level $level){
		$this->level = $level;
	}

	public function getLevel() : Level{
		return $this->level;
	}

	public function toString() : string{
		return $this->level->getFolderName();
	}

	/**
	 * @param InfoRegistry $registry
	 *
	 * @internal Used by InfoAPI to register details
	 */
	public static function register(InfoRegistry $registry) : void{
		$registry->addDetails(self::class, ["pocketmine.level.custom name", "pocketmine.world.custom name"], static function(LevelInfo $info){
			return new StringInfo($info->level->getName());
		});
		$registry->addDetails(self::class, ["pocketmine.level.name", "pocketmine.world.name", "pocketmine.level.folder name", "pocketmine.world.folder name"], static function(LevelInfo $info){
			return new StringInfo($info->level->getFolderName());
		});
		$registry->addDetails(self::class, ["pocketmine.level.time", "pocketmine.world.time"], static function(LevelInfo $info){
			return new NumberInfo($info->level->getTime()); // TODO better formatting: TimeInfo
		});
		$registry->addDetails(self::class, ["pocketmine.level.seed", "pocketmine.world.time"], static function(LevelInfo $info){
			return new NumberInfo($info->level->getSeed());
		});
	}
}
