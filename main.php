<?php
session_start();

$labyrinthes = [
    [
        [1, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 1, 0, 1],
        [1, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 0, 0, 0, 1],
        [1, 0, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 0, 1],
        [1, 0, 0, 0, 1, 0, 1],
        [1, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 1, 1],
    ],
    [
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 1, 0, 0, 0, 0, 1],
        [1, 0, 1, 0, 1, 0, 1, 1, 0, 1],
        [1, 0, 1, 0, 0, 0, 1, 0, 0, 1],
        [1, 0, 1, 1, 1, 0, 1, 0, 1, 1],
        [1, 0, 0, 0, 1, 0, 1, 0, 1, 1],
        [1, 1, 1, 0, 1, 0, 0, 0, 1, 1],
        [1, 0, 0, 0, 0, 1, 1, 0, 0, 1],
        [1, 0, 1, 1, 0, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
    ],
    [
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 1],
        [1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1],
        [1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1],
        [1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1],
        [1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1],
        [1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 0, 1],
        [1, 0, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1],
        [1, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1],
        [1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1],
        [1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1],
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
    ],
    [
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1],
        [1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1],
        [1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1],
        [1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 0, 1, 0, 1],
        [1, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1],
        [1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 1],
        [1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1],
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
    ]
];

if (!isset($_SESSION['labyrintheIndex'])) {
    $_SESSION['labyrintheIndex'] = 0;
}
$labyrintheIndex = &$_SESSION['labyrintheIndex'];

if (!isset($_SESSION['positionJoueur'])) {
    $_SESSION['positionJoueur'] = ['x' => 1, 'y' => 9];
}
$positionJoueur = &$_SESSION['positionJoueur'];

if (!isset($_SESSION['positionSouris'])) {
    $_SESSION['positionSouris'] = ['x' => 5, 'y' => 1];
}
$positionSouris = &$_SESSION['positionSouris'];

if (!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}
$score = &$_SESSION['score'];

function afficherLabyrinthe($labyrinthe, $positionJoueur, $positionSouris, $score){
    $message="";
    
    if ($positionJoueur == $positionSouris) {
        $_SESSION['positionJoueur'] = $positionJoueur = ['x' => 1, 'y' => 9];
        $_SESSION['positionSouris'] = $positionSouris = ['x' => 5, 'y' => 1];
        $_SESSION['score'] = 0;
        $message = "Bravo vous avez trouvé la souris";
        $score++;
        sourisRandom($labyrinthe,$positionJoueur);
    } 

    $visibilityRange = 1;
    echo '<table>';
    foreach ($labyrinthe as $y => $ligne) {
        echo '<tr>';
        foreach ($ligne as $x => $cellule) {
            $isPlayer = $positionJoueur['x'] == $x && $positionJoueur['y'] == $y;
            $isSouris = $positionSouris['x'] == $x && $positionSouris['y'] == $y;
            $isVisible = abs($x - $positionJoueur['x']) <= $visibilityRange && abs($y - $positionJoueur['y']) <= $visibilityRange;

            if ($isPlayer) {
                echo '<td class="joueur"></td>';
            } elseif ($isSouris && $isVisible) {
                echo '<td class="souris"></td>';
            } elseif (!$isVisible) {
                echo '<td class="fog"></td>';
            } else {
                if ($cellule == 1) {
                    echo '<td class="mur"></td>';
                } else {
                    echo '<td class="chemin"></td>';
                }
            }
        }
        echo '</tr>';
    }
    echo '</table>';
    
    return [$message,$score];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    switch ($_POST['direction']) {
        case 'up':
            if ($labyrinthes[$labyrintheIndex][$positionJoueur['y'] - 1][$positionJoueur['x']] == 0) {
                $positionJoueur['y']--;
            }
            break;
        case 'down':
            if ($labyrinthes[$labyrintheIndex][$positionJoueur['y'] + 1][$positionJoueur['x']] == 0) {
                $positionJoueur['y']++;
            }
            break;
        case 'left':
            if ($labyrinthes[$labyrintheIndex][$positionJoueur['y']][$positionJoueur['x'] - 1] == 0) {
                $positionJoueur['x']--;
            }
            break;
        case 'right':
            if ($labyrinthes[$labyrintheIndex][$positionJoueur['y']][$positionJoueur['x'] + 1] == 0) {
                $positionJoueur['x']++;
            }
            break;
    }

    
    if ($positionJoueur['x'] == $positionSouris['x'] && $positionJoueur['y'] == $positionSouris['y']) {
       
        $nouveauLabyrintheIndex = rand(0, count($labyrinthes) - 1);
        while ($nouveauLabyrintheIndex == $labyrintheIndex) {
            $nouveauLabyrintheIndex = rand(0, count($labyrinthes) - 1);
        }
        $labyrintheIndex = $nouveauLabyrintheIndex;

       
}}

function sourisRandom ($labyrinthe,$positionJoueur){
    $positionsDisponibles = [];
    foreach ($labyrinthe as $y => $ligne) {
        foreach ($ligne as $x => $cellule) {
            if ($cellule == 0 && ($x != $positionJoueur['x'] || $y != $positionJoueur['y'])) {
                $positionsDisponibles[] = ['x' => $x, 'y' => $y];
            }
        }
    }

    if (!empty($positionsDisponibles)) {
        $nouvellePositionSouris = $positionsDisponibles[array_rand($positionsDisponibles)];
        $_SESSION['positionSouris'] = $positionSouris = $nouvellePositionSouris;
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labyrinthe</title>
</head>

<body>
    <div class="container">
        <?php
        [$message,$score] = afficherLabyrinthe($labyrinthes[$labyrintheIndex], $positionJoueur, $positionSouris, $score);
        ?>
    </div>
    <p id="message"><?= $message ?></p>
    <p id="score"><?= "Score : $score" ?></p>

    <form id="move-form" method="post">
        <button type="submit" id="up" name="direction" value="up">Up</button>
        <div class="middle-row">
            <button type="submit" id="left" name="direction" value="left">Left</button>
            <button type="submit" id="reset" name="reset" value="reset">Reset</button>
            <button type="submit" id="right" name="direction" value="right">Right</button>
        </div>
        <button type="submit" id="down" name="direction" value="down">Down</button>
    </form>

    <script src="./assets/js/main.js"></script>
</body>

</html>
