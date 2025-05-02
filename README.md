<h1 align="center"> EBOOK 
<p>Library Service</p>
</h1>

 <h1>About</h1>

 <br>
 
 
 <p>EBOOK is an Online Library web application project built using (<a href="https://getbootstrap.com/" target="_blank">Bootstrap 4.6</a>, <a href="https://laravel.com" target="_blank">Laravel 9</a>).. The main goal of this application is to provide an online library service allowing users to borrow and read books online. Users can borrow books/return books. The User can also search for particular authors to search for books. The web application has Admin user functionality which allows admins to add/edit or delete books/authors in the Database. The admin can also make a normal user admin.
 Ebook works on a User credit system. A user can buy credits for money(payment systems not integrated) and use credits to borrow and read books. A book can be borrowed for a week, the user can also extend the borrowing period of a book by 7 days and will for credits. If the user fails to return or extend a book in a given time, a late fee is charged which is 1/3rd of the credit price of the books. The advance features of the application include:
</p>

<br>



Here’s a concise and professional **Production Deployment** section for your `README.md` — tailored for recruiters and developers:

---

## 🚀 Production Deployment

The EBOOK Library web application is fully deployed and accessible online for demonstration:

🔗 **Live URL:** [https://ebook-laravel-final-production.up.railway.app](https://ebook-laravel-final-production.up.railway.app)

The project is deployed using:

* 🖥️ **Backend**: Laravel 9 (PHP 8.1) — deployed on [Railway.app](https://railway.app)
* 🎨 **Frontend**: Vite, Bootstrap 5, Vue — bundled and built via Vite
* 🛢️ **Database**: PostgreSQL (hosted on Railway's managed DB instance)

The app is production-ready, HTTPS-secured, and fully functional for user/admin login, book borrowing, and credit features.

---

Would you like a badge-style version too, or is this good as-is?




<h1>Features</h1>
<h2>User features</h2>

-   <p style="font-size:1.5rem">User/Admin functionality.Seperated logins,features and roles</p>
      <p>Purpose: To have seperate user and admin functionalities, I have created seperate dasboards for user and admins.<p>
      <p>Technologies: I have created a custom middleware to check for user roles, and to protect admin routes like CRUD operations on on Books and Authors<p>
-   <p style="font-size:1.5rem">User borrowing and returning books</p>
      <p>Purpose: A particular user can borrow a book to read for a week  and then the User needs to return the book to avoid late fee charges which depend upom the Credit price of the book<p>
      <p>Technologies: A many-to-many pivot table between a book & user, allows different users borrow same book and i have used the attach() & detach() method on the belongsToMany relationship<p>
-   <p style="font-size:1.5rem">Extending borrow period</p>
      <p>Purpose: A particular user can extend the borrowing period of a book by a week. The user will be charged 1/4th of the total credit price of the book. If the book is overdue, the user cannot read it untill he returns and re-borrows again or extends the borrowing period. The user will be charged a late fee for returing/extending after the due date. The late fee is 1/3rd of the credit price of the book<p>
-   <p style="font-size:1.5rem">Searching for books via authors</p>
      <p>Purpose: A particular book is written by a Author, A user can search for an author and check all the books that the author has written<p>
      <p>Technologies: A one-to-many relationship between Book model and Author model, allows to fetch all books associated with a particular author<p>
-   <p style="font-size:1.5rem">Automated Reminder Email function</p>
     <p>Purpose: A book when borrowed by a user has a return date, the feature sends an automated email to the users on the dealine day of the borrowing period<p>
     <p>Technologies: Created a custom command  ExpriyReminder which checks for the return dates of all the borrowed books. Used "schedular" to define the schedule for the command and created a Mail class to send the reminder email<p>
-   <p style="font-size:1.5rem">Google Login/Registration</p>
     <p>Purpose: A simpler and coventional way of registring or logging in an application<p>
     <p>Technologies: Laravel Socialite and Google Apps Api<p>
-   <p style="font-size:1.5rem">Buying credits</p>
     <p>Purpose: This is a dummy feature as the application does not include payments integration. If implemented a user can buy credits from this page<p>

<h2>Admin features</h2>

-   <p style="font-size:1.5rem">Changing User roles</p>
      <p>Purpose: To make a normal user into an admin.<p>
      <p>Technologies: A makeAdmin() function on the UserController to check the role of user and update it via post request<p>
-   <p style="font-size:1.5rem">Author CRUD and adding Books to Auhor model</p>
    <p>Purpose: Books are written by a particular author. A admin can create an Author and add new books to it. This helps the user to find the desired book easily<p>
    <p>Technologies: Created the usuall author CRUD and also included a method to add books to it<p>
-   <p style="font-size:1.5rem">Changing the status of a Book</p>
       <p>Purpose: An admin cannot delete a book untill its borrowed by an User. To delete a Book an admin can change its status to unavaliable and after waiting for the period, can delete the book<p>
       <p>Technologies: An update method using a post request<p>
-   <p style="font-size:1.5rem">Uploading Book content pdf </p>
       <p>Purpose: An admin can upload a pdf file to a book. The pdf file is the content of the book, which can be viewed only by users borrowing the book<p>

<h1>Installation</h1>
* <p>Clone the Github repository</p>
  <p>Inside the root folder of your local web development environment, open a new terminal window and clone the Github repository by using the command and change the directory in the newly formed project folder</p>
  <p style="background-color:white; color:black;padding:5px; "> git clone </p>
  <br>

-   <p>Install Composer Dependencies</p>
    <p>Enter the Command</p>
    <br>
    <p style="background-color:white; color:black;padding:5px;"> composer install </p>

<br>

-   <p>Install NPM Dependencies</p>
    <p>Enter the Commands: </p>
    <br>
    <p style="background-color:white; color:black;padding:5px; "> npm install <br> npm run dev </p>

<br>

-   <p>Copy the .env file</p>
    <p>Enter the Command: </p>
    <br>
    <p style="background-color:white; color:black; padding:5px;"> cp .env.example .env  </p>

<br>

-   <p>Generate an App encryption Key</p>
    <p>Enter the Command: </p>
    <br>
    <p style="background-color:white; color:black; padding:5px;"> php artisan key:generate  </p>

<br>

-   <p>Create an empty database for our application</p>
    <p> Use your favorite database management tool to create an empty database.
    Configure a username and password. </p>
    <br>

*   <p>Configure the .env file</p>
    <p style="background-color:white; color:black; padding:5px;"> DB_CONNECTION=mysql<br>
    DB_HOST=127.0.0.1 <br>
    DB_PORT=3306<br>
    DB_DATABASE=laravel<br>
    DB_USERNAME=root<br>
    DB_PASSWORD=******** </p>
    <p>Adjust the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME and DB_PASSWORD according to your database</p>

<br>

-   <p>Migrate the Database</p>
    <p style="background-color:white; color:black; padding:5px;"> php artisan migrate  </p>
    <br>

*   <p>Seed the Database</p>
    <p style="background-color:white; color:black; padding:5px;"> php artisan db:seed </p>
    <br>

*   <p>Run the scheduled tasks</p>
    <p style="background-color:white; color:black; padding:5px;"> php artisan schedule:work </p>
    <br>

*   <p>Open the Application</h2>
    <p>Open the browser and go to your url</p>
    <br>

<br>

<h1>Usage(User)</h2>

<p style="font-size:1.2rem" >I have implemented a credit system in my application. A user can borrow books for a week using his credits which can be bought. Each book has a price/credits to borrow. When the book is expired and the user wishes to read it further, a user can extend it for a week for a small credit amount. However, If a book is overdue and has passed it return date, a user cannot read it until it's extended which requires extra charges along with the regular extension price</p>

<h2>Seperated Login routes<h2>
<p style="font-size:1.5rem">Logging in User<p>

-   Login page
    ![My Image](/public/images/user-login.png)

*   User Accounts page and User Books page

    ![My Image 2](/public/images/user-dashboard.png)
    ![My Image 2](/public/images/user-books.png)

*   Borrowing books

    ![My Image 2](/public/images/book-borrow-2.png)
    ![My Image 2](/public/images/book-borrow-3.png)

*   Returning Books

    ![My Image 2](/public/images/return-book-1.png)
    ![My Image 2](/public/images/return-book-2.png)

*   Extending Books

    ![My Image 2](/public/images/extend1.png)
    ![My Image 2](/public/images/extend2.png)
    ![My Image 2](/public/images/extend3.png)

*   Extending Overdue books

    ![My Image 2](/public/images/extend-1.png)
    ![My Image 2](/public/images/extend2.png)
    ![My Image 2](/public/images/extend-3.png)

*   Reading a book

    ![My Image 2](/public/images/read1.png)
    ![My Image 2](/public/images/read2.png)

*   Searching via Authors

    ![My Image 2](/public/images/author-1.png)
    ![My Image 2](/public/images/author-2.png)

*   Google Registration

    ![My Image 2](/public/images/google-register-1.png)
    ![My Image 2](/public/images/google-registration-2.png)
    ![My Image 2](/public/images/google-registration-4.png)

*   Buying credits

    ![My Image 2](/public/images/credits.png)
    ![My Image 2](/public/images/credits2.png)

<h2>Usage(Admin)<h2>

-   Seperate account page.
    ![My Image](/public/images/admin-accountpng.png)

*   <h3>Admin actions<h3>

-   Creating a new author.
    ![My Image](/public/images/author-create-1.png)
    ![My Image](/public/images/author-create-2.png)

-   Adding new books to an existing author.
    ![My Image](/public/images/author-add-1.png)
    ![My Image](/public/images/author-add-2.png)

-   Adding new books without an author.
    ![My Image](/public/images/without-author-1.png)

-   Make an a user account admin.
    ![My Image](/public/images/make-admin-1.png)
    ![My Image](/public/images/make-admin-2.png)

-   Change the status of the a Book to make it unable to borrow.
    ![My Image](/public/images/change-status-1.png)
    ![My Image](/public/images/change-status-2.png)
-   Borrow button disbaled for a user.
    ![My Image](/public/images/status-3.png)

<h1>Reflective Analysis</h2>
<h2>Automated Reminder Email Feature</h2>

<h3>Description</h3>
<p>The automated email feature is one of the most important features of this application. The Users can borrow books which they like for a certain period and then have to return the book or extend the loan period to avoid extra charges by borrowing it again. The application checks for each User borrowed books and checks for the return date of books using the getExpiryDate() method of the User model and sends an automated Reminder email to Users on deadline day </p>

<h3>Why this feature?</h3>
<p>The main motivation for the development of this feature is obvious, to reduce human effort. In a large user domain, sending a reminder email for each user is not possible for an admin, furthermore it helps the users to extend their loan period so they don’t have to borrow it again as it requires additional charges. If a user has borrowed a lot of books this feature becomes useful
</p>

</p>

<h3>Development & Technologies used</h3>

-   Creating a custom artisan command : Using php Artisan make, I created a custom command called ExpiryReminder.In the handle() method the logic of the command goes in. The command iterates over each User's borrowed books list and compares the current date with the Return date/Expiry date of the book, if it matches the command sends an email to the borrower/user of the book.
-   getExpiryDateFunction($id): The function belongs to the User model which takes book-id as the parameter and gets the date on which the book was borrowed by the user and adds 10 days to it as the borrowing period and returns the date.
-   Settinp up the Schedular:We have to set up the command that we would like to schedule (which in this case is ExprityReminder), inside the kernel.php file of the console folder. For this command to work efficiently, it should be scheduled daily at midnight.
-   Sending an email: Created a mailable class ExpiryReminderMail.php and the relevant view also set up the senders configuration in the .env file, the email contains the book name along with the return date for the book and is triggered whenever the expiry date matches the current date.
<h3>Usage & Demonstration<h3>
<p>I will demonstrate this feature using mailtrap.io. We have a user called Mohammad Khan and here are borrowed books.I have changed the schedular in the kernel to schedule every minute so as to demonstrate the command </p>

![My Image](/public/images/dm1.png)

<p>In command line run this command: 
 <p style="background-color:white; color:black;padding:5px;"> php artisan schedular:work </p>

 <p>Reminder Email on mailtrap</p>

![My Image](/public/images/dm2.png)

<h3>Alternatives<h3>
<p> One of the things I could have done differently is the method of getting the return/expiry date of a book. A model can be made for the pivot_table called for example Loaned item and return could be saved as one of the attributes of the model </p>
<p>
The Reminder email sends out a separate email for each book borrowed by the user, an alternative approach is if more than one book is overdue, the books could be saved in an array and a single email containing the list of books that are about to expire could be sent to the user

</p>

<br>

<h1>Application testing</h2>
<p>I have used feature testing to test the main fucntionality of the Application and also for route authorsiation and checks.
 The UserTest contains test for user actions except Book Crud and Author Crud, which are done in BookControllerTest and AuthorControllerTest.
 The following screenshots shows all the test that are run using:
<p style="background-color:white; color:black; padding:5px;"> php artisan test  </p>

![My Image](/public/images/tests.png)

</p>

</p>

<h1>Refrences</h2>

<p>ZeroOne. (2018, April 21). Laravel restrict users to only be able to see their own profile. Stack Overflow. Retrieved November 4, 2022, from <a href="https://stackoverflow.com/questions/49951125/laravel-restrict-users-to-only-be-able-to-see-their-own-profile">https://stackoverflow.com/questions/49951125/laravel-restrict-users-to-only-be-able-to-see-their-own-profile. </a> </p>

<br>
<p>Kingsconsult. (2020, October 12). How to implement search functionality in Laravel 8 and Laravel 7 downwards. DEV Community 👩‍💻👨‍💻.<a href="https://dev.to/kingsconsult/how-to-implement-search-functionality-in-laravel-8-and-laravel-7-downwards-3g76.">https://dev.to/kingsconsult/how-to-implement-search-functionality-in-laravel-8-and-laravel-7-downwards-3g76</a>  </p>

<br>

<p>Gondalez, V. (2019, May 7). Laravel PHP framework tutorial - full course for beginners (2019). YouTube. Retrieved November 4, 2022, from <p><a href="https://www.youtube.com/watch?v=ImtZ5yENzgE&amp;t=2635s">https://www.youtube.com/watch?v=ImtZ5yENzgE&amp;t=2635s</a>

<br>

<p>Aschmelyun, A. (2021, July 6). Laravel-job-board/databaseseeder.php at main · Aschmelyun/Laravel-job-board. GitHub. Retrieved November 4, 2022, from <a href="https://github.com/aschmelyun/laravel-job-board/blob/main/database/seeders/DatabaseSeeder.php">https://github.com/aschmelyun/laravel-job-board/blob/main/database/seeders/DatabaseSeeder.php</a>
  </p>

<br>
<p>Chauhan, U. (2020, July 17). Bootstrap 5 sidebar user profile example. bbbootsrap. Retrieved November 4, 2022, from <a href="https://bbbootstrap.com/snippets/bootstrap-sidebar-user-profile-62301382 " >https://bbbootstrap.com/snippets/bootstrap-sidebar-user-profile-62301382 </a></p>

<br>
<p>Deyson. (n.d.). Bootstrap snippet. BS4 Search Bar. Free Bootstrap snippets and examples. Retrieved November 4, 2022, from   <a href="https://www.bootdey.com/snippets/view/bs4-search-Bar">https://www.bootdey.com/snippets/view/bs4-search-Bar </a></p>

<p>YouTube. (2021, July 30). Scheduler in Laravel 8 | what is the scheduler in Laravel? | Laravel Scheduler explained. YouTube. Retrieved January 4, 2023, from <a href="https://www.youtube.com/watch?v=vZYRDRF4yF4&amp;t=543s" >https://www.youtube.com/watch?v=vZYRDRF4yF4&amp;t=543s</a></p>

<p>YouTube. (2021, March 23). Laravel how to upload,view and download pdf,Docx,mp4,mp3 in Laravel Laravel tutorial from scratch. YouTube. Retrieved January 4, 2023, from  <a href= "https://www.youtube.com/watch?v=IYswY0Jgup4"> https://www.youtube.com/watch?v=IYswY0Jgup4 </a> </p>

<p>TheCamboTutorial. (2022, July 23). Auth multi roles login with Custom Middleware in Laravel 9. YouTube. Retrieved January 4, 2023, from <a href ="https://www.youtube.com/watch?v=vc4sXOdE4bQ">https://www.youtube.com/watch?v=vc4sXOdE4bQ </a></p>

<p>goslscsgoslscs 16711 gold badge22 silver badges99 bronze badges, RahulRahul 18.1k77 gold badges4040 silver badges5959 bronze badges, LatheesanLatheesan 22.5k3131 gold badges102102 silver badges194194 bronze badges, zlatanzlatan 3, fatemeh sadeghifatemeh sadeghi      1, Harun YilmazHarun Yilmaz 8, &amp; Mr. AMr. A 7166 bronze badges. (1966, September 1). Add Days to date in Laravel. Stack Overflow. Retrieved January 4, 2023, from <a href ="https://stackoverflow.com/questions/57692600/add-days-to-date-in-laravel#:~:text=You%20can%20add%20dates%20to,%2D%3EaddDays(%24daysToAdd)%3B ">https://stackoverflow.com/questions/57692600/add-days-to-date-in-laravel#:~:text=You%20can%20add%20dates%20to,%2D%3EaddDays(%24daysToAdd)%3B </a></p>

<p>Author Upasana Chauha June, &amp; Author Anand Vunnam March. (n.d.). 32 Bootstrap Profiles. Free Frontend. Retrieved January 4, 2023, from <a href= "https://freefrontend.com/bootstrap-profiles/ ">https://freefrontend.com/bootstrap-profiles/ </a></p>

<p>YouTube. (2022, February 22). Testing in laravel | full tutorial for beginners | laravel testing tutorial. YouTube. Retrieved January 4, 2023, from <a href ="https://www.youtube.com/watch?v=SmS5YcKL6Mc&amp;t=2669s"> https://www.youtube.com/watch?v=SmS5YcKL6Mc&amp;t=2669s </p>
