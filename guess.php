<?php
session_start();


if (!isset($_SESSION['randomNumber'])) {
    $_SESSION['randomNumber'] = rand(1, 100); 
    $_SESSION['attempts'] = 0; 
}


$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userGuess = (int)$_POST['guess']; 
    $_SESSION['attempts']++; 


    if ($userGuess < $_SESSION['randomNumber']) {
        $message = "Too low! Try again.";
    } elseif ($userGuess > $_SESSION['randomNumber']) {
        $message = "Too high! Try again.";
    } else {
        $message = "Congratulations! You guessed it in " . $_SESSION['attempts'] . " attempts.";
        unset($_SESSION['randomNumber']); 
        unset($_SESSION['attempts']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            text-align: center;
        }
        .game-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="game-container">
    <h1>Guess the Number!</h1>
    <p>I’m thinking of a number between 1 and 100. Can you guess it?</p>

    <form method="POST">
        <input type="number" name="guess" placeholder="Enter your guess" required min="1" max="100">
        <br>
        <button type="submit">Guess</button>
    </form>

    <?php if (!empty($message)): ?>
        <p style="margin-top: 20px; font-size: 18px; color: #007BFF;"><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <?php if (empty($_SESSION['randomNumber'])): ?>
        <a href="guess.php"><button>Play Again</button></a>
    <?php endif; ?>
</div>
</body>
</html>
