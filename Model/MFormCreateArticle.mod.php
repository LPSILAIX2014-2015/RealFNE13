<?php
class MFormCreateArticle
{
    public function __construct(){}

    public function __destruct(){}

    public function insertDB($data){
        //Get all data from inputs in $option
        $options = array(
            "articleTheme"      => FILTER_SANITIZE_SPECIAL_CHARS,
            "eventPlace"        => FILTER_SANITIZE_SPECIAL_CHARS,
            "startDate"         => FILTER_SANITIZE_SPECIAL_CHARS,
            "duration"          => FILTER_VALIDATE_INT,
            "inscription"       => FILTER_SANITIZE_SPECIAL_CHARS,
            "textareaDecrypt"   => FILTER_SANITIZE_SPECIAL_CHARS
        );
        // Fill data form with $otpion (we can get the data of all input by using $dataForm["nameinput"]
        $dataForm = filter_input_array(INPUT_POST, $options);

    }

}
?>