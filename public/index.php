<?php

declare(strict_types=1);

use App\Blackjack;

require __DIR__ . '/../vendor/autoload.php';

// Establish defaults
$gameOver = 0;
$game     = new Blackjack();		// Create a new deck and start a new game

// clear all session variables if user plays again
if (isset($_GET['again'])) {
}
session_start();
if (!isset($_GET['hit']) && !isset($_GET['stand'])) {
    // initial deal
    $userHand[0]            = $game->dealCard();
    $dealerHand[0]          = $game->dealCard();
    $userHand[1]            = $game->dealCard();
    $dealerHand[1]          = $game->dealCard();
    $_SESSION['userHand']   = $userHand;
    $_SESSION['dealerHand'] = $dealerHand;
    $_SESSION['dHandValue'] = $game->getHandValue($_SESSION['dealerHand']);
} elseif (isset($_GET['hit'])) {
    $_SESSION['userHand'][sizeof($_SESSION['userHand'])] = $game->dealCard();
    $_SESSION['userValue']                               = $game->getHandValue($_SESSION['userHand']);
    $_SESSION['dHandValue']                              = $game->getHandValue($_SESSION['dealerHand']);
    $_SESSION['uHandValue']                              = $game->getHandValue($_SESSION['userHand']);
    // Auto-stand if at 21
    if ($_SESSION['userValue'] == 21) {
        header('Location: index.php?stand=stand');
    }
    // Check if, by hitting, the game has ended
    $gameOver = $game->winCheck($_SESSION['userValue'], $_SESSION['dHandValue'], 0);
} elseif (isset($_GET['stand'])) {
    while ($_SESSION['dHandValue'] < 17) {
        $_SESSION['dealerHand'][sizeof($_SESSION['dealerHand'])] = $game->dealCard();
        $_SESSION['dHandValue']                                  = $game->getHandValue($_SESSION['dealerHand']);
        $_SESSION['uHandValue']                                  = $game->getHandValue($_SESSION['userHand']);
    }
    $gameOver = $game->winCheck($_SESSION['uHandValue'], $_SESSION['dHandValue'], 1);
}

?>

<html>
<head>
<style>
	body {
		margin:0px;
	}
</style>
</head>
<body>
    <h2 style='text-align:center;'>Blackjack</h2>
<div align='center' style="background-color:beige; padding:5px; width:300px; margin:auto;">
    <div style="text-decoration:underline; font-weight:bold;">Your Hand is:</div><br/>
    <?php // Show cards
    for ($i = 0; $i < sizeof($_SESSION['userHand']); ++$i) {
        echo $game->translateCard($_SESSION['userHand'][$i]) . '<br />';
    }

    echo "<div style='text-decoration:underline; font-weight:bold;'><br /><br />Your opponents visible cards: </div><br />";
    if ($gameOver == 0) {
        for ($j = 1; $j < sizeof($_SESSION['dealerHand']); ++$j) {
            echo $game->translateCard($_SESSION['dealerHand'][$j]) . '<br />';
        }
    } else {
        for ($j = 0; $j < sizeof($_SESSION['dealerHand']); ++$j) {
            echo $game->translateCard($_SESSION['dealerHand'][$j]) . '<br />';
        }
    }

    echo '<br /><br />';
    // game is not over; reload screen like normal
    if ($gameOver == 0) {
        echo '<form style=\'text-align:center\' action=\'index.php\' method=\'get\'>
                      <input type=\'submit\' name=\'hit\' value=\'hit\'/><br />
                      <input type=\'submit\' name=\'stand\' value=\'stand\'/></form>';
    } // Victory conditions are met; print final screen
    else {
        echo 'Your final score was: ' . $_SESSION['uHandValue'] . '<br /> Your opponents final score was: ' . $_SESSION['dHandValue'] . '
            <form style=\'text-align:center\' action=\'index.php\' method=\'get\'>
            <input type=\'submit\' name=\'again\' value=\'Play Again\'/></form>';
    } ?>
</div>
</body>
</html>
