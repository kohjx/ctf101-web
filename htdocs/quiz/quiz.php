<?php 
session_start();

if ( isset($_POST['q1'] ) && isset($_POST['q2']) && (isset($_POST['q3']) || isset($_POST['q4'])) && isset($_POST['success']) ) {
	$correct = 0;

	if ( $_POST['q1'] == "101" ) {
		$correct += 1;
	}
	
	if ( $_POST['q2'] == "lol" ) {
		$correct += 1;
	}
	
	if ( isset($_POST['q3']) && $_POST['q3'] == "22" ) {
		$correct += 1;
	}
	
	if ( $_POST['success'] == "true" ) {
		$correct += 1;	
	}
	
	if ( $correct == 4 ) {
		echo "flag{W3ll_d0n3}";
	} else {
		echo "Fail!";
	}
}

?>

<html>
    <head>
        <title>CTF101 - Quiz</title>
    </head>
    <body style="margin:auto;padding-top:50px;background:black;color:#0F0;">
		<script>
			function myFunction() {
			var x = document.getElementById("q2");
			if(x.value == "lol") {x.value = "lol ";}
			}
		</script>
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
			 <p>A Mini Quiz</p><br/>
            <form method="post" action="">
			    Q1) This is CTF___" :<br>
					<select name="q1" id="q1">
						<option value="000">000</option>
						<option value="001">001</option>
						<option value="010">010</option>
						<option value="011">011</option>
						<option value="100">100</option>
						<option value="111">101</option>
					</select><br/><br/>
                Q2) Acronym for "laughing out loud" :<br> 
					<input type="text" name="q2" id="q2" onblur="myFunction()"><br/><br/>
				Q3) Standard port for SSH :<br> 
					<input type="radio" name="q4" value="20">20<br>
					<input type="radio" name="q4" value="21">21<br>
					<input type="radio" name="q4" value="22">22<br>
					<input type="radio" name="q4" value="23">23<br>
					<input type="radio" name="q4" value="24">24<br>
					<input type="hidden" name="success" value="false">
                <input type="submit" disabled value="Submit Quiz">
            </form>
        </div>
    </body>

</html>