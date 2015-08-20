<?php 
session_start();

if ( isset($_POST['username']) && isset($_POST['password']) ) {
    $link = mysqli_connect('localhost','user101','ctf101user','ctf101') or die("Error " . mysqli_error($link)); 

	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
    $query = "SELECT type from ctf101_login where username='".$username."' and password=md5('".$password."')";
	
    $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link)); 
    while($row = mysqli_fetch_assoc($result)) {
        $type = $row["type"];
    }
    mysqli_close($link); 
}

if (isset($type)) {
    if ($type == "admin") {
        echo "You have logged in as an admin. Here your flag: flag{sq!_inj3cti0n}";
    } else {
        echo "You have logged in as an user. Here your flag: flag[Ctf_Fl@g_HURR@Y]";
    }
}

?> 
<html>
    <head>
        <title>CTF101 - Login</title>
    </head>
    <body style="margin:auto;padding-top:50px;background:black;color:#0F0;">
        <div align="center">
            <pre class="logo" style="font-size:6px;">
          _____                ____                    _____                             
         /\    \              /\    \                  /\    \                           
        /██\    \            /██\    \                /██\    \                          
       /████\    \           \███\    \              /████\    \                         
      /██████\    \           \███\    \            /██████\    \                        
     /███/\███\    \           \███\    \          /███/\███\    \                       
    /███/  \███\    \           \███\    \        /███/__\███\    \                      
   /███/    \███\    \          /████\    \      /████\   \███\    \                     
  /███/    / \███\    \        /██████\    \    /██████\   \███\    \                    
 /███/    /   \███\    \      /███/\███\    \  /███/\███\   \███\    \                   
/███/____/     \███\____\    /███/  \███\____\/███/  \███\   \███\____\                  
\███\    \      \██/    /   /███/    \██/    /\██/    \███\   \██/    /                  
 \███\    \      \/____/   /███/    / \/____/  \/____/ \███\   \/____/                   
  \███\    \              /███/    /                    \███\    \                       
   \███\    \            /███/    /                      \███\____\                      
    \███\    \           \██/    /                        \██/    /  ██╗ ██████╗  ██╗    
     \███\    \           \/____/                          \/____/  ███║██╔═████╗███║    
      \███\    \                                                    ╚██║██║██╔██║╚██║    
       \███\____\                                                    ██║████╔╝██║ ██║    
        \██/    /                                                    ██║╚██████╔╝ ██║    
         \/____/                                                     ╚═╝ ╚═════╝  ╚═╝    
</pre>                                                     
            <p>Login Page</p><br/>

            <form method="post" action="">
                <label for="username">Username: </label><input type="text" name="username"><br/><br/>
                <label for="password">Password: </label><input type="password" name="password"><br/><br/>
				<a href="forgetpw.php">Forget your password?</a><br/><br/>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>

</html>


