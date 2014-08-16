<?hh

class Auth {
  public static function login(
    string $username,
    string $password,
    bool $remember = false
  ): bool {
    $user = User::genByUsername($username);
    if ($user && password_verify($password, $user->getPassword())) {
      $month = time()+60*60*24*30;
      $_SESSION['user'] = $user->getUsername();
      if ($remember) {
        setcookie('id', hash('md5', $user->getUsername()), $month, '/');
      }
      return true;
    }
    return false;
  }

  public static function logout(): void {
    if (isset($_SESSION['user'])) {
      // Remove the user from the session
      unset($_SESSION['user']);
    }
    if (isset($_COOKIE['id'])) {
      // Clear the token in the database
      $user = User::genByToken($_COOKIE['id']);
      if ($user) {
        $user->setToken(null);
        $user->save();
        // Clear the user's cookie
        setcookie('id', null, -1, '/');
        unset($_COOKIE['id']);
      }
    }
  }

  public static function check(): bool {
    return isset($_SESSION['user']);
  }

  public static function validateSession(): void {
    if (isset($_SESSION['user'])) {
      // Session is active and a user is set
      return;
    } else if (isset($_COOKIE['id'])) {
      // A cookie exists but no user is set; load the user
      $user = User::genByToken($_COOKIE['id']);
      if ($user) {
        $_SESSION['user'] = $user->getUsername();
      }
    }
  }
}
