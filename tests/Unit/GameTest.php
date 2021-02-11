<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Game;

class GameTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNewMatch()
    {
        $test = true;
        $new = Game::newMatch();
        dd('samad');
        $old = Game::get_old_match();
        foreach ($new as $match){
            if (in_array($match, $old)) $test = false;
        }
        $test->assertTrue($test);
    }
}
