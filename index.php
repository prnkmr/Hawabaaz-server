<html>
<head>
Test Page    
</head>
<body>
<h4>Register</h4>

<form action="register.php" method="post">
    <input name="phone" type="text" placeholder="phone"/>
    <input name="email" type="text" placeholder="email"/>
    <input name="password" placeholder="password" type="text"/>
    <input name="rePassword" type="text" placeholder="repass"/>
    <button type="submit">Register</button>
</form>
<br/>
<h4>Login</h4>

<form action="login.php" method="post">
    <input name="username" type="text" placeholder="username"/>
    <input name="password" type="text" placeholder="password"/>
    <button type="submit">Login</button>
</form>

<br/>
<h4>Set password using otp</h4>

<form action="setPassword.php" method="post">
    <input name="userId" type="text" placeholder="userid"/>
    <input name="OTP" type="text" placeholder="OTP"/>
    <input name="password" type="text" placeholder="password"/>
    <input name="rePassword" type="text" placeholder="Retype"/>
    <button type="submit">Set password</button>
</form>
</body>
</html>