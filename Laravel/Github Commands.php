git init
---------------------------------
** set your name and email :
git config --global user.name "your name"
git config --global user.email "email@example.com"
<!-- create a new repository on the command line -->
git init
git remote add origin https://github.com/BNhashem16/orchidia.git 
git add .
git commit -m "Write Your Comment Here"

git push -u origin master


push an existing repository from the command line

git remote add origin https://github.com/BNhashem16/orchidia.git
git push -u origin master

<!-- Push A Project For A First Time -->
git init
git add .
git commit -m "first commit"
git remote add origin https://github.com/BNhashem16/orchidia.git
git push -u origin master
<!-- Push The Same Project after Updates -->
git add .
git commit -m "write your Comment Here"
git push origin master
    git add *   // IF You want to upload all file
    git add File_Name // IF you want to upload one file
<!-- To make un stage File  -->
git reset head File_Name
<!-- To show Comments -->
git log
<!-- To Delete OR Remove link add origin -->
git remote remove origin



