<?php
session_start();
if (isset($_POST['data'])){
    if (preg_match_all("/[+\-X()÷C%±=]|[0-9]/", $_POST['data']) == strlen($_POST['data'])){
        $data = $_POST['data'];
        $response = [];
        if (!isset($_SESSION["tempexp"])){
            $_SESSION["tempexp"] = "";
        }
        if (!isset($_SESSION["expression"])){
            $_SESSION["expression"] = "";
        }

        if (is_numeric($data)){
            $_SESSION["tempexp"] .= $data;
        }

        if ($data == "±"){
            if (substr($_SESSION["tempexp"], 0, 1) === '-') {
                substr($_SESSION["tempexp"], 1);
            } else {
                $_SESSION["tempexp"] = "-" . $_SESSION["tempexp"] . "";
            }
        }

        if ($data == "+" || $data == "-" || $data == "÷" || $data == "X" || $data == "="){
            if ($data == "÷"){
                $data = "/";
            } else if ($data == "X"){
                $data = "*";
            }
            $_SESSION["expression"] .= "(" . $_SESSION["tempexp"] . ")" . $data;
            if ($data == "="){
                $_SESSION["expression"] = substr($_SESSION["expression"], 0, -1);
            }
            $_SESSION["tempexp"] = "";
        }

        if ($data == "%"){

        }


        if ($data == "C"){
            session_unset();
            session_destroy();
        }
        
        
        if ($data == "="){
            if (isset($_SESSION["expression"])){
                $result = eval('return ' . $_SESSION["expression"] . ';');
                $response["current"] = $result . "";
            }
            $_SESSION["expression"] = "";
            $_SESSION["tempexp"] = "";
        }
        if (isset($_SESSION["previous"])){
            $response["previous"] = $_SESSION["previous"];
        }

        /*if (isset($_SESSION["expression"])){
            echo $_SESSION["expression"];
        }*/
        
        echo json_encode($response);
    } else {
        echo json_encode(array("evil"=>""));
    }
}