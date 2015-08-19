<?php 
session_start();

if ( isset($_POST['forgetpw'] )) {
    $link = mysqli_connect('localhost','root','','ctf101') or die("Error " . mysqli_error($link)); 

    $query = "SELECT username from login where username = '".$_POST['forgetpw']."' ";

    $result = mysqli_query($link, $query);
	
    if (mysqli_num_rows($result) > 0) {	
      while($row = mysqli_fetch_assoc($result)) {
        echo "A password recovery email has been sent to ", $row["username"];
		echo "<br>";
	  }
    } else {
	  echo "No Such User Found!";
	}
    mysqli_close($link); 


}

?> 
<html>
    <head>
        <title>CTF101 - Forget Password</title>
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
            <form method="post" action="">
			    Forget your password?<br/>
				Enter your username to get a password recovery email.<br/><br/>
                <label for="forgetpwd">Username: </label><input type="text" name="forgetpw"><input type="submit" value="Submit">
            </form>
			<a href="login.php">Return to login page.</a><br/><br/>
        </div>
    </body>

</html>


