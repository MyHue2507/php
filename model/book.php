<?php
class Book {
    var $price;
    var $title;
    var $author;
    var $year;
    var $id;
    
    public function __construct($id,$title,$price,$author,$year)
    {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }
    function display(){
        echo "Price: ". $this->price."<br>";
        echo "Title: ". $this->title."<br>";
        echo "Author: ". $this->author."<br>";
        echo "Year: ". $this->year."<br>";
    }
    static function getList($search = null){
        $data = file("data/book.txt",FILE_SKIP_EMPTY_LINES);
        $arrBook = [];
        foreach($data as $key => $value){
            $row = explode("#",$value);
            if( $search == null ||
                strlen(strstr(strtoupper($row[0]),strtoupper($search))) || strlen(strstr(strtoupper($row[3]),strtoupper($search))) ||
                strlen(strstr(strtoupper($row[1]),strtoupper($search))) || strlen(strstr(strtoupper($row[4]),strtoupper($search))) ||
                strlen(strstr(strtoupper($row[2]),strtoupper($search)))
            )
            $arrBook[] = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
            
        }
        return $arrBook;
    }
    static function add($id,$title,$price,$author,$year){
        $data = Book::getList();
        $check = true;
        foreach($data as $key => $value){
            if($value->id == $id){
                $check = false;
            }
        }
        if($check){
            $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
            $row= $id."#".$title."#".$price."#".$author."#".$year;
            fwrite($myfile, $row."\n");
            fclose($myfile);
        }
    }
    static function delete($id){
        $data = Book::getList();
        $data_res = [];
        foreach($data as $key => $value){
            if($value->id != $id){
                $data_res[] = $value;
            }
        }
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data_res as $key => $value){
            $text_write.= $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year;
        }
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function edit($id,$title,$price,$author,$year){
        $data = Book::getList();
        $check = true;
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data as $key => $value){
            if($value->id == $id){
                $text_write.= $id."#".$title."#".$price."#".$author."#".$year."\n";
            }else{
                $text_write .= $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year;
            }
        }
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
}