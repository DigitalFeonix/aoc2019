<?php

$input_contents = file_get_contents('input');
$inputs = explode("\n", trim($input_contents));

$total_fuel = 0;

foreach ($inputs as $input)
{
    $fuel = floor($input / 3) - 2;
    $total_fuel += $fuel;

    // Start part 02 - treat the additional fuel on a per module basis
    $add_mass = $fuel;

    do {

        $add_fuel = floor($add_mass / 3) - 2;

        // negative fuel should be treated as ZERO
        if ($add_fuel < 0) { $add_fuel = 0; }

        $total_fuel += $add_fuel;

        $add_mass = $add_fuel;


    } while ($add_fuel > 0);

}

echo "Total Fuel => {$total_fuel}", "\n";
