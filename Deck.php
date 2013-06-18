<?php
/**
 * Created by JetBrains PhpStorm.
 * User: incubator
 * Date: 6/17/13
 * Time: 8:32 AM
 * To change this template use File | Settings | File Templates.
 */

require "Card.php";

class Deck {

    public $m_deck = array();

    function __construct(){

        for($i = 1; $i < 53; $i++){

            /**Determining Suit**/
            if($i < 14){
                $newSuit = "Clubs";
            }
            else if ($i < 27){
                $newSuit = "Diamonds";
            }
            else if ($i < 40){
                $newSuit = "Hearts";
            }
            else if ($i < 53){
                $newSuit = "Spades";
            }

            /**Ace**/
            if($i % 13 == 1){
                $newRank = "Ace";
                $newValue = 1;
            }
            /**Jack**/
            else if($i % 13 == 11){
                $newRank = "Jack";
                $newValue = 10;
            }
            /**Queen**/
            else if($i % 13 == 12){
                $newRank = "Queen";
                $newValue = 10;
            }
            /**King**/
            else if($i % 13 == 0){
                $newRank = "King";
                $newValue = 10;
            }
            /**Regular Numbers**/
            else{
                $newRank = $i % 13;
                $newValue = $i % 13;
            }
            //echo "<br />" . $i . " " . $newSuit . " " . $newRank . " " . $newValue;
            $this->m_deck[$i - 1] = new Card($newSuit, $newRank, $newValue);
           // var_dump($this->m_deck[$i - 1]);
        }


    }

    function Deal(){
        static $i = 0;
        $i++;
        return($this->m_deck[$i - 1]);
        echo "<br />";
        var_dump($i);
        echo "<br />";
    }




}