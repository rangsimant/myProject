<?php
/**
 * 
 */
 class Write_log
 {
 	
 	function __construct()
 	{
 		# code...
 	}

	 	public function writelogfile($exception){
			if (!file_exists('log')) {
				mkdir("log",0777);
				$this->writfile($exception);
			}
			else{
				if (!file_exists("log/".date("Y-m-d").".txt")) {
					$this->writfile($exception);
				}
				else{
					$this->edit($exception);
				}
			}
		}
		private function writfile($exception){
			$logdate = new  Datetime();
				$myfile = fopen("log/".$logdate->format("Y-m-d").".txt", "a") or die("Unable to open file!");
				fwrite($myfile, "start :".$this->lastdate."\r\nfinish :".$logdate->format("Y-m-d H:i:s")."\r\n");
				fwrite($myfile, $exception."\r\n");	
				fclose($myfile);
		}
		private function edit($exception){
			$logdate = new Datetime();
			$newErr = "start :".$this->lastdate."\r\nfinish :".$logdate->format("Y-m-d H:i:s")."\r\n".$exception."\r\n\r\n";
			$newErr = $newErr.file_get_contents("log/".$logdate->format("Y-m-d").".txt");
			file_put_contents("log/".$logdate->format("Y-m-d").".txt", $newErr);
		}
 } 
?>