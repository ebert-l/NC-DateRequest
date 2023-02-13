<?php
function is_clean_file ($file)
{
    if (file_exists($file))
    {
        $contents = file_get_contents($file);
    }
    else
    {
        exit($file." Not exists.");
    }

    if (preg_match('/(base64_|eval|system|shell_|exec|php_)/i',$contents))
    {
        return true;
    }
    else if (preg_match("#&\#x([0-9a-f]+);#i", $contents))
    {
        return true;
    }
    elseif (preg_match('#&\#([0-9]+);#i', $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\`\'\"]*)script:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\`\'\"]*)javascript:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\'\"]*)vbscript:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*expression\([^>]*>#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*behaviour\([^>]*>#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#</*(applet|link|style|script|iframe|frame|frameset|html|body|title|div|p|form)[^>]*>#i", $contents))
    {
        return true;
    }
    else
    {
        return false;
    }
}


$evil = "'; Dumm -- trotzdem geschafft <p></p>";
$friendly = "Ich bin doch nur Text";

if is_clean_file($evil) {
echo "Böse";
$evil = "";
}
if is_clean_file($friendly) {
echo "Böse";
$friendly = "";
}

echo $evil;
echo $friendly;
?>