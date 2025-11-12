<?php
session_start();
header('Cache-Control: no-store, must-revalidate');

if (!isset($_SESSION['board'])) startGame();

function startGame() {
    $_SESSION['board'] = array_fill(0, 4, array_fill(0, 4, 0));
    $_SESSION['score'] = 0;
    $_SESSION['gameover'] = false;
    addRandomTile();
}

function addRandomTile() {
    $empty = [];
    for ($i=0;$i<4;$i++){
        for ($j=0;$j<4;$j++){
            if ($_SESSION['board'][$i][$j] == 0) $empty[] = [$i,$j];
        }
    }
    if (count($empty) === 0) return;
    $p = $empty[array_rand($empty)];
    $_SESSION['board'][$p[0]][$p[1]] = (rand(0,9) < 9) ? 2 : 4;
}

function rotateLeft($m) {
    $r = array_fill(0,4, array_fill(0,4,0));
    for ($i=0;$i<4;$i++){
        for ($j=0;$j<4;$j++){
            $r[3-$j][$i] = $m[$i][$j];
        }
    }
    return $r;
}

function rotateRight($m) {
    return rotateLeft(rotateLeft(rotateLeft($m)));
}

function moveLeftAndMerge($board, &$scoreInc) {
    $scoreInc = 0;
    for ($i=0;$i<4;$i++){
        $newRow = array_values(array_filter($board[$i], function($v){ return $v != 0; }));
        for ($j=0;$j<count($newRow)-1;$j++){
            if ($newRow[$j] === $newRow[$j+1]) {
                $newRow[$j] *= 2;
                $scoreInc += $newRow[$j];
                $newRow[$j+1] = 0;
                $j++;
            }
        }
        $newRow = array_values(array_filter($newRow, function($v){ return $v != 0; }));
        while (count($newRow) < 4) $newRow[] = 0;
        $board[$i] = $newRow;
    }
    return $board;
}

function boardsEqual($a, $b) {
    for ($i=0;$i<4;$i++) for ($j=0;$j<4;$j++) if ($a[$i][$j] !== $b[$i][$j]) return false;
    return true;
}

function isGameOverBoard($b) {
    for ($i=0;$i<4;$i++){
        for ($j=0;$j<4;$j++){
            if ($b[$i][$j] == 0) return false;
            if ($j < 3 && $b[$i][$j] == $b[$i][$j+1]) return false;
            if ($i < 3 && $b[$i][$j] == $b[$i+1][$j]) return false;
        }
    }
    return true;
}

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (isset($_GET['move'])) {
    $dir = $_GET['move'];
    $dir = strtolower($dir);
    $boardBefore = $_SESSION['board'];
    $scoreInc = 0;

    $b = $boardBefore;
    if ($dir === 'up') $b = rotateLeft($b);
    elseif ($dir === 'right') { $b = rotateLeft(rotateLeft($b)); }
    elseif ($dir === 'down') { $b = rotateRight($b); } // or rotateLeft 3x

    $bAfter = moveLeftAndMerge($b, $scoreInc);

    if ($dir === 'up') {
        $bAfter = rotateRight($bAfter);
    } elseif ($dir === 'right') {
        $bAfter = rotateLeft(rotateLeft($bAfter));
    } elseif ($dir === 'down') {
        $bAfter = rotateLeft($bAfter); 
    }

    $moved = !boardsEqual($boardBefore, $bAfter);

    if ($moved) {
        $_SESSION['board'] = $bAfter;
        $_SESSION['score'] += $scoreInc;
        addRandomTile();
    }

    $_SESSION['gameover'] = isGameOverBoard($_SESSION['board']);

    header('Content-Type: application/json');
    echo json_encode([
        'board' => $_SESSION['board'],
        'score' => $_SESSION['score'],
        'gameover' => $_SESSION['gameover'],
        'moved' => $moved,
        'scoreAdded' => $scoreInc
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>2048</title>
</head>
<body>
<h1>2048</h1>
<div id="score">Pontuação: <?= $_SESSION['score'] ?></div>
<div id="board"></div>
<button onclick="resetGame()">Reiniciar</button>

<script src="script.js"></script>
<script>
const initial = <?= json_encode($_SESSION['board']); ?>;
render(initial, <?= json_encode($_SESSION['score']); ?>);
</script>
</body>
</html>
