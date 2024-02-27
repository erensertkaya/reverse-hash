<?php

function getHashPartials($string, $length)
{
    $substrings = [];

    for ($i = 0; $i < strlen($string); $i += $length) {
        $substrings[] = substr($string, $i, $length);
    }

    return $substrings;
}

function getAllPossiblePairedCharacters($characters)
{
    $pairedCharacters = [];

    foreach ($characters as $char1) {
        foreach ($characters as $char2) {
            $pair = $char1 . $char2;
            $pairedCharacters[] = $pair;
        }
    }

    return $pairedCharacters;
}

function hashPairs($pairs)
{
    $rainbowTable = [];
    foreach ($pairs as $pair) {
        $rainbowTable[$pair] = md5(md5($pair) . $pair . md5($pair));
    }
    return $rainbowTable;
}

function reverse_hash($hash)
{
    $md5HashLength = "32";
    $possibleChacters = "1234567890abcdefghijklmnoprstuvwxyz_+.@";
    $possibleChactersArr = str_split($possibleChacters);
    $allPossibleCharacters = getAllPossiblePairedCharacters($possibleChactersArr);
    $hashPartials = getHashPartials($hash, $md5HashLength);
    $rainbowTable = hashPairs($allPossibleCharacters);

    $passphrase = "";
    foreach ($hashPartials as $partial) {
        foreach ($rainbowTable as $pair => $hashedPairValue) {
            if ($hashedPairValue == $partial) {
                $passphrase .= $pair;
            }
        }
    }

    return $passphrase;
}


$hash = "5e35b5a6a854db008cb8a677dfff030b734168987eb22968456cfed670dcab1d87e7e1f38cb6cf7d387ad9bd0b6e036790ae5c0a637d25e9d5098aac5c8612220d151bb9d5cb6b03be64cfed60ef58f0541146adc5675a092bfaef4a94b3a004fa368ee455ec197e0c92c27085cf6693f894e71e1551d1833a977df952d0cc9dcfaddd5e5358a52339e0176e8f25e29ea9bd260dda8911baa77007f08a997ba95dddf90b1e8280510289f4999eb81c679b1ad43d90e297740caf2eb5cd308e4273345ff253b3aa09375da98f17812543";

echo reverse_hash($hash);
