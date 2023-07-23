<?php
function sloanes_oeis($number) {
    if ($number <= 0) {
        return "Input harus lebih besar dari 0.";
    }

    // membuat variabel array deret untuk menampung hasil deret
    $deret = array();
    // menginisialisasikan variabel yang akan menampung nilai dari setiap perulangan
    $current = 1;

    for ($i = 1; $i <= $number; $i++) {
        // variabel current yang menampung nilai dari setiap perulangan akan disimpan ke dalam array deret 
        $deret[] = $current;

        // dalam setiap perulangan nilai dari variabel current akan dijumlahkan dengan nilai perulangan yang terjadi secara sekuensial  
        $current += $i;
    }

    // mengembalikan array deret dalam bentuk string
    return implode('-', $deret);
}

if (isset($_POST["number"])) {
    $number = (int)$_POST["number"];
    $output = sloanes_oeis($number);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>A000124 of Sloane's OESIS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="form_section" >
        <div class="container">
            <form method="POST" action="" class="form_regist">
                <h4 class="mb-3">A000124 of Sloane's OESIS</h4>
                <div class="mb-3 form-floating">
                    <input type="number" name="number" id="number" class="form-control" placeholder="number" value="<?= $number ?? "" ?>" required>
                    <label for="number">Number of Sequence</label>
                </div>
                <input type="submit" class="btn btn-primary">Submit</input>
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