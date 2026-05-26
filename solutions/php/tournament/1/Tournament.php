<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Tournament
{
    private int $win = 3;
    private int $loss = 0;
    private int $draw = 1;
    
    public function __construct()
    {
        // throw new \BadFunctionCallException("Please implement the Tournament class!");
    }

    public function tally(string $scores)
    {
        $matches = !$scores ? [] : explode("\n", $scores);

        $table = "";
        $teamHeader = "Team                           ";
        $teamHeaderLength = strlen($teamHeader);
        $tableHeader = "{$teamHeader}| MP |  W |  D |  L |  P";

        $table .= $tableHeader;

        if (empty($matches)) {
            return $table;
        }

        $table .= "\n";

        $teamsStats = [];

        foreach ($matches as $index => $match) {
            [$teamHouse, $teamVisitor, $result] = explode(";", $match);
            
            if ($result === "win") {
                $pointsHouse = $this->win;
                $pointsVisitor = $this->loss;
            } else if ($result === "loss") {
                $pointsHouse = $this->loss;
                $pointsVisitor = $this->win;
            } else {
                $pointsHouse = $this->draw;
                $pointsVisitor = $this->draw;
            }

            $teamsStats[$teamHouse] = [
                "team" => $teamHouse,
                "mp" => 1 + ($teamsStats[$teamHouse]["mp"] ?? 0),
                "win" => ($pointsHouse === $this->win) + ($teamsStats[$teamHouse]["win"] ?? 0),
                "loss" => ($pointsHouse === $this->loss) + ($teamsStats[$teamHouse]["loss"] ?? 0),
                "draw" => ($pointsHouse === $this->draw) + ($teamsStats[$teamHouse]["draw"] ?? 0),
                "points" => $pointsHouse + ($teamsStats[$teamHouse]["points"] ?? 0)
            ];

            $teamsStats[$teamVisitor] = [
                "team" => $teamVisitor,
                "mp" => 1 + ($teamsStats[$teamVisitor]["mp"] ?? 0),
                "win" => ($pointsVisitor === $this->win) + ($teamsStats[$teamVisitor]["win"] ?? 0),
                "loss" => ($pointsVisitor === $this->loss) + ($teamsStats[$teamVisitor]["loss"] ?? 0),
                "draw" => ($pointsVisitor === $this->draw) + ($teamsStats[$teamVisitor]["draw"] ?? 0),
                "points" => $pointsVisitor + ($teamsStats[$teamVisitor]["points"] ?? 0)
            ];

        }
        
        array_multisort(array_column($teamsStats, 'points'), SORT_DESC, array_column($teamsStats, 'team'), SORT_ASC,$teamsStats);

        foreach ($teamsStats as $index => $team) {
            $teamName = str_pad($team['team'], $teamHeaderLength);
            $table .= "{$teamName}|  {$team['mp']} |  {$team['win']} |  {$team['draw']} |  {$team['loss']} |  {$team['points']}";

            if (array_key_last($teamsStats) !== $index) {
                $table .= "\n";
            }
        }

        return $table;
    }
}
