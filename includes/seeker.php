<?php


class Seek{

public $error;

    public function getsales($lane,$keyword){

        //Get file
        $filename = $this->get_lowest_fileName($lane);

        $fileCount = count($filename);


        for($i=0;$i<=$fileCount;$i++){
            //Define the file source/name
            $file = 'C:\wamp\www\PUREGOLD\seek\sourcefolder\\' . $lane . '\\' . $filename[$i];
            //keyword used to check if file is correct
            $keyword_check = 'AR TERMINAL Z-REPORT';
            // Load the contents of the file
            $contents = file_get_contents($file);
            // Create the pattern that will be used
            $pattern = "/^.*$keyword_check.*\$/m"; 
            if(preg_match_all($pattern, $contents, $matches)){
                // echo $filename[$i] . ' is not correct';
                $this->error = $filename[$i] . ' is not correct';
                // echo "No matches found";
            }else{
                $pattern = "/^.*$keyword.*\$/m";
                if(preg_match_all($pattern, $contents, $matches)){
                    $currentNegativeGt =  implode(str_replace($keyword,'',$matches[0]));
                    return $returnval = array('sales' => $currentNegativeGt,'filename' => $i);
                }
                break;
            }
        }
    }


    //Check if the destination folder contains Z read txt file
    // wheather or not the file copy from POS to dest folder is successful
    public function dir_is_empty($dir){
        $handle = opendir($dir);
        while(false !== ($entry = readdir($handle))){
            if($entry != '.' && $entry != '..'){
                closedir($handle);
                return 'meron laman';
            }
        }
        closedir($handle);
        return 'walang laman';
    }

    public function getReading($date,$month){
        // for($i=1,$o=51;$i<=31;$i++,$o++){
            for($i=1,$o=51;$i<=12;$i++,$o++){
            $command = "pscp -P 22 -pw cashier cashier@192.138.138." . $o . ":/home/cashier/Downloads/EJ_FILES/2020" . $month . $date . 
            '/*Z* C:\wamp\www\PUREGOLD\seek\sourcefolder\\' . $i;
            exec($command);

            //Check if the destination folder is empty 
            //If empty run the command again but looks in /home/cashier/Downloads/
            $dir = 'C:\xampp\htdocs\seek\sourcefolder\\' . $i;
            if($this->dir_is_empty($dir) == 'walang laman'){
                $command = "pscp -P 22 -pw cashier cashier@192.138.138." . $o . ":/home/cashier/Downloads/". 
                '/*Z* C:\wamp\www\PUREGOLD\seek\sourcefolder\\' . $i;
                exec($command);
            }
        }
        
    }

    public function get_lowest_fileName($laneNumber){

        $glob = glob('C:\wamp\www\PUREGOLD\seek\sourcefolder\\' .$laneNumber . '\*Z*');

        //get lowest filename from the collection
        // $lowest_file = min($glob);
        // return $this->get_only_file_name($lowest_file,$laneNumber);
        return $this->get_only_file_name($glob,$laneNumber);
    
    }

    //removes C:\xampp\htdocs\seek\sourcefolder\ and returns only the filename
    public function get_only_file_name($lowest_file,$laneNumber){
        $keyword = 'C:\wamp\www\PUREGOLD\seek\sourcefolder\\' . $laneNumber  . '\\';
        return $trimmed = str_replace($keyword,'',$lowest_file);
    }

    public function removeFiles(){
        for($i=1;$i<=31;$i++){
            $files = glob('C:\wamp\www\PUREGOLD\seek\sourcefolder\\' . $i . '\\*');
            foreach($files as $file){
                if(is_file($file)){
                    unlink($file);
                }
            }
        }
    }


    public function get_timestamp($timestamp){
        $date_timestamp = date("d",strtotime($timestamp));
        $month_timestamp = date("m",strtotime($timestamp));
        return $monthdate = array('selected_date' => $date_timestamp, 'selected_month' => $month_timestamp);
    }

}

$seek = new Seek();



?>