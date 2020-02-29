cd ../
chmod 777 RSS
if [ $(stat -c "%a" "RSS") == "777" ] 
	then 
	echo "RSS - Permissions OK"
	else 
	echo "RSS - Permissions FAILED, please give permissions manually"
fi
cd RSS
if [ -d "save" ] 
	then 
	chmod 777 save
	if [ $(stat -c "%a" "save") == "777" ] 
		then 
		echo "SAVE - Permissions OK"
		cd save
		if [ -f "feeds.php" ]
			then 
			chmod 777 feeds.php
			if [ $(stat -c "%a" "feeds.php") == "777" ]
				then 
				echo -e "FEEDS.PHP - Permissions OK\nDONE"
				else 
				echo "FEEDS.PHP - Permissions FAILED, , please give permissions manually or remove the file"
			fi
		else 
		echo "No FEEDS.PHP file found"
		rm *
		echo "Content of SAVE removed"
		cd ../
		rmdir "save"
		echo "SAVE also removed"
		echo -e "PHP script will recreate SAVE and FEEDS.PHP\nDONE"
		fi
	else
	echo "SAVE - Permissions FAILED, please give permissions manually or remove the directory"	
	fi
else
echo -e "No directory SAVE found, the PHP script will create it\nDONE"
fi

