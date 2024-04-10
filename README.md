                PROJECT NAME :  LOUDIT
                PROJECT AIM : 
                BASIC LANG/TOOLS : 
            


 DEVELOPMENT CURVE 



   ( 1.) NAME YOUR APP / TITLE /  :

 APP-NAME, config('app.name') : Unlike traditional way of outcoding/naming your app, there is a semi-dynamic way to name your app which we did.
 -> in the .env file, APP-NAME has a dummy text 'laravel', there we put in out application-name , eg: 'loudIt'
 -> in the config folder, we go into it , then head to 'app.php' file, there are many sets of associative-arrays in this file, we look for one which its 'key' is 'name' ['name' => .env('APP-NAME', 'LARAVEL')], then we change the ';aravel' dummy text too , to our app name
 -> the .env('app-name', 'laravel') tells the browser to go into our '.env' file, look for the value of APP-NAME, and if there is none, use LARAVEL as a fallback.
 --->>>   how do you pass this in your code?  wherever its required, like that page-title, header etc, just put in the (config function - containing app.name) --> {{config('app.name')}}.




 (  2.)HOW TO USE LARAVEL's  @yield(''), @include() , @section() , @endsection()

All of these functions are used to render pages to another page, just like that PHPs require() and include() function.
lets say we want to make our header/footer page dynamic, we need to create a seperate file that contains only the header/footer code eg: 'layout/layout.blade.php' 
---->  if we want to only inlcude the layout/layout.blade.php, we use the 'include('layout/layout') -> no need to write 'blade.php' in it as laravel is samrt enough to understand what you meant
---->  if in a case where you want a content in-between a dynamic page (eg: layout/layout.blade.php), in this case we use the 'yield()' function.   in the space where you need to content to be, write yield('content') , then head over to the page containing the content, at the top, write 'extends('layout.layout')' , secondly we need to wrap the content to be placed inside the dynamic page in a 'section()' tag.    hence the section() has an open tag @section('content') and a closing tag @endsection().  
TO understand better, refer to   LAYOUT/LAYOUT.BLADE.PHP page  and  HOME.BLADE.PHPYOU



  (  3.) DATABASE AND MORE. ----------------> ( https://youtu.be/p1ZCbfUvd-s?si=-eyzrY483rax_-8g )

firstly, it is possible to connect to your database from your command line, and create new database but its okay to use the traditional way of creating a database from your phpmyadmin

----> YOU have the choice to work with not only 'mysql' databse, but you can also integrate 3 other types of database in laravel, all you need do is head over to the 'config\database.php' , scroll to see what other options could be compartible, then go to your '.env' file and change the value of 'DB_CONNECTION' to your selected database connection.

-----> MIGRATIONS: this is the way to create TABLES in the database, tells what columns / keys / column data-types we need for out table.
------> php artisan make:migration create_louds_table  ##### command to create a table
------> php artisan make:model idea   #### command to create a model ('columns you intend to fill when submitting to db')

  
  
   (  4.)  DATABASE SEEDING

there are severals ways to seed data into the database (PUT DUMMY DATA INTO THE DB)
-----> BY USING FACTORIES / DATABASE SEEDER  
-----> BY USING MODELS AND CONTROLLERS (AVAILABLE IN LARAVEL 10 upwards) -> where you 'use' a MODEL, defined in a controller (eg:   $loud = new loud(['loud' => 'come to me' , likes => '2'])) and call the global availaible 'save()' function -----> check 'controller.dashboard.php'
-----> BY PHP_MY_ADMIN 



  (  5.) SUBMIT VIA FORM  ---------------> ( https://youtu.be/42KFW-KMrnc?si=Rm6bav2gf36TYlKD)

this would entail submitting to the database via a form, which can also be done in 3 ways

----> CAKE PHP: by traditional use of $_POST['name'] -: But this has no validation process, you would have to specify yours

----> MODELS USE: This works by instantiating a new MODEL i.e $loud = new loud([]) , then the necessary info to insert to the database is written in the array ----> SEE BLOW
     $loud = new loud([
         'loud' => request()->get('loud')    ///// get('loud') means get values from the front end form with the name loud
       ]);
     $loud ->save(); /////// save() function means to save to the DB.


-------> By HTTP\REQUEST format: here we use the db facade for query-strings or we use the laravel predefined ::create method



( 6.) HAVING A SUCCESS/FLASJH MESSAGE   ------------> ( https://youtu.be/DLkI2YyNgrQ?si=uJYqvZxwDs4-x7NI)

This only is required when we create a post and its successful, you want to tell the user a success message.
How to do that?
In the return redirect(), you append a with() function; e.g  return redirect('home')->with('success', 'created successfuly').
-----> How to display in the front end
    @if(session()->has('success'))
        include('success.blade.php')
    @endif


 
(  7.) SHOWING FORM ERROR   
      this is an effort to show error associated to a form, om input.
      traditionally it is placed just below the form field 
      ------> @error('input_name')
                   <span> {{$message}} </span> 
              @enderror ----> this would output whatever error caught by laravels validation 



(  8.) PAGINATION   ----------------> ( https://youtu.be/J5_lb0RqnEQ?si=oiTqndckHb0rv56b )

    pagination simply means to sectionalize your results fetched from database into pages (where users can click next/previous) to see more results from the database.
    NB: that the paginate() function only works for eloquent model (loud::orderBy('column_name', 'desc')->paginate(5))
    
    -----> refer to (loudcontroller::class, 'get_all_louds') for better understanding

    HOW TO ADD THE PAGINATION BUTTON IN THE BLADE FILE.
      ---->    {{$louds->links()}}
      //  {{-- NB: this above is for the paginate button, the $louds is the variable gotten from the controller in which 
                 the eloquent:model result from database is stored in --}}
        BUT AFTER THIS, YOU NEED TO SYLE THE BUTTON. THE CSS NEEDS TO BE CORRECTED.
        TO CORRECT THIS -->  go into a file called 'PROVIDERS' then go into 'AppServiceProvider.php' 
        THEN in the file, head down 'public function boot' and call the PAGINATOR static method -->  i.e PAGINATOR::useBootstrapFive()



(  9.)  DELETE ACTION  -------------> ( https://youtu.be/J50Q-d_r9j4?si=0rp3RykO3Mu3490s)

        we can have this in 3 ways
        --> RAW SQL.
        --> QUERY BUILDER (facades\support\db)
        --> ELOQUENT MODEL (app\model)
      in this project, we want to work/be proficient with ELOQUENT MODEL.
      all you need do in the function is use the static method on our model (loud)
      --> i.e 
      loud::where('id',$id)->firstOrfail()-> delete()
    NB: the $id is passed from the link/query string, which is also appended to the respective {{route('loud.delete')}}.


  ((( theres something called ROUTE MODEL BINDING, this is you passing the 'model' in the function as an argument in the public function, together with the $id. 
  In this way, laravel is smart enough to bind the model with the ID in the back, and hence you can do your actions like DELETE/UPDATE )))


(  10.)  READ ACTION ( R in CRUD)

        to view, just a single result from the multiple result being fetched from the database
        for this we need 
        -----> new view page i.e 'viewsingle.blade.php'
        -----> a public function (method) in the controller
        -----> a route that catches the ID of the item attached to the query string in the url, using a GET method i.e get('/view/{id}' ...)


        ROUTE MODEL BINDING -------------> ( https://youtu.be/ZX_bkEHJECA?si=ZCZOkf82XMnMh1eU)


(  11.) UPDATE ( U in CRUD )    -----------> ( https://youtu.be/W15cy3T6kys?si=fHgmLUFBmzMIjogN )

      mostly done after viewing a single item, with a button attached to it to to update or delete the item, usually we would need a new page to show a text-input for updating the current item but here we learnt we can pass a truthy variable to 'wiewsingle.blade.php' to help differentiate wether the user just wants to see, or also wants to update the item

      see -> loudController\get_single_loud_update() for understanding

  
(  12.) SEARCH BAR  ---------> (https://youtu.be/R58XZ8pAXoE?si=_gB3N7nhwA-Fbas7)
      This is to filter all the fetched items to return only items with the searched input.
      this is easy using the php/mysql 'like' wildCard.
      NB: the search input has to be passed as a GET request, nothing confidentail

      see -> loudController.php --> where the search input is accepted and checked not to be empty and WHERE wildcard statement is made to check, if it exists in the database. if it does, it returns items containing only that searched word (filtering) , 
      loudController explains more

      use ' HOME ' leftsidebard key to go back to home page (USE THE dashboard route for the link)




(  13.) CREATING COMMENTS AND RELATIONSHIP IN LARAVEL   -------> ( https://youtu.be/qK_Nfdxeb_0?si=lfTDDqlgp28YuVKh )

        creating comment is like creating louds (a new table is needed, in relation to the main loud to which you are commenting under), hence we need a MODEL , MIGRATION , ROUTE AND CONTROLLER

        ----> php artisan make:model comment  -m -c    'the -m and -c tells laravel to create a migration and controller at once' 

        ---> every comments made in the app needs to be tied to a specific LOUD. hence the introduction of foriegn_key / relationship.

        NB: Defining relationships in laravel when working with route model binding.
        the way you define relationships in laravel is through your MODEL, you go into the model and write a public function
        -----> NB: the name of the method should be the same name as the table that the current model you are in has a relationship with e.g louds have relationship with comment(comments table), hence the public function (method) has to be named 'comments' ---> then in the method, you return the kind of relationship it has ( hasMany, belongsToMany, hasOne, etc) after which you tell what model-class it is referencing to, i.e (comment::class) and lastly pass in two important arguments after referencing.
        -----> example ----> 
        public function comments{
            return $this->hasMany(comment::class, 'loud_id', 'id')
        }


(  14. ) REGISTRATION  ------> ( https://youtu.be/qlPxmu6kMA8?si=RCc_yTFu-UgQ4WAm )




(  15.) LOGGIN AND LOG OUT. ------> ( https://youtu.be/6jEN2v1eSNI?si=kTMMsWPnoHaFzldk )



(  16. ) AUTHORIZATION BASICS  ------->  ( https://youtu.be/0uEWSnqfXqQ?si=zx3ttMz893WSEXyy)
  This explains more about relationships between tables and how to link them with models and their inbuilt function ( belongsTo. hasMany , belongstoMany) 
  
        steps to carry out this phase 
  ----> add a foriegn key to the loud table to store who created a loud
  ----> run the migrate 
  ---> where you are creating the loud, go in and store the user_id , using auth()->user()->id
  ----> remember to add it to the fillables for loud
  ---> do the immidiate above for comments too
  ----> you might get null if not logged in for the submit loud, so make sure online logged in users can share louds

  ---> to show name of person thst created a comment
  {remember we need relationships for comment and user}

  /////YOU NEED TO THOROUGHLY UNDERSTAND MODEL-RELATIONSHIPS
  ---> define a relationship between a user and loud in models (loud belongsTo) and (user = hasMany)
  ---> do the same for comments 
  -------> WHEN DEFINING RELATIONSHIPS, MAKE SURE THEY HAVE THE SAME NAME WITH THE MODELS involved



  (  17. ) ROUTE GROUPING  -------->> ( https://www.youtube.com/watch?v=D7ztp2I2Xc8 )
          This is used in cases where you have too many routes in your web.php , you can further groupp them to have a cleaner and more organized 

          Route::grouping(['prefix'=>'home', ] function(){

              ALL THE ROUTE THAT HAVE THE SAME PREFIX COME IN HERE -> but this time without the prefix
          }
          


