<?php
class Core{
    public function __construct($color){
        $this->color = $color;
    }

    public function generateCalculator(){
        $controls = [array("0", ".", "=")];
        $line = [];
        for($i = 1; $i < 10; $i++){
            array_push($line, $i);
            if (($i % 3) == 0){
                if ($i == 3){
                    array_push($line, "+");
                } else if ($i == 6){
                    array_push($line, "-");
                } else if ($i == 9){
                    array_push($line, "X");
                }
                array_push($controls, $line);
                $line = [];
            }
        }
        array_push($controls, array("C", "±", "%", "÷"));
        $controls = array_reverse($controls);
        return $this->generateHtml($controls);
    }

    public function generateHtml($controls){
        $html = "";
        foreach($controls as $line){
            $html .= "<div class='line'>";
            foreach($line as $control){
                $html .= "<button class='lineItem' onclick='calc(this);' style='color: {$this->color}; border: 1px solid {$this->color}; " . ($control == "0" ? "width: 50%" : "") . "'>";
                $html .= $control;
                $html .= "</button>";
            }
            $html .= "</div>";
        }
        return $html;
    }
}
?>