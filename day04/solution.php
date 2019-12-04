<?php

// input range
$low  = 134792;
$high = 675810;

// match counter
$count = 0;

for ($i = $low; $i <= $high; $i++)
{
    // convert to string for good measure
    $str = sprintf('%06d', $i);

    // must have a matching adjacent digits
    if (!preg_match_all('/([0-9])\1+/', $str, $matches))
    {
        continue;
    }

    // must have at least one set of exactly 2 adjacent digits
    $has_pair = false;

    foreach ($matches[0] as $match)
    {
        if (strlen($match) == 2)
        {
            $has_pair = true;
            break;
        }
    }

    if (!$has_pair)
    {
        continue;
    }

    // must not decrease
    for ($c = 0; $c < 5; $c++)
    {
        if ($str[$c] > $str[$c+1])
        {
            continue 2;
        }
    }

    // if we made it this far, it is a viable combo
    $count++;
}

echo "Matches Rules => {$count}","\n";
