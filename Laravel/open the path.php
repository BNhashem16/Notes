<!-- 1. Go to This Path -->
D:\xammp\apache\conf\extra 
<!-- 2. Open this File 'httpd-vhosts.conf' -->
<!-- 3.Write This Code -->
<VirtualHost *:80>
    DocumentRoot "D:/xammp/htdocs/"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "D:/xammp/htdocs/Project_Name/public"
    ServerName Name.test
</VirtualHost>
<!-- 4. Open Notepad as Adminstrator -->
<!--5. Go to This Path  -->
C:\Windows\System32\drivers\etc
<!-- 6. In hosts File -->
    127.0.0.1       localhost
	127.0.0.1	    Name.test
<!-- 7. Finally Restart Xampp -->