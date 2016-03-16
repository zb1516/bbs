<?php
function thumbPath($path)
{
    return 'http://'.$_SERVER['HTTP_HOST']."./Uploads/".$path;
}
