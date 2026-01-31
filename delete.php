<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = (int) $_GET['id'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("DELETE FROM dependents WHERE personal_data_id = :id");
    $stmt->execute([':id' => $id]);

    $stmt = $pdo->prepare("DELETE FROM work WHERE personal_data_id = :id");
    $stmt->execute([':id' => $id]);

    $stmt = $pdo->prepare("DELETE FROM certification WHERE personal_data_id = :id");
    $stmt->execute([':id' => $id]);

    $stmt = $pdo->prepare("DELETE FROM filled_sss WHERE personal_data_id = :id");
    $stmt->execute([':id' => $id]);

    $stmt = $pdo->prepare("DELETE FROM personal_data WHERE id = :id");
    $stmt->execute([':id' => $id]);

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
    die("Delete failed: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Successfully</title>
</head>
<body>
    <div class="inner-con">
        <div class="check-icon">
            <img src="img/greencheck.png" alt="check-icon">
        </div>
        <div class="suctext-div">
            <h1>Deleted Successfully!</h1>
            <p>We have deleted your information. Thank you.</p>
        </div>
        <div class="back-div">
            <a href="landing.php"><button type="button">OK</button></a>
        </div>
    </div>

<style>
body{background-color: rgb(218, 218, 218); width: 1180px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.inner-con{width: 590px; margin: 0 auto; height: auto; background-color: white; padding-top: 30px; padding-bottom: 30px; border-radius: 10px;}
.check-icon{text-align: center;}
.check-icon img{height: 100px; width: 100px;}
.suctext-div{text-align: center;}
.back-div{text-align: center;}
</style>

</body>
</html>

