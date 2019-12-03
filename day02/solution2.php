<?php

$input_contents = file_get_contents('input');
$inputs = explode(",", trim($input_contents));

$expected_output = 19690720;

// opcodes
//  1 = adds
//  2 = mult
// 99 = halt

// initialize what we are searching for
$noun = 0;
$verb = 0;

$solved = FALSE;

while (!$solved)
{
    // reset memory
    $memory = $inputs;

    // set inputs
    $memory[1] = $noun;
    $memory[2] = $verb;

    // increment for next attempt
    $verb = ($verb + 1) % 100;

    if ($verb == 0)
    {
        $noun++;
    }

    // run the program
    for ($i = 0; $i < count($memory); $i += 4)
    {
        $opcode = $memory[ $i ];

        // halt opcode
        if ($opcode == 99)
        {
            break;
        }

        $p1 = $memory[ $i+1 ];
        $p2 = $memory[ $i+2 ];
        $p3 = $memory[ $i+3 ];

        $v1 = $memory[ $p1 ];
        $v2 = $memory[ $p2 ];

        switch ($opcode)
        {
            // addition
            case 1:
                $memory[ $p3 ] = $v1 + $v2;
                break;
            // multiply
            case 2:
                $memory[ $p3 ] = $v1 * $v2;
                break;
            default:
                error_log('Fatal Error: Unknown opcode');
                exit(1);
                break;
        }
    }

    if ($memory[0] == $expected_output)
    {
        $solved = TRUE;
    }
}

$noun_verb = 100 * $memory[1] + $memory[2];

echo "Output => {$noun_verb}", "\n";
