<?php
function set_active($url)
{
    if (is_array($url)) {
        return in_array(Request::path(), $url) ? 'active' : '';
    }
    return Request::path() == $url ? 'active' : '';
}
