<?php

if ( isset($_POST['username']) && isset($_POST['password']) ) {
  if ( md5($_POST['username']) == "21232f297a57a5a743894a0e4a801fc3" && md5($_POST['password']) == "21232f297a57a5a743894a0e4a801fc3") {
	echo "flag{R3m3mb3r_t0_Ch@ng3_D3f@ult_P@ssw0rd}";
  } else {
	echo "Wrong username/password";
  }
}

?>


<html>
    <head>
        <title>CTF101 - Router</title>
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
	    
	    <p>D-LINK 504G ADSL ROUTER</p>
	    <p>Login Portal</p>

            <form method="post" action="">
                <label for="username">Username: </label><input type="text" name="username"><br/><br/>
                <label for="password">Password: </label><input type="password" name="password"><br/><br/>
                <input type="submit" value="submit">
            </form>

        </div>

    </body>
</html>
