<?php
/**
 * Created by JetBrains PhpStorm.
 * User: incubator
 * Date: 6/17/13
 * Time: 8:26 AM
 * To change this template use File | Settings | File Templates.
 */

class Card {

    private $m_suit;
    private $m_rank;
    private $m_value;


    function __construct($suit, $rank, $value){
        $this->m_suit = $suit;
        $this->m_rank = $rank;
        $this->m_value = $value;

    }

    function getSuit(){
        return $this->m_suit;
    }

    function getRank(){
        return $this->m_rank;
    }

    function getValue(){
        return $this->m_value;
    }

    function toString(){
        return $this->m_rank . " of " . $this->m_suit;
    }
}