<?php
/*
* Name : Simple Spam Otp
* File : SpamOtp.php
* Author : Risky Ali
* Github : https://github.com/ER-Sky
* Telegram : https://t.me/risky_art
* Date : 26-01-2020
* Version : 1.0
*/

system("clear");
include("src/version.php");
include("src/otp.php");

echo " \e[96m\n\n
   ____                  ____  __
  / __/__  ___ ___ _    / __ \/ /____
 _\ \/ _ \/ _ `/  ' \  / /_/ / __/ _ \
/___/ .__/\_,_/_/_/_/  \____/\__/ .__/
   /_/                         /_/    \e[0m
\e[92m*-------------------------------------------*\e[0m
  Author   : Risky Ali
  Github   : https://github.com/ER-Sky
  Telegram : https://t.me/risky_art
  Date     : 26-04-2020
  Version  : 1.0
\e[92m*-------------------------------------------*\e[0m\n
  \e[92m01\e[0m. Spam Otp MyPoin Unlimited By Risky
  \e[92m00\e[0m. Exit
try {
	echo "\e[96m[+] \e[91mER-sky\e[0m/> ";
	$choice = trim(fgets(STDIN));
	$spam = new SimpleSpam\Otp();

	if (is_numeric($choice)) {
		if ($choice == 1) {
			echo "\e[96m[*] \e[0mNomor (62) : ";
			$nomor = trim(fgets(STDIN));

			if (substr($nomor, 0, 2) !== "62") {
				throw new Exception("\e[91m[!]\e[0m Nomor awalan harus 62 gan!!\n");
				$nomor = trim(fgets(STDIN));
			}
			echo "\e[96m[*] \e[0mLooping : ";
			$loop = trim(fgets(STDIN));
			if (is_numeric($loop) !==true) {
				throw new Exception("\e[91m[!]\e[0m Looping woy/limit, begokk!!\n");
				$nomor = trim(fgets(STDIN));
			}

			$spam->MyPoin(
				$nomor, $loop
			);

		} else {
			throw new Exception("\e[91m[!]\e[0m Liat menu dong!\n");
			exit(0);
		}
		echo "\e[93m[*] Byee\e[0m\n";
		exit(0);

	} else {
		throw new Exception("\e[91m[!]\e[0m Liat menu..! Anjing!\n");
	}

} catch (Exception $e) {
	echo $e->getMessage();
} ?>
