<?php

include('vendor/class-phpass.php'); 
$wp_hasher = new PasswordHash(8, TRUE);

$password = 'akrbd';
$hash = $wp_hasher->HashPassword($password);

$length = 5;
$charMin = 97;
$charMax = 122;

$start = time();
$password = chr($charMin).chr($charMin).chr($charMin).chr($charMin).chr($charMin);

set_time_limit(0);

// 42 - 122
while($length > 4){
  if($wp_hasher->CheckPassword($password, $hash)) {
    echo "Tiempo de proceso: " . (time() - $start) . " segundos<br>";
    echo "Password: <strong>".$password."</strong>";
    break;
  } else {    
    //pasa al siguiente caracter de la ultima posición
    $password[$length-1] = chr( ord( $password[ $length-1 ] ) + 1 );
    
    for($focus=$length-1; $focus>=0 ; $focus--){
      if( ord( $password[$focus] ) > $charMax ){
        $password[$focus] = chr( $charMin );
        if( $focus > 0) $password[$focus-1] = chr( ord( $password[$focus-1] ) + 1 );
        else{
          $password[$length] = chr( $charMin );
          $length++;
        } 
      }
    }
  }
}




?>