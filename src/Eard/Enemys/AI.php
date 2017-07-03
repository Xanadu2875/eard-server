<?php

namespace Eard\Enemys;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\block\Liquid;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\ExplodePacket;
use pocketmine\item\Item as ItemItem;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\block\Block;

use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\level\Location;
use pocketmine\level\Explosion;
use pocketmine\level\MovingObjectPosition;
use pocketmine\level\format\FullChunk;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;

use pocketmine\level\particle\Particle;
use pocketmine\level\particle\BubbleParticle;
use pocketmine\level\particle\ItemBreakParticle;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\InkParticle;
use pocketmine\level\particle\TerrainParticle;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\particle\CriticalParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\sound\LaunchSound;
use pocketmine\level\sound\ExplodeSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\level\sound\SplashSound;
use pocketmine\level\sound\AnvilFallSound;

use pocketmine\entity\Attribute;
use pocketmine\entity\Effect;
use pocketmine\entity\Entity;
use pocketmine\entity\Egg;
use pocketmine\entity\Creeper;
use pocketmine\entity\Skeleton;
use pocketmine\entity\PigZombie;
use pocketmine\entity\Ghast;
use pocketmine\entity\Human;
use pocketmine\entity\Animal;
use pocketmine\entity\Projectile;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\ProjectileHitEvent;

use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;

use pocketmine\network\mcpeprotocol\AnimatePacket;

/**AIとして使う関数を簡単に呼び出せるように置いておく場所
　* abstractだけど継承して使うものではない
 */
abstract class AI{

	const DEFAULT_JUMP = 0.5;

	public static function setSize($enemy, $size){
		$enemy->setScale($size);
		//$enemy->width *= $size;
		$enemy->length *= $size;
		//$enemy->height *= $size;
	}

	/**
	 * Rateを取得
	 * @return bool
	 */
	public static function getRate($enemy){
		$now = microtime(true);
		if(!isset($enemy->cooltime)){
			$enemy->cooltime = $now-1;
		}
		return $enemy->cooltime <= $now;
	}

	/**
	 * クールタイムにする
	 */
	public static function setRate($enemy, $value){
		$now = microtime(true);
		$tick = $value;
		$enemy->cooltime = $now + $value / 20;
		return true;
	}

	//$entityにエイムを合わせる関数
	public static function lookAt($enemy, $target, $oversee = false){
		$x1 = $enemy->x;
		$y1 = $enemy->y;
		$z1 = $enemy->z;
		$x2 = $target->x;
		$y2 = $target->y;
		$z2 = $target->z;

		if(-$z2+$z1 == 0){
			return false;
		}

		$yaw = atan(($x2-$x1)/(-$z2+$z1))*180/M_PI;

		if((-$z2+$z1)/abs(-$z2+$z1) == 1){

			$yaw = $yaw+180;
		}

		$pitch = -1*atan(abs($y2-$y1)/sqrt(pow($x2-$x1,2)+pow($z2-$z1,2)))/(M_PI/180);

		if($y2-$y1 < 0){

			$pitch = -$pitch;

		}

		if(!$oversee && !Enemy::canLook($enemy, $target)){
			$yaw += mt_rand(-30, 30);
		}

		$enemy->yaw = $yaw;
		$enemy->pitch = $pitch;
	}

	/**
	 * 曲がる方向を取得
	 *　負の方向なら-1,正の方向なら+1,真っ直ぐなら0を返す
	 */
	public static function getCurve($entity, $target){
		$x1 = $entity->x;
		$z1 = $entity->z;
		$x2 = $target->x;
		$z2 = $target->z;
		$rad_p = deg2rad($entity->yaw+6);
		$rad_m = deg2rad($entity->yaw-6);
		$xx1p = $x1-sin($rad_p);
		$zz1p = $z1+cos($rad_p);
		$xx1m = $x1-sin($rad_m);
		$zz1m = $z1+cos($rad_m);
		$disq_p = pow($xx1p-$x2, 2)+pow($zz1p-$z2, 2);
		$disq_m = pow($xx1m-$x2, 2)+pow($zz1m-$z2, 2);
		if($disq_p < $disq_m){
			return 1;
		}elseif ($disq_m < $disq_p) {
			return -1;
		}
		return 0;
	}

	public static function getFrontVector($enemy, $is3D = false, $yaw_p = 0, $pitch_p = 0){
		$yaw = $enemy->yaw+$yaw_p;
		$pitch = ($is3D)? $enemy->pitch+$pitch_p : $pitch_p;
		$rad_y = $yaw/180*M_PI;
		$rad_p = ($pitch-180)/180*M_PI;
		return new Vector3(sin($rad_y)*cos($rad_p), sin($rad_p), -cos($rad_y)*cos($rad_p));
	}

	public static function walkFront($enemy, $vec = 0.095, $yawd = 0, $jump = 0.55){
		$rad = deg2rad($enemy->yaw+$yawd);
		$vx = -sin($rad);
		$vz = cos($rad);
		$walk = self::canWalk($enemy, $jump);
		if($walk){
			if($walk === 2){
				$enemy->motionY = $jump;
			}
			$enemy->motionX = $vx*$vec;
			$enemy->motionZ = $vz*$vec;	
		}
		$enemy->move($enemy->motionX, $enemy->motionY, $enemy->motionZ);
		return $walk;
	}

	public static function jump($enemy, $vec = 0.25, $yawd = 0, $jump = self::DEFAULT_JUMP){
		$rad = deg2rad($enemy->yaw+$yawd);
		$vx = -sin($rad);
		$vz = cos($rad);
		$enemy->motionY = $jump;
		$enemy->motionX = $vx*$vec;
		$enemy->motionZ = $vz*$vec;	
		$enemy->move($enemy->motionX, $enemy->motionY, $enemy->motionZ);
	}

	/**
	 * 正面に歩けるかどうかチェック
	 * 0=>false
	 * 1=>true
	 * 2=>jump
	 */
	public static function canWalk($enemy, $jump){
		$level = Server::getInstance()->getDefaultLevel();
		$x = floor($enemy->x) + 0.5;
		$y = floor($enemy->y);
		$z = floor($enemy->z) + 0.5;
		$dir = [0 => 270, 1 => 360, 2 => 90, 3 => 180];
		$yaw = $dir[$enemy->getDirection()];
		$Yaw_rad = deg2rad($yaw);
		$velX = -1 * sin($Yaw_rad);
		$velZ = cos($Yaw_rad);
		$x = floor($x + $velX*(1+$enemy->width));
		$z = floor($z + $velZ*(1+$enemy->width));
		if(!Humanoid::canThrough($level->getBlockIdAt($x, $y, $z))){
			if($jump && $enemy->onGround && $level->getBlockIdAt($x, $y+1, $z) === 0){
				return 2;
			}
			return 0;
		}
		return 1;
	}
}