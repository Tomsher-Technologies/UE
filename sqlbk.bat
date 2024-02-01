@echo off

cd sql
@"C:\wamp64\bin\mysql\mysql8.0.27\bin\mysqldump.exe" -u root ue > "%1.sql"
cd ..