<?php

    function handValue($hand){
        $value = 0;
        $acePresent = 0;
        for($i = 0; $i < sizeof($hand); $i++){
            /**skip card if it is ace**/
            if($hand[$i]->getRank() == "Ace"){
               $acePresent = 1;
            }
            else{
                $value += $hand[$i]->getValue();
            }
        }
        /**determine value of ace based on value of other cards**/
        if($acePresent == 1){
            if($value > 10){
                $value += 1;
            }
            else{
                $value += 11;
            }
        }
        return $value;
    }

    /**returns 1 if game is over, 0 if no victory conditions are met**/
    function winCheck($uValue, $dValue, $stand){
        if($uValue > 21){
            /**YOU LOSE**/
            echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";
            return 1;

        }
        else if ($dValue > 21){
            /**YOU WIN**/
            echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";
            return 1;
        }
        else if ($stand == 1){
            if($uValue > $dValue){
                /**YOU WIN**/
                echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";
                return 1;
            }
            else{
                /**YOU LOSE**/
                echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";
                return 1;
            }
        }
        return 0;
    }
/**
 * Created by JetBrains PhpStorm.
 * User: incubator
 * Date: 6/17/13
 * Time: 1:24 PM
 * To change this template use File | Settings | File Templates.
 */