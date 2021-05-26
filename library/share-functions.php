<?php
//File created by Wafa 04/2021

//get all users drop down
function userDropdown($recipients, $select = ""){
    $html_usersdropdown = "";
    foreach ($recipients as $recipient) {
        $selected = $select == $recipient->user_id ? "selected" : "";
        $html_usersdropdown .= "<option $selected value='$recipient->user_id'>$recipient->first_name</option>";
    }

    return $html_usersdropdown;
}

//get all url dropdown

function urlDropdown($urls, $select = ""){
    $html_urlsdropdown = "";
    foreach ($urls as $url) {
        $selected = $select == $url->url_id ? "selected" : "";
        $html_urlsdropdown .= "<option $selected value='$url->url_id'>$url->url</option>";
    }

    return $html_urlsdropdown;
}
