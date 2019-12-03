<?php

// remove E_WARNING since we will be dividing by ZERO a lot
error_reporting(E_ERROR | E_PARSE | E_NOTICE);

class Point
{
    public $x;
    public $y;

    public $steps;

    function __construct($x = 0, $y = 0, $steps = 0)
    {
        $this->x = $x;
        $this->y = $y;

        $this->steps = $steps;
    }

    public function add($x, $y, $steps)
    {
        return new Point($this->x + $x, $this->y + $y, $this->steps + $steps);
    }
}

function get_line_intersection(Point $p0, Point $p1, Point $p2, Point $p3)
{
    $s1 = new Point( $p1->x - $p0->x, $p1->y - $p0->y);
    $s2 = new Point( $p3->x - $p2->x, $p3->y - $p2->y);

    $s = ( -$s1->y * ($p0->x - $p2->x) + $s1->x * ($p0->y - $p2->y) ) / (-$s2->x * $s1->y + $s1->x * $s2->y);
    $t = (  $s2->x * ($p0->y - $p2->y) - $s2->y * ($p0->x - $p2->x) ) / (-$s2->x * $s1->y + $s1->x * $s2->y);

    if ($s >= 0 && $s <= 1 && $t >= 0 && $t <= 1)
    {
        // Collision detected
        return new Point( $p0->x + ($t * $s1->x), $p0->y + ($t * $s1->y) );
    }

    return FALSE;
}

function create_wire($node_array)
{
    $new_point = new Point(0,0);

    $wire = [ $new_point ];

    foreach ($node_array as $node)
    {
        $dir = substr($node,0,1);
        $amt = substr($node,1);

        switch ($dir)
        {
            case 'U': $x = 0; $y = $amt; break;
            case 'D': $x = 0; $y = -$amt; break;
            case 'L': $y = 0; $x = -$amt; break;
            case 'R': $y = 0; $x = $amt; break;
        }

        $new_point = $new_point->add($x, $y, $amt);

        $wire[] = $new_point;
    }

    return $wire;
}

$input_contents = file_get_contents('input');
$wires = explode("\n", trim($input_contents));

$nodes_1 = explode(',', $wires[0]);
$nodes_2 = explode(',', $wires[1]);

$origin = new Point(0,0);

$wire_one = create_wire($nodes_1);
$wire_two = create_wire($nodes_2);

$smallest_dist = PHP_INT_MAX;
$smallest_step = PHP_INT_MAX;

for ($i = 0; $i < count($wire_one) - 1; $i++)
{
    $p0 = $wire_one[$i];
    $p1 = $wire_one[$i+1];

    for ($j = 0; $j < count($wire_two) - 1; $j++)
    {
        $p2 = $wire_two[$j];
        $p3 = $wire_two[$j+1];

        if ( ($intersect = get_line_intersection($p0, $p1, $p2, $p3)) !== FALSE )
        {
            // skip 0,0 "intersection"
            if ($intersect->x == 0 && $intersect-> y == 0) { continue; }

            $dist = abs($intersect->x) + abs($intersect->y);
            $smallest_dist = min($smallest_dist, $dist);

            $steps  = $p0->steps + abs($p0->x - $intersect->x) + abs($p0->y - $intersect->y); // wire 1 steps
            $steps += $p2->steps + abs($p2->x - $intersect->x) + abs($p2->y - $intersect->y); // wire 2 steps
            $smallest_step = min($smallest_step, $steps);
        }
    }
}

echo "Smallest Distance => {$smallest_dist}", "\n";
echo "Smallest Steps => {$smallest_step}", "\n";
