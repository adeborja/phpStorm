<?php
/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 25/04/19
 * Time: 10:13
 */
$mystr = "ASCII is an easy way for computers to work with strings\n";

if (ord($mystr{1}) == 83) {
    print "The second letter in the string is S\n";
} else {
    print "The second letter is not S\n";
}

$letter = chr(109);

print "ASCII number 109 is equivalent to $letter\n";