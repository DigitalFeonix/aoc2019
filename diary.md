# Challenge Diary

Same as last year, I started a few days late and I don't start the challenges right as they are released. I am only
trying to solve them before I go to bed, not speed run them. I'm not trying for Top 100. If I make it to Top 1000 for a
challenge part I'm happy, Top 500 I'm estatic.


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

## Day 4 - "Secure Container"

Part one was simple enough. Use a `preg_match()` with back references to check for the adjacent digits, then loop through
to check if the digits are incrementing. Part two was just updating the `preg_match()` to a `preg_match_all()` and adding
a `+` after the backref to capture all the groups of matching numbers. The hard part is often correctly interpreting the
subtly of the puzzle text with the example. And here is another time that has gotten me. I first thought that ANY group
has to be multiples of 2. So, a group lenght of 2 or 4 would work while 3 would not. However, it really meant that there
had to be at least one group of length 2. Additional groups could any length. Sigh, fixing that I wondered why my new
answer was higher than part one, silly me keep the test input in when running. Go back to real input and solved.

Rankings
 - Part 1 => 3233
 - Part 2 => 2913

## Day 5 - "Sunny with a Chance of Asteroids"

Back with the opcode machine. Six new instructions, parameter modes, plus instruction jumping. As always it is the fine
print that can get you. At this point I just may refactor it to a proper `while()` loop inside the function.

Rankings
 - Part 1 => 1734
 - Part 2 => 1483

