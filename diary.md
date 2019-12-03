# Challenge Diary

Same as last year, I started a few days late.


## Day 1 - "The Tyranny of the Rocket Equation"

Simple puzzle. The only thing that tripped me up for a second was the timing of calculating the additional fuel. I first
thought to do it after the calculating the fuel for the entire ship/system and then realized that it needed to be done
per module.

Rankings
 - Part 1 => 49933
 - Part 2 => 43966


## Day 2 - "1202 Program Alarm"

Surprised they went to an opcode puzzle so early this year. Really basic for a first one though, and probably the base
that we will expand upon later. The core logic was different enough for part 2 that I split it out to another script
instead of refactoring. That is always the issue with AOC puzzles.

Rankings
 - Part 1 => 30811
 - Part 2 => 27218


## Day 3 - "Crossed Wires"

Woah, return of the vector (game) math already. I thought about how I wanted to solve this. It came down to wanting to
compare each segment of the wires. So, one nested loop later and I could compare each segment of the first wire with all
of the segments of the second wire. Then I had to figure out HOW to do the comparison. So, I googled for the game dev
solution for finding where two lines intersect. I found [this stackoverflow article](stackoverflow-563198). Translate
the C into a PHP function (and to take a simple Point class) and boom! Second part just added steps to the Point->add()
method, then figuring the total steps each wire took.

[stackoverflow-563198]: https://stackoverflow.com/questions/563198/how-do-you-detect-where-two-line-segments-intersect

Rankings
 - Part 1 => 2478
 - Part 2 => 2252

