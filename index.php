<?php include('ticTacToe.php');

session_start();

if($_POST['reset']==true) {
	session_destroy();
	unset($_SESSION);
}?>

<form method="POST">
	<input value="true" name="reset" type="hidden">
	<input type="submit" value="New game" />
</form>

<?php
if(isset($_SESSION["game"])) {
	$game = $_SESSION["game"];
} else {
	$game = new ticTacToeGame();
}

if(isset($_POST['selection'])){
	$game->place($_POST['selection']); 
}
$player = $game->currentPlayer();

if($game->isWinner()) {
	?><h1>Game over. <?php echo $game->isWinner();?> wins!</h1><?php
} else {
	echo "<h1>" . $player . "'s turn</h1>";
} ?>
	<form class="board" method="POST">
		<?php 
		$i = 0; 
		foreach($game->gameBoard as $slot) { ?>
			<div class="slot">
				<?php if($slot) { 
					echo "<span>" . $slot . "</span>";
				} else { ?>
					<input type="radio" name="selection" value="<?=$i;?>"><?=$player;?>
				<?php } ?>
			</div>
		<?php 
			$i++;
		} ?>
		<?php 
		if(!$game->isWinner()) { ?>
			<input type="submit" value="Submit">
		<?php } ?>
	</form>
	<?php 
	$_SESSION["game"] = $game;
?>

<style>
	body {
		text-align: center;
	}
	form.board {
		margin: 20px auto;
		display: flex;
		flex-wrap: wrap;
		width: 120px;
		justify-content: center;
		border: 1px solid #ccc;
		border-radius: 3px;
		padding: 5px;
	}
	div.slot {
		border: 1px solid #999;
		width: 33.3333%;
		display: flex;
		height: 38px;
		width: 38px;
		font-size: .8rem;
		justify-content: center;
	}
	div.slot span {
		font-size: 2rem;
	}
</style>