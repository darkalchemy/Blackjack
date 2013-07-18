<?PHP

class Game
{
	public $DECK = array();
	public $DEALER = array();
	public $PLAYER = array();
	public $cards = array("A","2","3","4","5","6","7","8","9","10","J","Q","K");
	public $suits = array("D","H","S","C");
	
	public function Game()
	{
		// Create the deck
		$this->createDeck();
		// Shuffle the deck 4 times just to be good and shuffled
		for ($t = 0; $t <= 3; $t++)
		{
			shuffle($this->DECK);
		}
	}
	
	private function createDeck()
	{
		for ($i = 0; $i < 13; $i++)
		{
			// 13x4 = 52 cards
			for($x = 0; $x < 4; $x++)
			{
				// Cycle through suits
				// $cards[$i] = current card type
				// $suits[$x] = current suit
				array_push($this->DECK,$this->cards[$i].$this->suits[$x]);
			}
		}
	}
	
	public function dealDealer()
	{
		return array_pop($this->DECK).",".array_pop($this->DECK);
	}
	
	public function dealPlayer()
	{
		return array_pop($this->DECK).",".array_pop($this->DECK);
	}
	
	public function dealCard()
	{
		return array_pop($this->DECK);
	}
	
	public function translateCard($card)
	{
		$face = substr($card,0,-1);
		$suit = substr($card,-1,1);
		switch($suit)
		{
			case 'C':
				return $face." of Clubs";
			case 'S':
				return $face." of Spades";
			case 'H':
				return $face." of Hearts";
			case 'D':
				return $face." of Diamonds";
		}
	}
	
	public function getHandValue($cards)
	{
		$value = 0;
		foreach ($cards as &$values)
		{
			$value += $this->getCardValue($values);
		}
		return $value;
	}
	
	public function getCardValue($card)
	{
		$face = substr($card,0,-1);
		$suit = substr($card,-1,1);
		$num_pattern = '/[0-9]/';
		$face_pattern = '/[JQK]/';
		if (preg_match($num_pattern,$face))
		{
			// This is a number card
			return $face;
		}
		else if (preg_match($face_pattern,$face))
		{
			// This is a regular face card value of 10
			return 10;
		}
		else
		{
			// Ace 1 or 12
			return 1;
			echo "ACE.";
		}
		echo "Face: ".$face."<br />Suit: ".$suit."<br />";
	}
}

?>