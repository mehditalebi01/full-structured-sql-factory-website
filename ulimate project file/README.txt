💡 Installation Guide – PHP + MySQL Project with WAMP

1. Copy the project folder:
   - Copy the "myproject" folder into the following path:
     C:\wamp64\www\myproject

2. Import the database:
   - Start WAMP and go to:
     http://localhost/phpmyadmin
   - Create a new database named: mydb
   - Go to the "Import" tab
   - Select the file "mydb.sql" and click "Go" to import

3. Database connection settings:
   - If your project uses a config.php file (or similar), make sure the settings are:
     DB Name: mydb
     Username: root
     Password: (leave it empty)

4. Run the website:
   - Open your browser and go to:
     http://localhost/myproject

✅ Your project is now ready to use.
