<?php

declare(strict_types=1);

namespace App;

class Blackjack
{
    public array $deck    = [];
    public array $dealer  = [];
    public array $player  = [];
    public array $cards   = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    public array $suits   = ['D', 'H', 'S', 'C'];
    protected int $shoes  = 2;

    public function __construct()
    {
        // Create the deck
        $this->createDeck();
        // Shuffle the deck 4 times just to be good and shuffled
        for ($t = 0; $t <= 3; ++$t) {
            shuffle($this->deck);
        }
    }

    /**
     * @return string
     */
    public function dealDealer(): string
    {
        return array_pop($this->deck) . ',' . array_pop($this->deck);
    }

    /**
     * @return string
     */
    public function dealPlayer(): string
    {
        return array_pop($this->deck) . ',' . array_pop($this->deck);
    }

    /**
     * @return null|mixed
     */
    public function dealCard()
    {
        return array_pop($this->deck);
    }

    /**
     * @param $card
     *
     * @return string|void
     */
    public function translateCard($card)
    {
        $face = substr($card, 0, -1);
        $suit = substr($card, -1, 1);
        switch ($suit) {
            case 'C':
                return $face . ' of Clubs';
            case 'S':
                return $face . ' of Spades';
            case 'H':
                return $face . ' of Hearts';
            case 'D':
                return $face . ' of Diamonds';
        }
    }

    /**
     * @param $cards
     *
     * @return false|int|string
     */
    public function getHandValue($cards)
    {
        $value = 0;
        foreach ($cards as &$values) {
            $value += $this->getCardValue($values);
        }

        return $value;
    }

    /**
     * @param $card
     *
     * @return false|int|string
     */
    public function getCardValue($card)
    {
        $face         = substr($card, 0, -1);
        $suit         = substr($card, -1, 1);
        $num_pattern  = '/[0-9]/';
        $face_pattern = '/[JQK]/';
        if (preg_match($num_pattern, $face)) {
            // This is a number card
            return $face;
        }
        if (preg_match($face_pattern, $face)) {
            // This is a regular face card value of 10
            return 10;
        }

        // Ace 1 or 12
        return 1;
        //echo 'ACE.';

        //echo 'Face: ' . $face . '<br>Suit: ' . $suit . '<br>';
    }

    /**
     * @param $uValue
     * @param $dValue
     * @param $stand
     *
     * @return int
     */
    public function winCheck($uValue, $dValue, $stand): int
    {
        if ($uValue > 21) {
            // YOU LOSE
            echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";

            return 1;
        }
        if ($dValue > 21) {
            // YOU WIN
            echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";

            return 1;
        }
        if ($stand == 1) {
            if ($uValue > $dValue) {
                // YOU WIN
                echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";

                return 1;
            }

            // YOU LOSE
            echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";

            return 1;
        }

        return 0;
    }

    private function createDeck(): void
    {
        for ($s = 0; $s < $this->shoes; ++$s) {
            for ($i = 0; $i < 13; ++$i) {
                // 13x4 = 52 cards
                for ($x = 0; $x < 4; ++$x) {
                    // Cycle through suits
                    // $cards[$i] = current card type
                    // $suits[$x] = current suit
                    array_push($this->deck, $this->cards[$i] . $this->suits[$x]);
                }
            }
        }
    }
}
