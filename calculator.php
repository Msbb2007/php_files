<?php
$result = null;
$error = null;
$expression = $_POST['display'] ?? '';

$expression = trim($expression);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = 'لطفاً از صفحه اصلی ماشین حساب وارد شوید.';
} elseif ($expression === '') {
    $error = 'لطفاً یک عبارت وارد کنید.';
} else{
    preg_match_all('/\d+(?:\.\d+)?|[+\-*\/]/', $expression, $array);
    $endNumber = end($array[0]);
    $firstNumber = array_shift($array[0]);
    

    if(!is_numeric($endNumber)){
        $error='عبارت باید با عدد تمام شود';
    }elseif(!is_numeric($firstNumber)){
        $error='عبارت نباید با عملگر شروع شود';
    }else{
        $numbers = [];
        $operators = [];

        $numbers[] = (float) $firstNumber;

        while (!empty($array[0])) {
            $operator = array_shift($array[0]);
            $number = array_shift($array[0]);

            if (!is_numeric($number)) {
                $error = 'بعد از هر عملگر باید عدد قرار بگیرد.';
                break;
            }
            if ($operator === '/' && (float) $number == 0.0) {
                $error = 'تقسیم بر صفر مجاز نیست.';
                break;
            }

            $operators[] = $operator;
            $numbers[] = (float) $number;
        }

        if ($error === null) {
            $index = 0;

            while ($index < count($operators)) {
                if ($operators[$index] === '*' || $operators[$index] === '/') {
                    $firstNumber = $numbers[$index];
                    $secondNumber = $numbers[$index + 1];

                    if ($operators[$index] === '*') {
                        $numbers[$index] = $firstNumber * $secondNumber;
                    } else {
                        $numbers[$index] = $firstNumber / $secondNumber;
                    }

                    array_splice($numbers, $index + 1, 1);
                    array_splice($operators, $index, 1);
                } else {
                    $index++;
                }
            }

            $result = $numbers[0];

            for ($index = 0; $index < count($operators); $index++) {
                if ($operators[$index] === '+') {
                    $result += $numbers[$index + 1];
                } else {
                    $result -= $numbers[$index + 1];
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتیجه محاسبه</title>
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body>
<div class="calculator-grid">
    <h1>نتیجه محاسبه</h1>

    <?php if ($error !== null): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php else: ?>
        <div class="result">
        <p>عبارت: <strong dir="ltr" style="display: inline-block;"><?= htmlspecialchars($expression) ?></strong></p>
            <p>نتیجه: <strong><?= htmlspecialchars((string) $result) ?></strong></p>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <input type="hidden" name="display" value="<?= htmlspecialchars($expression) ?>">
        <button type="submit" class="back-button">برگشت</button>
    </form>
</div>
</body>
</html>