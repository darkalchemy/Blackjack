<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "Deck.php";
require "Functions.php";
/**clear all session variables if user plays again**/
if (isset($_GET['again'])) {

}
session_start();
if (!isset($_GET['hit']) && !isset($_GET['stand'])) {
    $gameOver = 0;
    $_SESSION['deck'] = new Deck();
    shuffle($_SESSION['deck']->m_deck);

    /**initial deal**/
    $userHand[0] = $_SESSION['deck']->Deal();
    $dealerHand[0] = $_SESSION['deck']->Deal();
    $userHand[1] = $_SESSION['deck']->Deal();
    $dealerHand[1] = $_SESSION['deck']->Deal();
    // var_dump($_SESSION['deck']);
    $_SESSION['userHand'] = $userHand;
    $_SESSION['dealerHand'] = $dealerHand;
    $_SESSION['dHandValue'] = handValue($_SESSION['dealerHand']);
} else if (isset($_GET['hit'])) {
    $_SESSION['userHand'][sizeof($_SESSION['userHand'])] = $_SESSION['deck']->Deal();
    $_SESSION['userValue'] = handValue($_SESSION['userHand']);
    $gameOver = winCheck($_SESSION['userValue'], $_SESSION['dHandValue'], 0);
} else if (isset($_GET['stand'])) {
    while ($_SESSION['dHandValue'] < 17) {
        $_SESSION['dealerHand'][sizeof($_SESSION['dealerHand'])] = $_SESSION['deck']->Deal();
        $_SESSION['dHandValue'] = handValue($_SESSION['dealerHand']);
        $gameOver = winCheck($_SESSION['userValue'], $_SESSION['dHandValue'], 1);


    }
}

?>

<html>
<head align='center'>
    <p align='center'><b>Welcome to Ghetto Blackjack</b>
    </p>
</head>
<p align='center'>
    Your Hand is:<br/>
    <?php for ($i = 0; $i < sizeof($_SESSION['userHand']); $i++) {
        echo $_SESSION['userHand'][$i]->toString() . "<br />";
        //echo "<br />" . $i . " " . sizeof($_SESSION['userHand']);
        //var_dump($_SESSION['userHand']);
    }

    echo "<br /><br />Your opponents visible cards: <br />";
    for ($j = 1; $j < sizeof($_SESSION['dealerHand']); $j++) {
        echo $_SESSION['dealerHand'][$j]->toString() . "<br />";
    }
    /**game is not over; reload screen like normal**/
    if ($gameOver == 0){
        echo '<form style=\'text-align:center\' action=\'index.php\' method=\'get\'>
                      <input type=\'submit\' name=\'hit\' value=\'hit\'/><br />
                      <input type=\'submit\' name=\'stand\' value=\'stand\'/></form>';
    } /**Victory conditions are met; print final screen**/
    else{

      echo 'Your final score was:' . $_SESSION['uHandValue'] . '<br /> Your opponents final score was: 
            <form style=\'text-align:center\' action=\'index.php\' method=\'get\'>
            <input type=\'submit\' name=\'again\' value=\'Play Again\'/></form>';
    } ?>
</p>
</html>


