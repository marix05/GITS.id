<?php
function dense_ranking($scores, $gits_scores) {
    // Memastikan bahwa data skor unik dengan nilai yang berbeda
    $scores = array_unique($scores);
    // Mengurutkan skor peserta dari nilai terbesar ke nilai terkecil
    rsort($scores);

    // Menghitung peringkat GITS berdasarkan skor yang didapatkan setelah permainan
    $gits_ranks = array();
    foreach ($gits_scores as $gits_score) {
        $rank = 1;

        // Mencari posisi yang sesuai berdasarkan nilai skor GITS dalam daftar skor unik
        foreach ($scores as $score) {
            // Apabila skor peserta GITS lebih besar dari skor peserta lain
            if ($gits_score >= $score) {
                break;
            }
            $rank++;
        }

        $gits_ranks[] = $rank;
    }
    
    return implode(' ', $gits_ranks);
}

if (isset($_POST['submit'])) {
    $total_players = $_POST["total_players"];
    $gits_players = $_POST["gits_players"];
    if (isset($_POST["scores"])) {
        $scores = $_POST["scores"];
    }
    if (isset($_POST["gits_scores"])) {
        $gits_scores = $_POST["gits_scores"];
    }
    $output = dense_ranking($scores, $gits_scores);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Denise Rangking</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="form_section" >
        <div class="container">
            <form method="POST" action="" class="form_regist">
                <h4 class="mb-3">Dense Rangking</h4>
                <div class="mb-3 form-floating">
                    <input type="number" name="total_players" id="total_players" class="form-control" placeholder="total_players" value="<?= $total_players ?? "" ?>" required>
                    <label for="total_players">Total Players</label>
                </div>
                <div class="mb-3" id="input-scores">
                    <?php if (isset($scores)): ?>
                        <p>Player Scores</p>
                        <?php foreach ($scores as $score): ?>
                            <input type="number" name="scores[]" class="form-control" value="<?= $score ?>" required>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" name="gits_players" id="gits_players" class="form-control" placeholder="gits_players" value="<?= $gits_players ?? "" ?>" required>
                    <label for="gits_players">Total Gits Players</label>
                </div>
                <div class="mb-3" id="input-gits-scores">
                    <?php if (isset($gits_scores)): ?>
                        <p>Gits Player Scores</p>
                        <?php foreach ($gits_scores as $gits_score): ?>
                            <input type="number" name="gits_scores[]" class="form-control" value="<?= $gits_score ?>" required>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <input type="submit" name="submit" class="btn btn-primary">
                <?php if (isset($output)): ?>
                    <div class="mt-3">
                        <textarea class="form-control" disabled><?= $output ?></textarea>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </section>
</body>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $("#total_players").on("change, keyup", function () {
                let target = $('#input-scores');
                let total_players = $(this).val();

                let content = '<p>Player Scores</p>';

                for (let i = 1; i <= total_players; i++) {
                    content += '<input type="number" name="scores[]" id="score' + i +'" class="form-control" placeholder="Player ' + i +' Score" required>';
                }
                
                target.html(content);
            });
            
            $("#gits_players").on("change, keyup", function () {
                let target = $('#input-gits-scores');
                let total_players = $(this).val();

                let content = '<p>Gits Player Scores</p>';

                for (let i = 1; i <= total_players; i++) {
                    content += '<input type="number" name="gits_scores[]" id="score' + i +'" class="form-control" placeholder="Gits Player ' + i +' Score" required>';
                }
                
                target.html(content);
            });
        });
    </script>
</html>