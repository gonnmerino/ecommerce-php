<?php
function h($string) {
    return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
}
?>