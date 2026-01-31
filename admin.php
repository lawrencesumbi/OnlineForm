<?php
require 'db.php';

$sql = "SELECT 
            id,
            sss_number,
            name,
            name_dob,
            sex,
            civil_status,
            nationality,
            mobile_number,
            email_address
        FROM personal_data
        ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <div class="exit-div">
        <a href="landing.php"><button type="button">X</button></a>
    </div>

<div class="bondpaper">
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>SSS Number</th>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>Sex</th>
        <th>Civil Status</th>
        <th>Nationality</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php if (count($rows) > 0): ?>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['sss_number']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['name_dob']) ?></td>
                <td><?= htmlspecialchars($row['sex']) ?></td>
                <td><?= htmlspecialchars($row['civil_status']) ?></td>
                <td><?= htmlspecialchars($row['nationality']) ?></td>
                <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                <td><?= htmlspecialchars($row['email_address']) ?></td> 
                <td>
                    <a href="index.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this record?');">
                       Delete
                    </a> |



                    
                    <form action="other.php" method="post">
                        <input type="text" name="sss_number" id="sss_number" placeholder="SSS Number to Filter" required>
                    </form>






                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" style="text-align:center;">No records found</td>
        </tr>
    <?php endif; ?>
    </table>
</div>

<style>
body{background-color: rgb(218, 218, 218); width: 1400px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.bondpaper{width: 1400px; height: auto; background-color: white;}
.margin-div{border: 3px solid black; margin-left: 20px; margin-right: 20px;}
table {border-collapse: collapse; width: 100%;}
th, td { border: 1px solid black; padding: 10px; text-align: left;}
th {background-color: #f2f2f2;}
.exit-div{width: 1400px; height: auto; background-color: blue; text-align: right;}
td input{width: 130px;}

</style>

<script>
const sssInput = document.getElementById('sss_number');
sssInput.addEventListener('input', function (e) {
    let value = this.value;
    value = value.replace(/\D/g, '');
    if (value.length > 2) {
        value = value.slice(0, 2) + '-' + value.slice(2);
    }
    if (value.length > 10) {
        value = value.slice(0, 10) + '-' + value.slice(10, 11);
    }
    value = value.slice(0, 13);
    this.value = value;
});
</script>

</body>
</html>