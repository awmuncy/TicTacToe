<?php
class ticTacToeGame {
	public $gameBoard;
	private $turn=0; 

	public function __construct(){
		$this->gameBoard = array_fill(0, 9, NULL);
	}
	
	public function place($spot) {
		$this->gameBoard[$spot] = $this->currentPlayer();
		$this->turn++;
	}

	public function isWinner() {
		if($this->turn==9)
			return "No one";
		
		$b = $this->gameBoard;
		$winners = [
			[0, 1, 2],
			[3, 4, 5],
			[6, 7, 8],

			[0, 3, 6],
			[1, 4, 7],
			[2, 5, 8],

			[0, 4, 8],
			[2, 4, 6],
		];
		foreach($winners as $combo) {
			if($b[$combo[0]] != null && $b[$combo[0]] == $b[$combo[1]] && $b[$combo[0]] == $b[$combo[2]]) {
				return $b[$combo[0]];
			}
		}
		
		return false;
	}

	public function currentPlayer() {
		return $this->turn%2 ? "O" : "X";
	}
}