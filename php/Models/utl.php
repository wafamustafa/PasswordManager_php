<?php
// File created by Sandra Kupfer 2021/03.

function wl( $someString )
{
    echo $someString . "</br>";
}

function pp( $obj )
{
    $jsonData = json_encode( $obj, JSON_PRETTY_PRINT );
    echo "<pre> {$jsonData} </pre>";
}

function checkSecure()
{
    // make sure the page uses a secure connection
    $https = filter_input(INPUT_SERVER, 'HTTPS');
    if (!$https) {
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $url = 'https://' . $host . $uri;
        header("Location: " . $url);
        exit();
    }
}

?>