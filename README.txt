
*****          THE SOCIAL NETWORK        ******

########################################################################################
Technologies Used:
1.PHP
2.MySQL(as DB)
3.AJAX,JavaScript,HTML,CSS3
3.Bootstrap(Only for its Grid System :p)
 
########################################################################################
Features:
1.Login System
2.Registration System
3.Status(view & update) System
4.Profile Viewing System
5.Friend System(-yet to be implemented)
FURTHER IMPROVEMENTS: Profile editing,Recommendation System etc.
#######################################################################################
DATABASE & TABLES:

Database Name: tsn
Tables:
	1.users - user_id,first_name,last__name .....
	2.friends - keeps track of "given a friend with user_id='a' is he friends with user with user_id='b' "
	2.updates - keeps track of all the updates,associates a user_id with each update(as a foreign key)

**IMPORTANT**
To import(or rather dump) the database follow these steps:
(there is a sql file in the folder tsn)
1.- Open MySQL  command line client command prompt.
      - Execute following command to create database.
	`create database database_name;`
press enter” Database name is must as that of your database _name.

Copy that sql file into location “c:/program files/MySQL/MySQL Server 5.1/bin”
	or if you are using xampp,it might be in xampp/mysql/bin
      *- Now open command prompt and execute following commands.*

        >C: “press enter”

        >cd program files/MySQL/MySQL Server5.1/bin “press enter”

        >mysql –u root –p tsn < database_name.sql “press enter”

        Your database is created on PC.

        Now in MySQL command prompt check your database. 
#######################################################################################
SECURITY:
*Utmost care was taken to make the login and registration system as secure as possible.
*All kinds of forms are sent in 'serialized' form using AJAX and the data is verified on client-side as well as server-side.
*MySQL functions are NOT used for querying the database!This is a high security risk and instead PHP PDO(i.e. prepared statements) are used to build the query.
*Passwords are hashed and then stored and never checked explicitly.I've used PH pass library for hashing the passwords which uses OpenBSD-style Blowfish-based bcrypt algorithm.
FURTHER IMPROVEMENTS: Given the time restriction,some of the security features that were left desired are: CSRF check,Session security etc.However these issues can 
		      be taken care easily if time permits.


######################################################################################
FILES & directories:
*All the primary html & php files are in the root folder 'tsn'.
*All the DAO php files(php files used for accessing database) are in dao folder.
*All the images and user images are in 'images' folder.
*'lib' folder contains external php library for password hashinh ie phppass

######################################################################################