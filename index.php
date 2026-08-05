<?php
$currentValue = $_POST['display'] ?? '';

if (isset($_POST['btn'])) {
    $btnValue = $_POST['btn'];

    if ($btnValue === 'C') {
        $currentValue = '';
    } elseif ($btnValue === '⌫') {
        $currentValue = substr($currentValue, 0, -1);
    } else {
        $currentValue .= $btnValue;
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ماشین حساب PHP</title>
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body>
<div class="calculator-grid">
    <h1>ماشین حساب</h1>

    <form action="index.php" method="POST">
        <input
            type="text"
            name="display"
            id="display"
            value="<?= htmlspecialchars($currentValue) ?>"
            readonly
            placeholder="0"
        >

        <div class="buttons">
            <button type="submit" name="btn" value="C" class="btn clear">C</button>
            <button type="submit" name="btn" value="/" class="btn operator">/</button>
            <button type="submit" name="btn" value="*" class="btn operator">×</button>
            <button type="submit" name="btn" value="⌫" class="btn operator">⌫</button>

            <button type="submit" name="btn" value="7" class="btn">7</button>
            <button type="submit" name="btn" value="8" class="btn">8</button>
            <button type="submit" name="btn" value="9" class="btn">9</button>
            <button type="submit" name="btn" value="-" class="btn operator">-</button>

            <button type="submit" name="btn" value="4" class="btn">4</button>
            <button type="submit" name="btn" value="5" class="btn">5</button>
            <button type="submit" name="btn" value="6" class="btn">6</button>
            <button type="submit" name="btn" value="+" class="btn operator">+</button>

            <button type="submit" name="btn" value="1" class="btn">1</button>
            <button type="submit" name="btn" value="2" class="btn">2</button>
            <button type="submit" name="btn" value="3" class="btn">3</button>

            <button type="submit" formaction="calculator.php" class="btn equal">=</button>

            <button type="submit" name="btn" value="0" class="btn zero">0</button>
            <button type="submit" name="btn" value="." class="btn">.</button>
        </div>
    </form>
</div>
</body>
</html>
