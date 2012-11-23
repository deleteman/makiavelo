#Makiavelo

Yet Another PHP Web Framework. This is my take at the problem: creating a framework capable of making the developer's life easier and 
helping improve development time.

##Sample included

The current repository contains code within the `app` folder, which is where the web application's code would reside. That is the code for a very basic example of how to use some of the tools provided by the framework to create a (yet again) super basic bloging app.

##Basic layout 

I've developed this idea over time, after working for a while with Ruby on Rails, so there will be a lot of similarities. I tried to port as many features as I could.

##jQuery & Bootstrap 

In order to help with the development speed, the framework comes bundled with the following packages:

+ jQuery 1.8.2
+ jQueryUI 1.8.23
+ jQuery.timePicker
+ Bootstrap

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

The aim regarding routes, is to keep them REST oriented. Right now, the only two verbs supported are GET and POST, so we need to work on that front.

When using the CRUD generator, the system will automatically generate the required routes for all of the basic CRUD operations and it'll store that information on the `routes.php` file, located on the `config` folder.

An example of what can be found in that file is:

```php
$_ROUTES[] = array(
	"list" => array("url" => "/post/", "controller" => "Post", "action" => "index"),
	"create" => array("url" => "/post/create", "controller" => "Post", "action" => "create", "via" => "post", "role" => "user"),
	"new" => array("url" => "/post/new", "controller" => "Post", "action" => "new", "role" => "user"),
	"retrieve" => array("url" => "/post/:id", "controller" => "Post", "action" => "show", "via" => "get", "role" => "user" ),
	"update" => array("url" => "/post/:id/edit", "controller" => "Post", "action" => "edit", "role" => "user"),
	"delete" => array("url" => "/post/:id/delete", "controller" => "Post", "action" => "delete", "via" => "post", "role" => "user")
	); 

```

That will create all the required routes for every action needed.
Here is an explanation of each of the keys of those arrays:

+ url: This will contain the URL for the action, can be anything, and can contain attributes in the form of `:ATTR_NAME`.
+ controller: The name of the controller, without the "Controller" part (all controllers have that word on the class name).
+ action: The name of the method to execute from the controller. It'll map to a method called: `ACTION_NAMEAction` (i,e: indexAction).
+ via: This is an optional parameter, and will force the route to work using the specified HTTP verb (only values supported right now are `get` and `post`). The default value here is `get`.
+ role: Another optional parameter, usefull when your application needs to filter out actions based on the role of the user. 

Each entry in the array, will auto-generate a url helper function, so you can use that instead of hard-coding the urls all throught the site.

###URL helpers

The helpers are created dinamically, and they basically return the url, replacing any attribute with the correct value.
Here is how the helper functions are named:

```
[underscored_controller_name]_[underscored_action_name]_path
```
For instance, using the above example, we will have:

+ `post_list_path()` to redirect to the list of all posts.
+ `post_create_path()` will save the post information.
+ `post_retrieve_path($post)` will take us to the show view of the post controller, and it'll grab the attribute `id` from the entity passed as a parameter.
+ and so on.

There are other url helper functions are can be use, when, for instance, you need to get the edit path for a particular entity, but you don't know the entity's class.

These helpers are:

+ __show_path_for__ : Receives an entity as parameter, and it'll return the right path for the show view of that entity.
+ __edit_path_for__ : Receives an entity as parameter, and it'll return the right path for the edit  view of that entity.
+ __delete_path_for__ : Receives an entity as parameter, and it'll return the right path for the delete action of that entity.

##HTML helpers
Makiavelo provides some basic html helper functions to ease the development process.

There are two types of functions, the ones that require an entity and the generic ones.

####Entity related functions

+ form_for
+ text_field
+ password_field
+ hidden_field
+ select_field
+ time_field
+ date_field
+ file_field 
+ boolean_field
+ email_field


###Generic helper functions

+ form_for_tag
+ end_form_tag
+ text_field_tag
+ password_field_tag
+ hidden_field_tag
+ select_field_tag
+ time_field_tag
+ date_field_tag
+ file_field _tag
+ boolean_field_tag
+ email_field_tag
+ link_to
+ submit
+ image_tag

##Validations

Makiavelo allows for easy validation on entities before saving them to the database. In order to set the validations, you need to set a specific private attribute called `$validations`.
That attribute needs to have the following structure:

```php
$validations = array("attr_name" => array("validation_name_1", "validation_name_2", ....))
```

Currently the following validations are supported:

+ presence
+ email
+ integer

The plan is to allow for custom validations to be created by the developer.

_A simple example_: The following code will setup the Post entity to validate for it's content, title and owner's email fields:

```php
class PostClass extends MakiaveloEntity {
	
	private $title;
	private $content;
	private $owner_email;

	static public $validations = array("title"=> array('presence'),
									   "content"=> array('presence'),
									   "owner_email"=> array('presence', 'email'),
								);
}
```

##Security

##Database connection

##Localization

##Flash

##Tasks
