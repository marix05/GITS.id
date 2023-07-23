<?php
function isBalancedBracket($str) {
    $stack = [];

    // Mendefinisikan array asosiatif untuk tiap pasangan bracket
    $bracket_pairs = [
        ')' => '(', 
        ']' => '[', 
        '}' => '{'
    ];

    // Melakukan perulangan untuk mengakses tiap karakter dari string yang diinputkan
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        // Memeriksa apakah karakter saat ini termasuk bracket buka yang didefinisikan sebagai array values di $bracket_pairs
        if (in_array($char, array_values($bracket_pairs))) {
            // Jika ditemukan karakakter bracket buka, maka bracket buka akan di masukkan ke dalam stack
            array_push($stack, $char);
        } 
        // Memeriksa apakah karakter saat ini termasuk bracket tutup yang didefinisikan sebagai array key di $bracket_pairs
        elseif (array_key_exists($char, $bracket_pairs)) {
            // Memeriksa apakah stack kosong atau tidak. Jika tumpukan kosong atau karakter bracket tutup saat ini tidak memiliki pasangan maka string tidak seimbang
            // OR
            /* Mengecek apakah ketika kita menghapus puncak stack yang merupakan bracket buka 
            tidak sama atau sama dengan array values dari $bracket_pairs dengan array key karakter bracket tutup saat ini.
            Jika tidak sama, maka string tidak seimbang, karena bracket buka terhapus dengan bracket tutup yang tidak sesuai */
            if (empty($stack) || array_pop($stack) != $bracket_pairs[$char]) {
                return "NO";
            }
        }
    }

    // Apabila stack tidak kosong, artinya string tidak seimbang
    return empty($stack) ? "YES" : "NO";
}

if (isset($_POST['submit'])) {
    if (isset($_POST["bracket_str"])) {
        $bracket_str = $_POST["bracket_str"];
    }
    $output = isBalancedBracket($bracket_str);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Balanced Bracket</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="form_section" >
        <div class="container">
            <form method="POST" action="" class="form_regist">
                <h4 class="mb-3">Balanced Bracket</h4>
                <div class="mb-3 form-floating">
                    <input type="text" name="bracket_str" id="bracket_str" class="form-control" placeholder="bracket_str" value="<?= $bracket_str ?? "" ?>" required>
                    <label for="bracket_str">Bracket</label>
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
</html>