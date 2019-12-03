<?php

$input_contents = file_get_contents('input');
$inputs = explode(",", trim($input_contents));

// opcodes
//  1 = adds
//  2 = mult
// 99 = halt

// fix 1202 program alarm
$inputs[1] = 12;
$inputs[2] = 2;

// run the program
for ($i = 0; $i < count($inputs); $i += 4)
{
    $opcode = $inputs[ $i ];

    // halt opcode
    if ($opcode == 99)
    {
        break;
    }

    $p1 = $inputs[ $i+1 ];
    $p2 = $inputs[ $i+2 ];
    $p3 = $inputs[ $i+3 ];

    $v1 = $inputs[ $p1 ];
    $v2 = $inputs[ $p2 ];

    switch ($opcode)
    {
        // addition
        case 1:
            $inputs[ $p3 ] = $v1 + $v2;
            break;
        // multiply
        case 2:
            $inputs[ $p3 ] = $v1 * $v2;
            break;
        default:
            error_log('Fatal Error: Unknown opcode');
            exit(1);
            break;
    }
}

echo "Output => {$inputs[0]}", "\n";
