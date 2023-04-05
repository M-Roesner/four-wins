<?php
    // require_once 'private/classes/Player.php';
    class Playground {
        
        private int $width;
        private int $height;
        private $players;
        private $board;

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

        // tries to set the coin in the playerfield from active player.
        // If does'n work nothing will happen.
        // return: $activePlayer
        public function makeMove($column, $player){
            if ($this->setCoin($column, $player)){
                return $this->switchPlayer($player);
            }
            return $player;
        }

        // set the coin in playerfield
        // return: true, if it could set.
        public function setCoin($column, $player) {
            $column -= 1;
            for ($row = $this->getHeight()-1; $row >= 0; $row--) {
                if ($this->board[$row][$column] == 0) {
                    $this->board[$row][$column] = $player;
                    $_SESSION['board'] = $this->board; // optional for session
                    return true;
                }
            }
            return false;
        }

        // gives the player each cell from playerfield
        // return: player (1 or 2), else default (0)
        public function getCoin($row, $column) {
            return $this->board[$row][$column];
        }
        
        // switch the player
        // return: $activePlayer
        public function switchPlayer($player){
            if ($player == 1) {
                return 2;
            } else {
                return 1;
            }
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
        
        public function getPlayerChampion($player){
            return $player;
        }
    }
?>