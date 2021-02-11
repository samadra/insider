<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['awayTeamName', 'homeTeamName'];

    public static function newMatch()
    {
        $old_match = self::get_old_match();
        do {
            $a = rand(1, 4);
            do {
                $b = rand(1, 4);
            } while ($a === $b);

            $rand[] = $a . '-' . $b;

        } while (in_array($rand, $old_match));

        $num = [1, 2, 3, 4];
        if (($key = array_search($a, $num)) !== false) {
            unset($num[$key]);
        }
        if (($key = array_search($b, $num)) !== false) {
            unset($num[$key]);
        }
        $second_match = array_values($num)[0] . '-' . array_values($num)[1];
        if (in_array($second_match, $old_match)) $second_match = array_values($num)[1] . '-' . array_values($num)[0];
        $rand[] = $second_match;
        return $rand;
    }

    public static function tableByWeek($week)
    {
        return DB::select("
                SELECT NAME AS Club,
                    SUM(played) AS played,
                    SUM(won) AS won,
                    SUM(drawn) AS drawn,
                    SUM(lost) AS lost,
                    SUM(goals_for) AS goals_for,
                    SUM(goals_against) AS goals_against,
                    SUM(goals_diffrent) AS goals_diffrent,
                    SUM(points) AS points
                FROM
                    (
                    SELECT
                        home_team Team,
                        1 played,
                        IF(home_score > away_score, 1, 0) won,
                        IF(home_score = away_score, 1, 0) drawn,
                        IF(home_score < away_score, 1, 0) lost,
                        home_score goals_for,
                        away_score goals_against,
                        home_score - away_score goals_diffrent,
                        CASE WHEN home_score > away_score THEN 3 WHEN home_score = away_score THEN 1 ELSE 0 END points
                FROM games WHERE week <= $week
                UNION ALL
                SELECT
                    away_team,
                    1,
                    IF(home_score < away_score, 1, 0),
                    IF(home_score = away_score, 1, 0),
                    IF(home_score > away_score, 1, 0),
                    away_score,
                    home_score,
                    away_score - home_score goals_diffrent,
                    CASE WHEN home_score < away_score THEN 3 WHEN home_score = away_score THEN 1 ELSE 0 END
                FROM games  WHERE week <= $week
                ) AS tot JOIN teams t ON tot.Team = t.id
                GROUP BY Team
                ORDER BY SUM(points) DESC
            ");
    }

    public static function get_old_match()
    {
        return Game::select(DB::raw("CONCAT(home_team,'-',away_team) AS name"), 'id')
            ->pluck('name', 'id')->toArray();
    }

    public function home()
    {
        return $this->belongsTo(Team::class, 'home_team', 'id');
    }

    public function away()
    {
        return $this->belongsTo(Team::class, 'away_team', 'id');
    }

    public function getHomeTeamNameAttribute()
    {
        return ucfirst($this->home->name);
    }

    public function getAwayTeamNameAttribute()
    {
        return ucfirst($this->away->name);
    }
}
