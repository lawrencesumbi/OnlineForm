<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    
    <div class="main">
        <div class="title-con"> 
            <h2>Welcome to</h2>
            <h1>SSS Online Form Registration</h1>
            <h3>"Submit and manage your SSS personal records quickly and securely."</h3>
        </div>
        <div class="buttons-con">
            <form action="user.php" method="post">
                <input type="text" name="sss_number" placeholder="Enter your SSS Number to Login" required>
            </form>
            <h3>or</h3>
            <form action="index.php" method="get">
                <button type="submit">Register Now</button>
            </form>
            <h3>or</h3>
            <form action="admin.php" method="get">
                <button type="submit">Log in as Admin</button>
            </form>
        </div>        
    </div>

<style>
html, body{margin: 0; width: 100%; height: 100%; overflow: hidden; font-family: 'Inter', sans-serif;}
.main{position: relative; width: 100vw; height: 100vh; overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: #ffffff; background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/landingPhoto.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;}
.title-con{width: 900px; margin-bottom: 20px; padding: 0 20px;}
.title-con h2{font-size: 30px; font-weight: 400; opacity: 0.9;}
.title-con h1{font-size: 60px; font-weight: 700; margin: 20px 0; font-family: 'Poppins', sans-serif; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);}
.title-con h3{font-size: 20px; font-weight: 400; opacity: 0.9; margin-top: 25px;}
.buttons-con {display: flex; gap: 12px; margin-top: 10px;}
.buttons-con input {padding: 14px 16px; font-size: 15px; border: none; width: 220px; height: 15px; border-radius: 6px;}
.buttons-con button {padding: 12px 16px; font-size: 16px; border: none; border-radius: 6px; background-color: #1e94d8; color: #fff; cursor: pointer; font-weight: 600; transition: background 0.3s ease;}
.buttons-con button:hover {background-color: #0d6de3;}
</style>

</body>
</html>