<?php
    enum Color: string {
        case RED  = 'Rot';
        case BLUE = 'Blau';
        case YELLOW = 'Gelb';

        public function hexcode(): string {
            return match($this) {
                Color::RED => '#ff0000',
                Color::BLUE => '#0000ff',
                Color::YELLOW => '#ffff00',
            };
        }

        public function icon(): string {
            return match($this)
            {
                Color::RED => 'red-icon.png',
                Color::BLUE => 'blue-icon.png',
                Color::YELLOW => 'yellow-icon.png',
            };
        }
    }
    
    class Player {
        
        private $playername;
        private COLOR $color;
        private $characterPicture = '';

        public function __construct(string $name, Color $color = Color::YELLOW){
            $this->setPlayername($name);
            $this->setColor($color);
        }

        private function setPlayername(string $name){
            $this->playername = $name;
        }

        public function getPlayername(){
            return $this->playername;
        }

        public function setColor(Color $color){
            $this->color = $color;
        }

        public function getColorName(){
            return $this->color->name;
        }

        public function getColorValue(){
            return $this->color->value;
        }

        public function getColorHexcode(){
            return $this->color->hexcode();
        }

        public function getColorIcon(){
            return $this->color->icon();
        }

        public function setCharacterPicture(){

        }
        public function getCharacterPicture(){
            return $this->CharacterPicture;
        }
    }

    class HumanPlayer extends Player{
    }

    class KiPlayer extends Player{
        // function __construct(){
        //     parent::__construct();
        // }
    }

    $pl1 = new HumanPlayer("Markus");
    echo $pl1->getPlayername() . "<br>";
    echo $pl1->getColorName() . "<br>";
    echo $pl1->getColorValue() . "<br>";
    echo $pl1->getColorHexcode() . "<br>";
    echo $pl1->getColorIcon() . "<br>";

    $pl2 = new HumanPlayer("Steffen", COLOR::BLUE);
    echo $pl2->getPlayername() . "<br>";
    echo $pl2->getColorName() . "<br>";
    echo $pl2->getColorValue() . "<br>";
    echo $pl2->getColorHexcode() . "<br>";
    echo $pl2->getColorIcon() . "<br>";
?>