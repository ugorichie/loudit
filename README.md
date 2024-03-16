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



  (  3.) DATABASE AND MORE.
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



  (  5.) SUBMIT VIA FORM 
this would entail submitting to the database via a form, which can also be done in 3 ways

----> CAKE PHP: by traditional use of $_POST['name'] -: But this has no validation process, you would have to specify yours

----> MODELS USE: This works by instantiating a new MODEL i.e $loud = new loud([]) , then the necessary info to insert to the database is written in the array ----> SEE BLOW
     $loud = new loud([
         'loud' => request()->get('loud')    ///// get('loud') means get values from the front end form with the name loud
       ]);
     $loud ->save(); /////// save() function means to save to the DB.


-------> By HTTP\REQUEST format: here we use the db facade for query-strings or we use the laravel predefined ::create method



( 6.) HAVING A SUCCESS/FLASJH MESSAGE 
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



(  8.) PAGINATION

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



(  9.)  DELETE ACTION
        we can have this in 3 ways
        --> RAW SQL.
        --> QUERY METHOD (facades\support\db)
        --> ELOQUENT MODEL (app\model)
      in this project, we want to work/be proficient with ELOQUENT MODEL.
      all you need do in the function is use the static method on our model (loud)
      --> i.e 
      loud::where('id',$id)->firstOrfail()-> delete()
    NB: the $id is passed from the link/query string, which is also appended to the respective {{route('loud.delete')}}.


  ((( theres something called ROUTE MODEL BINDING, this is you passing the 'model' in the function as an argument in the public function, together with the $id. 
  In this way, laravel is smart enough to bind the model with the ID in the back, and hence you can do your actions like DELETE/UPDATE )))


(  10.)  READ ACTION
        to view, just a 


