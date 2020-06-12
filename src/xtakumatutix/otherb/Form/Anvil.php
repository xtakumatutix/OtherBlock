<?php

namespace xtakumatutix\otherb\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use pocketmine\item\Item;
use xtakumatutix\otherb\Form\type\Repair;
use xtakumatutix\otherb\Form\type\Setitemname;

Class Anvil implements Form
{
    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            return;
        }
        switch ($data) {
            case 0:
            $item = $player->getInventory()->getItemInHand();
            if ($item instanceof TieredTool && $item instanceof Bow && $item instanceof Armor) {
                $player->sendMessage('1');
                if ($item->getDamage() > 1) {
                    $player->sendForm(new Repair($item));
                    $player->sendMessage('2');
                }else{
                    $player->sendMessage('3');
                }
            }else{
                $player->sendMessage('4');
            }
            break;

            case 1:
            $item = $player->getInventory()->getItemInHand();
            $player->sendForm(new Setitemname($item));
            break;
        }
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'form',
            'title' => '金床',
            'content' => '金床のメニューです！',
            'buttons' => [
                [
                    'text' => 'アイテムを修復する'
                ],
                [
                    'text' => 'アイテムの名前を変える'
                ]
            ],
        ];
    }
}