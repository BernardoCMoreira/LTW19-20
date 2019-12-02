    <br> 
    <div class=register>
    <form action="../actions/action_register.php" method="post">
        <label>
            Username: <input type="text" name="username" required>
            <span class="hint">Only lowercase, at least 3 characters</span>
        </label>
        <br>
        <label>
            Email: <input type="text" name="email" required>
            <span class="hint">Invalid email</span>
        </label>
        <br>
        <label>
            Password: <input type="password" name="password" required>
            <span class="hint">One uppercase, 1 symbol, 1 number, at least 8 characters</span>
        </label>
        <br>
        <label>
            Name: <input type="text" name="name">
        </label>
        <br>
        <br>
        <input type="submit">
    </form>
     </div>
 