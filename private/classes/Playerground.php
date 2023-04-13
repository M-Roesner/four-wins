<?php
    // require_once 'private/classes/Player.php';
    class Playground {
        
        private int $width;
        private int $height;
        private $players;
        private $board;
        private $latestCoinCoordinates;

        // create a playerfield, if nothing in session, else load playerfield from session
        public function __construct(int $width, int $height){
            $this->setWidth($width);
            $this->setHeight($height);
            if (!isset($_SESSION['board'])){
                $this->generateBoard($width, $height);
            } else {
                $this->board = $_SESSION['board'];
            }
        }

        private function setWidth($width){
            $this->width = $width;
        }

        public function getWidth(){
            return $this->width;
        }

        private function setHeight($height){
            $this->height = $height;
        }

        public function getHeight(){
            return $this->height;
        }

        public function getBoard(){
            return $this->board;
        }

        // Sets the row and column of the last coin what has been set
        public function setLatestCoinCoordinates($coordinates){
            $this->latestCoinCoordinates = $coordinates;
        }

        // gets the an Array with coordinates
        // return: array[$row; $column]
        public function getLatestCoinCoordinates(){
            return $this->latestCoinCoordinates;
        }

        // Output an Array from board
        // return: String
        public function toString(){
            $board = $this->getBoard();
            $result = "<br>";
            for ($row=0; $row < $this->getHeight(); $row++) {
                $result .= "row[" .$row . "]: ";
                for ($col=0; $col < $this->getWidth(); $col++) { 
                    $result .= "col[" . $col . "]=>" .$board[$row][$col] . " | ";
                }
                $result .= "<br>";
            }
            return $result;
        }

        // generates a new playerfield for the constructor
        private function generateBoard($width, $height){
            $board = array();
            for ($i = 0; $i < $height; $i++) {
                $board[$i] = array_fill(0, $width, 0);
            }
            $this->board = $board;
            $_SESSION['board'] = $board; // optional for session
        }

        // tries to set the coin in the playerfield from active player,
        // if does'n work nothing will happen.
        // return: newActivePlayer
        public function makeMove($column, $player, $startedPlayer){
            $this->setCoin($column, $player, $startedPlayer);
            return $switchedPlayer = $this->switchPlayer($player);
        }

        // set the coin in playerfield
        // return: true, if it could set.
        public function setCoin($column, $player, $startedPlayer) {
            if ($this->isValideMove($player, $startedPlayer)) {
                for ($row = $this->getHeight()-1; $row >= 0; $row--) {
                    if ($this->board[$row][$column] == 0) {
                        $this->board[$row][$column] = $player;
                        $_SESSION['board'] = $this->board; // optional for session
                        $coordinates = array(
                                "row"    => $row,
                                "col"  => $column,
                            );
                        $this->setLatestCoinCoordinates($coordinates);
                        return true;
                    }
                }
            }
            return false;
        }

        // checks validity from palyer to do a move
        // return true
        private function isValideMove($player, $startedPlayer){
            $countActivePlayer = 0;
            $countEnemyPlayer = 0;
            for ($col=0; $col < $this->getWidth(); $col++) { 
                for ($row=0; $row < $this->getHeight(); $row++) { 
                    $cell = $this->board[$row][$col];
                    if ($cell != 0) {
                        ($cell == $player) ? $countActivePlayer++ : $countEnemyPlayer++;
                    }
                }
            }
            return (($player == $startedPlayer && $countActivePlayer == $countEnemyPlayer)
                || ($player != $startedPlayer && $countActivePlayer + 1 == $countEnemyPlayer))
                ? true : false;
        }

        // gives the player of cell from playerfield
        // return: player (1 or 2), else default (0)
        public function getCoin($row, $column) {
            return $this->board[$row][$column];
        }
        
        // switches the player
        // return: newActivePlayer
        public function switchPlayer($player){
            return ($player == 1) ? 2 : 1;
        }

        // checks if active player has won.
        // return: true, if active player has won
        public function hasWon($player) {
            $board = $this->getBoard();
            $height = $this->getHeight();
            $width = $this->getWidth();

            // Check horizontal
            for ($row = 0; $row < $height; $row++) {
                for ($col = 0; $col < $width - 3; $col++) {
                    if ($board[$row][$col] == $player && 
                        $board[$row][$col+1] == $player && 
                        $board[$row][$col+2] == $player && 
                        $board[$row][$col+3] == $player) {
                        return true;
                    }
                }
            }
            // Check vertical
            for ($row = 0; $row < $height - 3; $row++) {
                for ($col = 0; $col < $width; $col++) {
                    if ($board[$row][$col] == $player && 
                        $board[$row+1][$col] == $player && 
                        $board[$row+2][$col] == $player && 
                        $board[$row+3][$col] == $player) {
                        return true;
                    }
                }
            }
            // Check diagonal (top-left to bottom-right)
            for ($row = 0; $row < $height - 3; $row++) {
                for ($col = 0; $col < $width - 3; $col++) {
                    if ($board[$row][$col] == $player && 
                        $board[$row+1][$col+1] == $player && 
                        $board[$row+2][$col+2] == $player && 
                        $board[$row+3][$col+3] == $player) {
                        return true;
                    }
                }
            }
            // Check diagonal (top-right to bottom-left)
            for ($row = 0; $row < $height - 3; $row++) {
                for ($col = 3; $col < $width; $col++) {
                    if ($board[$row][$col] == $player && 
                        $board[$row+1][$col-1] == $player && 
                        $board[$row+2][$col-2] == $player && 
                        $board[$row+3][$col-3] == $player) {
                        return true;
                    }
                }
            }
            return false;
        }

        // checks if all coint set from players
        // return: true, if all cells have not '0'
        public function checkTie(){
            $board = $this->getBoard();
            $height = $this->getHeight();
            $width = $this->getWidth();

            for ($row = 0; $row < $height; $row++) {
                for ($col = 0; $col < $width - 3; $col++) {
                    if ($board[$row][$col] == 0) {
                        return false;
                    }
                }
            }
            return true;
        }
        
        public function getPlayerChampion($player){
            return $player;
        }
    }
?>