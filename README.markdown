#Makiavelo

Yet Another PHP Web Framework. This is my take at the problem: creating a framework capable of making the developer's life easier and 
helping improve development time.

##Sample included

The current repository contains code within the `app` folder, which is where the web application's code would reside. That is the code for a very basic example of how to use some of the tools provided by the framework to create a (yet again) super basic bloging app.

##Basic layout 

I've developed this idea over time, after working for a while with Ruby on Rails, so there will be a lot of similarities. I tried to port as many features as I could.

##Folder structure
###Controllers
###Entities
###Helpers
###Views
###SQL/Helpers
###SQL/Creates
###Mappings
###Public
###Lib

##Using the framework
There are two sides to Makiavelo:

+ The command line, which has some usefull commands to do things like creating the tables for the different entities, or creating the basic required files for a standard CRUD system.
+ The web interface, which would the site/app being developed.

###Command line

There are several usefull commands to execute from the command line.
As of right now, the frameworks provides a file named: `makiavelo.php` which should have execution privileges. Executing that file alone, will list the different commands available:

+ Generator command (g): This command tells the framework to generate one of many things:
    + CRUD (crud): This attribute for the generator command will tell it to generate the basic structure for a CRUD system for a specific entity.
    + controller: This attribute will tell the generator to create a controller and it's views.
+ Database creator (db:create): It'll connect to our database using the configuration file and it'll create the database for our application
+ Database loader (db:load): It'll create all required tables for all our entities. As of right now, it doesn't allow us to pick which entity, so it'll load all of them.
+ Tasks: Makiavelo has support for tasks (similar to the ones used on RoR with Rake).

####Some examples:

__Generating a basic CRUD system for our entity called Post__
```
./makiavelo.php g crud post.yml
```

__Running a task called "createSuperUser" on the task namespace "Setup"__
```
./makiavelo.php task setup:createSuperUser
```


###Installation/Setup

In order to be able to load the application you developed with Makiavelo, you'll need to following:

+ Allow mod_rewrite on your apache config.
+ Allow the use of .htaccess files
+ Create a virtual host for your app, pointing to it's "public" folder
+ Configure the database access on the `config/database.yml` file. Right now, only MySQL is supported.
+ Configure your `/etc/hosts` file to point the new virtual host to your localhost
+ ????
+ Profit!

_NOTE_: I need to add more details to each point, but it should be pretty straight forward.

#More details

##Routes

###URL helpers

##HTML helpers

##Validations

##Security

##Database connection

##Localization

##Flash

##Tasks
