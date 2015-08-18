CTF 101 Web Security Lesson Plan
====================================

Assumptions
-----------

* Familiar with HTML, Javascript, MySQL, PHP

Topics to Cover
---------------

* Agenda
* Introduction to NUS Greyhats
* Introduction to CTFs
    * What is a CTF?
    * Styles of CTFs
    * CTF 101
* Introduction to the Pico Platform
    * Accessing the CTF101 Scoreboard
    * CTF101 Infrastructure
    * Flag Formats
	* Necessary Tools
* Getting started
	* Teaser challenges
* Introduction to OWASP Top 10 2013
	* A5
	* A4
	* A3
	* A2
	* A1
	

Workshop Agenda
===============

CTF101 is an information security workshop organised by the NUS Greyhats in the
style of an information security CTF, a competition of hacking skill, to impart
the basics of offensive systems and web security.

This workshop does not follow any formal syllabus or framework published by any
academic or commercial entity and is aimed at the beginner level. It is aimed to
run for 8 hours over two days, with 4 hours given to Systems Security, and 4
hours given to Web Security.


Introduction to NUS Greyhats
============================

NUS Greyhats
------------

The NUS Greyhats is an information security special interest group in NUS. We
organise security sharing talks, workshops (like this one), and internal
discussions on novel security research and news. In addition, we also
participate in local and international information security CTF competitions.


Introduction to CTFs
====================

What is a CTF?
--------------

CTF is short for 'Capture the Flag'. In our context, CTF competitions are
infomation security competitions in which participants compromise security to
bypass access control protections in order to obtain a piece of privileged
information called the 'flag'.

Styles of CTFs
--------------

There are two main styles of CTFs:

1. Jeopardy
2. Attack/Defence

### Jeopardy

Jeopardy style CTF competitions feature player vs organiser gameplay where
challenges are packaged in discrete units with a given description and
accompanying challenge material. The challenge material is often hosted on
organiser controlled systems. These challenges are assigned a set number of
points which are granted to the team on completion of the task by entering the
flag in the scoreboard. In some competitions, the challenges are released slowly
over the course of the competition.

Some examples of Jeopardy style CTFs are:

* Hack.lu
* DEFCON CTF Qualifiers
* PoliCTF

### Attack/Defence

Attack/Defence style CTF competitions feature player vs player gameplay where
teams have to simultaenously defend their systems while attacking the competing
team's systems. These systems play host to vulnerable binaries which have to be
kept running and accessible. Teams are penalised if their services are
non-responsive. The objective of attacking is to exploit these vulnerable
services, retrieve the flag, and submit it for points. Once arbitrary control is
achieved, there can be potential for post-exploitation such as denial-of-service
attacks on the service.

Some examples of Attack/Defence style CTFs are:

* Hack in the Box KUL
* DEFCON CTF Finals
* UCSB's iCTF

### Hybrid

Of course, CTFs can be a combination of the two styles. One such example would
be the Cyber Defenders Discovery Camp organised by DSTA.

CTF101
------

We will be employing the analogue of the Jeopardy style CTF for this workshop
to impart some basic security skills.


Introduction to the Pico Platform
=================================

We will be using the PicoCTF Platform 2 as our scoreboard to keep track of
everyone's progress in this workshop.

Accessing the CTF101 Scoreboard
-------------------------------

To access the CTF101 Scoreboard, please visit ctf.nusgreyhats.org in your
browser and sign up for an account.

I highly recommending signing up individually instead of in teams.

CTF101 Infrastructure
---------------------

There are two domains involved in this lecture:

1. ctf.nusgreyhats.org
2. play.nusgreyhats.org

Please don't attack any other systems.

Flag Formats
------------

Flag formats are a very recent development within CTFs but they have grown to be
a key and crucial part of a quality one. They prevent ambiguity when solving
challenges.

In CTF101, our flag format will be flag{SomeWordsHere}. Please note that there
are exceptions to this rule in some CTFs. It will be explicitly indicated if
there are deviations to how the flag is accepted. When entering the flag into
the scoreboard always include the flag{} encapsulations.

Necessary Tools
---------------

Before we begin, I'd like to do a quick check to see if everyone has the
required tools installed.

At the minimum, you should have a browser(i.e Chrome/Firefox) with the following 
extensions/add-ons to complete the practicals:

1. "Tamper data"
2. "EditThisCookie"

Example Challenge: Sanity Check
-------------------------------

Now, just to get everyone started with some points, and to familiarise everyone
with how flag submissions work with the scoreboard, we include a sanity check
challenge. Sanity check challenges are also useful in telling teams who sign up
for fun against teams who actually solve challenges in CTFs.

To complete this challenge, simply download the file and submit the flag.

Getting started
===============

Teaser Challenges
-----------------

Introduction to OWASP Top 10 2013
=================================
https://www.owasp.org
https://www.owasp.org/index.php/Top_10_2013-Top_10

We will cover A1 - A5 in this workshop:
1. A1 - Injection
2. A2 - Broken Authentication and Session Management
3. A3 - Cross-Site Scripting (XSS)
4. A4 - Insecure Direct Object References
5. A5 - Security Misconfiguration
