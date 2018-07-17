set BACKUP_PATH=C:\respaldo\
set FECHA= %date%
set FECHA=%FECHA:/=%
set FECHA=%FECHA: =%
set FECHA=%FECHA::=%
set FECHA=%FECHA:,=%
set BACKUP_FILE=%BACKUP_PATH%dbmeditorial_%fecha%.sql
cd C:\wamp64\bin\mysql\mysql5.7.14\bin
mysqldump -u root -p, --password=admin --all-databases> %BACKUP_FILE%
