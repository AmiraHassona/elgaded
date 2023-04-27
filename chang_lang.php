<?PHP
session_start();
if(!empty($_REQUEST["lang"])){
    if($_REQUEST["lang"] == "ar"){
        $_SESSION["lang"] = "ar";
    }
    else {
        $_SESSION["lang"] = "en";
    }
}

  header("location:" .$_SERVER ["HTTP_REFERER"]); 
