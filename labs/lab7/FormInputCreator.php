<?php

$isSubmitted = false;




function makeTextInputField($label, $name, $required) {

    $value = "";
    if(isset($_POST[$name])){
        $value = $_POST[$name];
    }
    $reqText = $required ? '<span class="reqText">*</span>' : '';
    echo "<label for='$name'>$label$reqText :</label>";
    echo "<input type='text' name='$name' id='$name' value='$value'><br>";
}

function makeSelectInputField($label, $name, $options, $required) {
    $selected = "";
    if(isset($_POST[$name])){
        $selected = $_POST[$name];
    }
    $reqText = $required ? '<span class="reqText">*</span>' : '';
    echo "<label for='$name'>$label$reqText :</label>";
    echo "<select name='$name' id='$name' >";
        foreach($options as $option => $optionValue){
            if($option == $selected){
                echo "<option value='$option' selected>$optionValue</option>";
            }else{
                echo "<option value='$option'>$optionValue</option>";
            }
        }
    echo "</select>";

}

function makeRadioInputField($label, $name, $option1, $option2, $required) {
    $checked = "";
    $reqText = $required ? '<span class="reqText">*</span>' : '';
    if(isset($_POST[$name])){
        $checked = $_POST[$name];
    }
    echo "<label for='$name'>$label$reqText :</label>";

    if($checked == $option1){
        echo "<input type='radio' name='$name' id='$name' value='$option1' checked> $option1";
    }else{
        echo "<input type='radio' name='$name' id='$name' value='$option1'> $option1";
    }

    if($checked == $option2){
        echo "<input type='radio' name='$name' id='$name' value='$option2' checked> $option2 <br>";
    }else{
        echo "<input type='radio' name='$name' id='$name' value='$option2'> $option2 <br>";
    }
}

function makeTextareaInputField($label, $name, $required) {
    $value = "";
    if(isset($_POST[$name])){
        $value = $_POST[$name];
    }
    $reqText = $required ? '<span class="reqText">*</span>' : '';
    echo "<div> <label for='$name'>$label$reqText :</label>";
    echo "<textarea name='$name' id='$name' >$value</textarea> </div>";
}