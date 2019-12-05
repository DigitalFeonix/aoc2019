<?php

$input_contents = file_get_contents('input');
$program = explode(",", trim($input_contents));

function run_program(array $program)
{
    // opcodes
    // 01 = adds
    // 02 = multiply
    // 03 = input
    // 04 = output
    // 05 = jump-if-true
    // 06 = jump-if-false
    // 07 = less than
    // 08 = equals
    // 99 = halt

    // number of params per opcode
    $params = [ 0, 3, 3, 1, 1, 2, 2, 3, 3 ];

    // run the program
    for ($i = 0; $i < count($program); $i++)
    {
        $opcode = $program[ $i ] % 100;

        // immediate halt
        if ($opcode == 99)
        {
            break;
        }

        // parameter count
        $p_count = $params[ $opcode ];
        $increment = TRUE;

        // get the modes for each (potential) parameter
        $p1_mode = floor( $program[ $i ] / 100 ) % 10;
        $p2_mode = floor( $program[ $i ] / 1000 ) % 10;
        $p3_mode = floor( $program[ $i ] / 10000 ) % 10;

        // parameters
        if ($p_count > 0) { $p1 = $program[ $i+1 ]; }
        if ($p_count > 1) { $p2 = $program[ $i+2 ]; }
        if ($p_count > 2) { $p3 = $program[ $i+3 ]; }

        // values
        if ($p_count > 0) { $v1 = ($p1_mode == 1) ? $p1 : $program[ $p1 ]; }
        if ($p_count > 1) { $v2 = ($p2_mode == 1) ? $p2 : $program[ $p2 ]; }

        switch ($opcode)
        {
            // addition
            case 1:
                $program[ $p3 ] = $v1 + $v2;
                break;

            // multiply
            case 2:
                $program[ $p3 ] = $v1 * $v2;
                break;

            // input
            case 3:

                // request input from user
                echo 'Input: ';
                $handle = fopen ('php://stdin', 'r');
                $input  = fgets($handle);
                echo "\n";
                fclose($handle);

                // cast to INT
                $program[ $p1 ] = (int) trim($input);
                break;

            // output
            case 4:
                echo $v1, "\n";
                break;

            // jump if true
            case 5:
                if ($v1 != 0)
                {
                    $i = $v2 - 1; // -1 to counter the $i++ of the loop
                    $increment = FALSE;
                }
                break;

            // jump if false
            case 6:
                if ($v1 == 0)
                {
                    $i = $v2 - 1; // -1 to counter the $i++ of the loop
                    $increment = FALSE;
                }
                break;

            // less than
            case 7:
                $program[ $p3 ] = ($v1 < $v2) ? 1 : 0;
                break;

            // equals
            case 8:
                $program[ $p3 ] = ($v1 == $v2) ? 1 : 0;
                break;

            default:
                error_log("Fatal Error: Unknown opcode: {$opcode}");
                exit(1);
                break;
        }

        // increment $i number of params
        if ($increment) { $i += $p_count; }
    }
}

run_program($program);
