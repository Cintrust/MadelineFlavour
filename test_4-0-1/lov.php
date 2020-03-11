<?php
    /**
     * Created by PhpStorm.
     * User: CINTRUST
     * Date: 1/9/2019
     * Time: 2:56 AM
     */
    //    ignore_user_abort(1);
    
    
    //function timet(){
    //    $time= time()+360;
    //    $i=0;
    //    do{
    //
    //        echo ++$i." ";
    //        file_put_contents(".".DIRECTORY_SEPARATOR.'dump.txt',"$i \r\n");
    //        $timew= time()+1;
    //        while (time() <$timew){};
    //
    //    }while(time()<$time);
    //}
    
    //    file_put_contents(".".DIRECTORY_SEPARATOR.'dump.txt',"wow \r\n");
    
    //register_shutdown_function('timet');
    //die("wow");
    //$I=1;
    
    //while (1){
    //
    //    $timew= time()+1;
    //    while (time() <$timew){  };
    //
    //    echo $I++." ";
    //}
    //
    //$r=0;
    //
    //$e=[1,4];
    //
    //foreach ($e as $d){
    //    $e[]=3;
    //
    //    echo ++$r." => ";
    
    //    if($r>30) break;
    //
    /*$("section.css-1dbjc4n > div:nth-child(2) > div:nth-child(1) > div >div ")*/
    /*document.querySelectorAll("
      section.css-1dbjc4n > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) >div > div:nth-child(1) > div:nth-child(1) >")*/
    /*section.css-1dbjc4n > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) >
     div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > span
    */
    echo __DIR__;
    die();
    
    $fp = fsockopen("tls://cint.website", 443, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        $out = "GET /telegram_twitter/src/test_4-0/bot_4-0.php HTTP/1.1\r\n";
        $out .= "Host: cint.website\r\n";
//        $t= microtime(true);
//        echo fwrite($fp, $out)." wow\n".strlen($out)."\n";
//        echo (microtime(true)-$t)."\n";
        
        $out .= "Connection: Close\r\n\r\n";
        $t = microtime(true);
        echo fwrite($fp, $out) . " wow\n" . strlen($out) . "\n";
        echo (microtime(true) - $t) . "\n";
        $t = microtime(true);
        
        while (!feof($fp)) {
            echo "\ngame" . fgets($fp, 12) . "waitint \n";
            break;
        }
        echo (microtime(true) - $t) . "\n";
        
        fclose($fp);
    }

?>

<script>
   $took = function (){
         mb = document.querySelectorAll("section.css-1dbjc4n > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) >div > div:nth-child(1) >div > div:nth-child(2) > div:nth-child(1)  a:nth-child(1) > div:nth-child(1)>div:nth-child(2) > div:nth-child(1) > span")
     
         
         if(typeof  dar ==="undefined"){
             dar = [];
             str="";
         }
     
    for (let i = 0; i < mb.length; ++i) {
        
        
        let fo=false;
        for (let j =0; j<dar.length;++j){
            
            if(mb[i].innerText===dar[j]){
             fo=true;
            }
        }
        
        if (!fo) {
            dar.push(mb[i].innerText);
            str+=mb[i].innerText+",";
        }
    }
    console.log(str);
    console.log(dar);
    }
</script>
//$status="by todat i love @programmer_humor  hate";
//echo str_replace(['by','@programmer_humor','hate'],['at'],$status);


//    1562451217


//Some people say that when writing to a socket not all of the bytes requested to be written may be written. You may have to call fwrite again to write bytes that were not written the first time. (At least this is how the write() system call in UNIX works.)
//
//This is helpful code (warning: not tested with multi-byte character sets)
//
//function fwrite_with_retry($sock, &$data)
//{
//    $bytes_to_write = strlen($data);
//    $bytes_written = 0;
//
//    while ( $bytes_written < $bytes_to_write )
//    {
//        if ( $bytes_written == 0 ) {
//            $rv = fwrite($sock, $data);
//        } else {
//            $rv = fwrite($sock, substr($data, $bytes_written));
//        }
//
//        if ( $rv === false || $rv == 0 )
//            return( $bytes_written == 0 ? false : $bytes_written );
//
//        $bytes_written += $rv;
//    }
//
//    return $bytes_written;
//}
//
//Call this like so:
//
//    $rv = fwrite_with_retry($sock, $request_string);
//
//    if ( ! $rv )
//        die("unable to write request_string to socket");
//    if ( $rv != strlen($request_string) )
//        die("sort write to socket on writing request_string");

