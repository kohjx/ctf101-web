<?php

$cookie_user = "User";
$cookie_user_value = "JohnTan101";
setcookie($cookie_user, $cookie_user_value, time() + (86400 * 30), "/"); // 86400 = 1 day

$cookie_member = "Member";
$cookie_member_value = "Normal";
setcookie($cookie_member, $cookie_member_value, time() + (86400 * 30), "/"); // 86400 = 1 day


if (isset($_POST['adminportal']) && isset($_COOKIE[$cookie_member])) {
  if ($_COOKIE[$cookie_member] == "Admin"  ) { 
	echo "flag{C00ki3_n0m_n0m_n0m}";
  } else {
	echo "Only Member with Admin rights is allow to enter";
  }
}

/*
Hint:
1) edit cookie

Answer : 
Edit cookie "member", change value from "Normal" to "Admin"
flag{C00ki3_fl@g}

*/

?>


<html>
    <head>
        <title>CTF101 - Member</title>
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

	    <h1>Member Page</h1> 

            <form method="post" action="">
		<label><b>Admin Portal</b></label> <input type="submit" name="adminportal" value="Enter">
            </form>

	    <h2>The site is currently under construction!</h2>

        </div>

    </body>
</html>
