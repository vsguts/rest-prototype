<?php

/**
 * Debug helpful
 */
function p()
{
    echo('<ol style="font-family: Courier; font-size: 12px; border: 1px solid #dedede; background-color: #efefef;">');
    foreach (func_get_args() as $v) {
        echo('<li><pre>' . htmlspecialchars(print_r($v, true)) . "\n" . '</pre></li>');
    }
    echo('</ol><div style="clear:left;"></div>');
}

function pd()
{
    call_user_func_array('p', func_get_args());
    die;
}
