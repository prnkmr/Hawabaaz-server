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
<h4>Forget Password</h4>

<form action="forgetPassword.php" method="post">
    <input name="username" type="text" placeholder="username"/>
    <button type="submit">Forget</button>
</form>

<br/>
<h4>Place Order</h4>

<form action="placeOrder.php" method="post">
    <input name="userId" type="text" placeholder="username"/>
    <input name="orders" type="text" placeholder="orders json"/>
    <button type="submit">place order</button>
</form>
</body>
</html>