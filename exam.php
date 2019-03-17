<?php

$target = 'localhost:8080';
$dl = 'dirlist.txt';
$pl = 'phplist.txt';
$cl = 'dir.txt';
$dlx = count(file($dl));
$plx = count(file($pl));
@system("clear");
include 'config.php';
print "\n";
print "$cyan      ▄  ██   █▀▄▀█$red █ ▄▄  █    ████▄ ▄█    ▄▄▄▄▀ \n";
print "$cyan  ▀▄   █ █ █  █ █ █$red █   █ █    █   █ ██ ▀▀▀ █ \n";
print "$cyan    █ ▀  █▄▄█ █ ▄ █$red █▀▀▀  █    █   █ ██     █ \n";
print "$cyan   ▄ █   █  █ █   █$red █     ███▄ ▀████ ▐█    █ \n";
print "$cyan  █   ▀▄    █    █ $red  █        ▀       ▐   ▀ \n";
print "$cyan   ▀       █    ▀  $red   ▀ \n";
print "$cyan          ▀        $white \n";
print "$white        Dir : $dlx List ~ File : $plx List \n";
print "$white           Target : $target \n";
print "\n";
sleep(5);
if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
        $targetnya = "http://$target";
    }
else{
        $targetnya = $target;
    }
$dla = fopen("$dl","r");
$dlb = filesize("$dl");
$dlc = fread($dla,$dlb);
$dllists = explode("\n",$dlc);
print "\n\n$cyan [$yellow *$cyan ]$white Directory Brute ...\n";
sleep(1);
foreach($dllists as $dir){
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
$pla = fopen("$pl","r");
$plb = filesize("$pl");
$plc = fread($pla,$plb);
$pllists = explode("\n",$plc);
print "\n\n$cyan [$yellow *$cyan ]$white PHP file Scanning ...\n";
sleep(1);
foreach($pllists as $dir){
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
$cla = fopen("$cl","r");
$clb = filesize("$cl");
$clc = fread($cla,$clb);
$cllists = explode("\n",$clc);
print "\n\n$cyan [$yellow *$cyan ]$white Cloning all Directory ...\n";
sleep(1);
foreach($cllists as $dir){
    print "\n$cyan [$okegreen Cloning$cyan ]$red >$white $dir";
    @system("wget -qr $dir");
}
sleep(1);
print "\n$cyan [$okegreen *$cyan ]$white Directory list reported to dir.txt";sleep(1);
print "\n$cyan [$okegreen *$cyan ]$white PHP file list reported to php.txt";sleep(1);
print "\n$cyan [$okegreen *$cyan ]$white Directory clone reported to $target\n";sleep(1);
print "\n$cyan [$okegreen *$cyan ]$white ALL DONE, SIR !!\n\n";

?>
