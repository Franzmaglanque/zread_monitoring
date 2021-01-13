<?php
require 'vendor/autoload.php';

$foo = "PhpOffice\\PhpSpreadsheet\\Spreadsheet";
$bar = "PhpOffice\\PhpSpreadsheet\\Writer\Xlsx";
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use $foo;
use $bar;

class spreadsheetwriter{
    public function populate($CPG,$CNG,$PPG,$PNG,$lane,$dateinput){
        //specifies which file to use
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("138_POS Z-READING COMPARISON.xlsx");
        
        //Specify which sheet to use depending on dateinput
        $activesSheet = $this->specifyActiveSheet($dateinput);
        $sheet = $spreadsheet->setActiveSheetIndexByName($activesSheet);

        //Get cell coordinates
        $cell = $this->specifycell($lane,$dateinput);

        //Insert value into spreadsheet and save
        $sheet->setCellValue($cell[0],$CPG);
        $sheet->setCellValue($cell[1],$CNG);
        $sheet->setCellValue($cell[2],$PPG);
        $sheet->setCellValue($cell[3],$PNG);
        $writer = new Xlsx($spreadsheet);
        $writer->save('138_POS Z-READING COMPARISON.xlsx');      
    }

    public function specifyActiveSheet($dateinput){
        if(in_array($dateinput,array(1,2,3,4,5,6,7))){
            return $activesSheet = '1-7';
        }elseif(in_array($dateinput,array(8,9,10,11,12,13,14))){
            return $activesSheet = '8-14';
        }elseif(in_array($dateinput,array(15,16,17,18,19,20,21))){
            return $activesSheet = '15-21';
        }elseif(in_array($dateinput,array(22,23,24,25,26,27,28,29,30,31))){
            return $activesSheet = '22-31';
        }
    }

    //Returns coloumn and row depending on dateinput
    public function specifycell($lanenumber,$dateinput){

        // Get coloumn depending on dateinput
        $coloumn = $this->getcolumnbydate($dateinput);

        //Current Positive GT , Current Negative GT , Previous Positive GT , Previous Negative GT
        //Get ROW and concatinate to coloumn     
        for($i=1,$j=4,$k=5;$i<=31;$i++,$j+=2,$k+=2){
            if($lanenumber == $i){
                return $lane = [$coloumn[0].$j,$coloumn[0].$k,$coloumn[1].$j,$coloumn[1].$k];
            }
        }
    }

    // define column depending on the date chosen
    public function getcolumnbydate($dateinput){

        if(in_array($dateinput,array(1,8,15,22))){
            return $cell = ['C','E'];
        }elseif(in_array($dateinput,array(2,9,16,23))){
            return $cell = ['G','I'];
        }elseif(in_array($dateinput,array(3,10,17,24))){
            return $cell = ['K','M'];
        }elseif(in_array($dateinput,array(4,11,18,25))){
            return $cell = ['O','Q'];
        }elseif(in_array($dateinput,array(5,12,19,26))){
            return $cell = ['S','U'];
        }elseif(in_array($dateinput,array(6,13,20,27))){
            return $cell = ['W','Y'];
        }elseif(in_array($dateinput,array(7,14,21,28))){
            return $cell = ['AA','AC'];
        }elseif($dateinput == 29){
            return $cell = ['AE','AG'];
        }elseif($dateinput == 30){
            return $cell = ['AI','AK'];
        }elseif($dateinput == 31){
            return $cell = ['AM','AO'];
        }
    }
}
$spreadwriter = new spreadsheetwriter();


?>