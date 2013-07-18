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
		echo "Shuffling...\n";
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
	
	public function getHandValue($cards)
	{
		// If cards contain an A...
		$c = explode(',',$cards);
		//return substr($c[1],0,-1);
		$value = $this->getCardValue(substr($c[0],0,-1));
		$value += $this->getCardValue(substr($c[1],0,-1));
		return $value;
	}
	
	public function getCardValue($card)
	{
		//echo
	}
}

?>